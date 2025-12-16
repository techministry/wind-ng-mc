<?php
/**
 * Modern Lightweight Template Engine
 * Replaces Smarty with a simple, fast PHP-based template system
 * Works with modern PHP 8.1+ and requires no external dependencies
 * 
 * Features:
 * - {{ variable }} for output (auto-escaped)
 * - {{{ raw_html }}} for unescaped output
 * - {% for item in items %} ... {% endfor %}
 * - {% if condition %} ... {% else %} ... {% endif %}
 * - {% include "file.tpl" %} with context
 * - {% set var = value %}
 * - Modifiers: {{ name | upper | escape }}
 * 
 * Usage:
 *   $template = new TemplateEngine();
 *   $template->setTemplateDir('templates/');
 *   $template->assign('title', 'Hello');
 *   echo $template->render('page.tpl');
 */
class TemplateEngine {
    public $template_dir = '';
    public $compile_dir = '';
    private $vars = [];
    private $modifiers = [];
    
    public function __construct() {
        $this->registerDefaultModifiers();
    }
    
    public function setTemplateDir($dir) {
        $this->template_dir = rtrim($dir, '/') . '/';
    }
    
    public function getTemplateDir() {
        return array($this->template_dir);
    }
    
    public function setCompileDir($dir) {
        $this->compile_dir = rtrim($dir, '/') . '/';
    }
    
    public function assign($key, $value = null) {
        if (is_array($key)) {
            $this->vars = array_merge($this->vars, $key);
        } else {
            $this->vars[$key] = $value;
        }
        return $this;
    }
    
    public function clearAllAssign() {
        $this->vars = [];
        return $this;
    }
    
    public function registerPlugin($type, $name, $callback) {
        if ($type === 'modifier') {
            $this->modifiers[$name] = $callback;
        }
    }
    
    public function fetch($template_name) {
        $template_path = $this->template_dir . $template_name;
        
        if (!file_exists($template_path)) {
            throw new Exception("Template not found: $template_name");
        }
        
        $source = file_get_contents($template_path);
        $compiled = $this->compile($source);
        
        // Extract variables into local scope for template
        extract($this->vars, EXTR_SKIP);
        
        // Capture output
        ob_start();
        eval('?>' . $compiled);
        $output = ob_get_clean();
        
        return $output;
    }
    
    public function render($template_name) {
        return $this->fetch($template_name);
    }
    
    private function compile($source) {
        // Remove comments
        $source = preg_replace('/\{#.*?#\}/s', '', $source);
        
        // Process raw output {{{ var }}}
        $source = preg_replace_callback(
            '/\{\{\{\s*(.+?)\s*\}\}\}/',
            function($m) { return '<?php echo ' . $this->compileExpression($m[1]) . '; ?>'; },
            $source
        );
        
        // Process escaped output {{ var }}
        $source = preg_replace_callback(
            '/\{\{\s*(.+?)\s*\}\}/',
            function($m) { return '<?php echo htmlspecialchars(' . $this->compileExpression($m[1]) . ', ENT_QUOTES, "UTF-8"); ?>'; },
            $source
        );
        
        // Process set statements {% set var = value %}
        $source = preg_replace_callback(
            '/\{%\s*set\s+(\w+)\s*=\s*(.+?)\s*%\}/',
            function($m) { return '<?php $' . $m[1] . ' = ' . $this->compileExpression($m[2]) . '; ?>'; },
            $source
        );
        
        // Process for loops {% for item in items %} ... {% endfor %}
        $source = preg_replace_callback(
            '/\{%\s*for\s+(\w+)\s+in\s+(.+?)\s*%\}(.*?)\{%\s*endfor\s*%\}/s',
            function($m) { 
                return '<?php foreach (' . $this->compileExpression($m[2]) . ' as $' . $m[1] . ') { ?>' 
                    . $m[3] 
                    . '<?php } ?>';
            },
            $source
        );
        
        // Process foreach with keys {% foreach from=items item=it key=k %} ... {% endforeach %}
        $source = preg_replace_callback(
            '/\{%\s*foreach\s+from=(.+?)\s+item=(\w+)(?:\s+key=(\w+))?\s*%\}(.*?)\{%\s*endforeach\s*%\}/s',
            function($m) {
                $array_expr = $this->compileExpression($m[1]);
                $item = $m[2];
                $key = $m[3] ?? 'key';
                $body = $m[4];
                
                if ($m[3]) {
                    return '<?php foreach (' . $array_expr . ' as $' . $key . ' => $' . $item . ') { ?>' 
                        . $body 
                        . '<?php } ?>';
                } else {
                    return '<?php foreach (' . $array_expr . ' as $' . $item . ') { ?>' 
                        . $body 
                        . '<?php } ?>';
                }
            },
            $source
        );
        
        // Process if/else/endif blocks
        $source = preg_replace_callback(
            '/\{%\s*if\s+(.+?)\s*%\}(.*?)(?:\{%\s*else\s*%\}(.*?))?\{%\s*endif\s*%\}/s',
            function($m) {
                $condition = $this->compileCondition($m[1]);
                $if_body = $m[2];
                $else_body = isset($m[3]) ? $m[3] : '';
                
                $php = '<?php if (' . $condition . ') { ?>' . $if_body;
                if ($else_body) {
                    $php .= '<?php } else { ?>' . $else_body;
                }
                $php .= '<?php } ?>';
                
                return $php;
            },
            $source
        );
        
        // Process include statements {% include "file.tpl" %}
        $source = preg_replace_callback(
            '/\{%\s*include\s+(?:file=)?"(.+?)"(?:\s+([^%]*))?\s*%\}/',
            function($m) {
                $file = $m[1];
                $params = isset($m[2]) ? trim($m[2]) : '';
                
                $php = '<?php ';
                if ($params) {
                    // Parse parameters like: param1="value" param2=$var
                    $params = $this->parseIncludeParams($params);
                    $php .= '$_include_vars = array(' . $params . ');';
                    $php .= '$_old_vars = $this->vars; $this->assign($_include_vars);';
                } else {
                    $php .= '$_old_vars = null;';
                }
                $php .= 'echo $this->fetch("' . $file . '");';
                if ($params) {
                    $php .= '$this->vars = $_old_vars;';
                }
                $php .= ' ?>';
                
                return $php;
            },
            $source
        );
        
        return $source;
    }
    
    private function compileExpression($expr) {
        $expr = trim($expr);
        
        // Handle modifiers: expr | modifier1 | modifier2:arg
        if (strpos($expr, '|') !== false) {
            $parts = explode('|', $expr);
            $result = $this->compileSimpleExpr(array_shift($parts));
            
            foreach ($parts as $modifier) {
                $modifier = trim($modifier);
                if (strpos($modifier, ':') !== false) {
                    list($mod_name, $mod_args) = explode(':', $modifier, 2);
                    $mod_name = trim($mod_name);
                    $mod_args = trim($mod_args);
                    
                    if (isset($this->modifiers[$mod_name])) {
                        $result = 'call_user_func(' . var_export($this->modifiers[$mod_name], true) . ', ' . $result . ', ' . var_export($mod_args, true) . ')';
                    } else {
                        // Built-in modifiers
                        $result = $this->applyModifier($result, $mod_name, $mod_args);
                    }
                } else {
                    if (isset($this->modifiers[$modifier])) {
                        $result = 'call_user_func(' . var_export($this->modifiers[$modifier], true) . ', ' . $result . ')';
                    } else {
                        // Built-in modifiers
                        $result = $this->applyModifier($result, $modifier);
                    }
                }
            }
            
            return $result;
        }
        
        return $this->compileSimpleExpr($expr);
    }
    
    private function compileSimpleExpr($expr) {
        $expr = trim($expr);
        
        // String literals
        if ((substr($expr, 0, 1) === '"' && substr($expr, -1) === '"') ||
            (substr($expr, 0, 1) === "'" && substr($expr, -1) === "'")) {
            return $expr;
        }
        
        // Numbers
        if (is_numeric($expr)) {
            return $expr;
        }
        
        // Variables and array access: $var, $var['key'], $var.key, $var['key']['subkey']
        if (substr($expr, 0, 1) === '$') {
            return $expr;
        }
        
        // Variable names without $: transform to $name
        if (preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*(?:\[[^\]]+\]|\.[a-zA-Z_][a-zA-Z0-9_]*)*$/', $expr)) {
            return '$' . $expr;
        }
        
        // Backtick expressions - evaluate as PHP
        if (substr($expr, 0, 1) === '`' && substr($expr, -1) === '`') {
            $inner = substr($expr, 1, -1);
            return $this->compileSimpleExpr($inner);
        }
        
        // Fallback - treat as PHP expression
        return $expr;
    }
    
    private function applyModifier($value, $modifier, $args = null) {
        switch ($modifier) {
            case 'upper':
            case 'strtoupper':
                return 'strtoupper(' . $value . ')';
            case 'lower':
            case 'strtolower':
                return 'strtolower(' . $value . ')';
            case 'capitalize':
                return 'ucfirst(strtolower(' . $value . '))';
            case 'escape':
            case 'htmlspecialchars':
                return 'htmlspecialchars(' . $value . ', ENT_QUOTES, "UTF-8")';
            case 'stripslashes':
                return 'stripslashes(' . $value . ')';
            case 'truncate':
                $arg = $args ? explode(':', $args)[0] : '80';
                return 'substr(' . $value . ', 0, ' . $arg . ')';
            case 'date_format':
                if ($args) {
                    return 'date(' . var_export($args, true) . ', strtotime(' . $value . '))';
                }
                return 'date("Y-m-d H:i:s", strtotime(' . $value . '))';
            case 'json':
            case 'json_encode':
                return 'json_encode(' . $value . ')';
            case 'count':
            case 'sizeof':
                return 'count(' . $value . ')';
            case 'implode':
                $sep = $args ? $args : '","';
                return 'implode(' . var_export($sep, true) . ', (array)' . $value . ')';
            default:
                return $value;
        }
    }
    
    private function compileCondition($condition) {
        $condition = trim($condition);
        
        // Handle comparison operators
        $operators = ['===', '!==', '==', '!=', '<=', '>=', '<', '>', '&&', '||', 'and', 'or'];
        
        foreach ($operators as $op) {
            if (strpos($condition, $op) !== false) {
                $parts = explode($op, $condition, 2);
                $left = $this->compileSimpleExpr(trim($parts[0]));
                $right = $this->compileSimpleExpr(trim($parts[1]));
                
                // Normalize operators
                $op = trim($op);
                if ($op === 'and') $op = '&&';
                if ($op === 'or') $op = '||';
                
                return $left . ' ' . $op . ' ' . $right;
            }
        }
        
        // Handle 'is even', 'is odd', etc.
        if (preg_match('/^(.+?)\s+is\s+not\s+(\w+)/', $condition, $m)) {
            return $this->compileIsCondition($m[1], $m[2], true);
        } elseif (preg_match('/^(.+?)\s+is\s+(\w+)/', $condition, $m)) {
            return $this->compileIsCondition($m[1], $m[2], false);
        }
        
        // Simple variable/expression
        return $this->compileSimpleExpr($condition);
    }
    
    private function compileIsCondition($value, $type, $negate = false) {
        $value = $this->compileSimpleExpr(trim($value));
        $not = $negate ? '!' : '';
        
        switch (strtolower($type)) {
            case 'even':
                return $not . '((' . $value . ') % 2 == 0)';
            case 'odd':
                return $not . '((' . $value . ') % 2 != 0)';
            case 'empty':
                return $not . 'empty(' . $value . ')';
            case 'set':
            case 'isset':
                return $not . 'isset(' . $value . ')';
            case 'null':
                return $not . '((' . $value . ') === null)';
            default:
                return $value;
        }
    }
    
    private function parseIncludeParams($param_string) {
        // Parse: param1="value" param2=$var param3="$var"
        $params = [];
        
        if (preg_match_all('/(\w+)=(?:"([^"]*)"|\'([^\']*)\'|(\$\w+)|(\w+))/', $param_string, $matches, PREG_SET_ORDER)) {
            foreach ($matches as $match) {
                $key = $match[1];
                $value = $match[2] ?? $match[3] ?? $match[4] ?? $match[5] ?? '';
                
                if (!empty($match[4])) {
                    // It's a variable reference
                    $params[] = var_export($key, true) . ' => ' . $match[4];
                } else {
                    // It's a string literal  
                    $params[] = var_export($key, true) . ' => ' . var_export($value, true);
                }
            }
        }
        
        return implode(', ', $params);
    }
    
    private function registerDefaultModifiers() {
        $this->modifiers['stripslashes'] = 'stripslashes';
    }
}
?>
