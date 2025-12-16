<?php
/**
 * Legacy Smarty to Modern Template Engine Bridge
 * Automatically converts Smarty 2.x syntax to modern template syntax
 * 
 * Conversions:
 * - {$var} → {{ var }}
 * - {$var|modifier} → {{ var | modifier }}
 * - {section} → {% foreach %}
 * - {foreach} → {% foreach %}
 * - {if} → {% if %}
 * - {include} → {% include %}
 * - {assign} → {% set %}
 * - backtick expressions → variable substitution
 */
class SmartyBridge {
    public static function convertTemplate($source) {
        // 1. Convert Smarty variable output {$var} → {{ var }}
        $source = preg_replace_callback(
            '/\{\$(\w+(?:\[\w+\]|\.\w+)*)\}/',
            function($m) {
                $var = $m[1];
                // Convert bracket notation to array syntax for template engine
                $var = self::normalizeSyntax($var);
                return '{{ ' . $var . ' }}';
            },
            $source
        );
        
        // 2. Convert raw output {$var|raw} → {{{ var }}}
        $source = preg_replace_callback(
            '/\{\{(\s*\w+.*?\|raw\s*)\}\}/',
            function($m) {
                $var = preg_replace('/\|\s*raw\s*$/', '', $m[1]);
                return '{{{ ' . trim($var) . ' }}}';
            },
            $source
        );
        
        // 3. Convert {assign} statements
        $source = preg_replace_callback(
            '/\{assign\s+var\s*=\s*["\']?(\w+)["\']?\s+value\s*=\s*["\']?(.+?)["\']?\s*\}/',
            function($m) {
                $var = $m[1];
                $value = self::normalizeSyntax($m[2]);
                return '{% set ' . $var . ' = ' . $value . ' %}';
            },
            $source
        );
        
        // 4. Convert {foreach} blocks
        $source = preg_replace_callback(
            '/\{foreach\s+from\s*=\s*(\$?\w+(?:\[\w+\]|\.\w+)*)\s+item\s*=\s*(\w+)(?:\s+key\s*=\s*(\w+))?\s*\}/',
            function($m) {
                $array = self::normalizeSyntax($m[1]);
                $item = $m[2];
                $key = $m[3] ?? null;
                
                if ($key) {
                    return '{% foreach from=' . $array . ' item=' . $item . ' key=' . $key . ' %}';
                }
                return '{% foreach from=' . $array . ' item=' . $item . ' %}';
            },
            $source
        );
        $source = str_replace('{/foreach}', '{% endforeach %}', $source);
        
        // 5. Convert {section} blocks to {foreach}
        $source = preg_replace_callback(
            '/\{section\s+loop\s*=\s*(\$?\w+(?:\[\w+\]|\.\w+)*)\s+name\s*=\s*(\w+)\s*\}/',
            function($m) {
                $array = self::normalizeSyntax($m[1]);
                $key = $m[2];
                return '{% foreach from=' . $array . ' item=_item key=' . $key . ' %}';
            },
            $source
        );
        $source = str_replace('{/section}', '{% endforeach %}', $source);
        
        // 6. Convert {if} blocks
        $source = preg_replace_callback(
            '/\{if\s+(.+?)\s*\}/',
            function($m) {
                $condition = self::normalizeCondition($m[1]);
                return '{% if ' . $condition . ' %}';
            },
            $source
        );
        $source = str_replace('{else}', '{% else %}', $source);
        $source = str_replace('{/if}', '{% endif %}', $source);
        
        // 7. Convert {include} statements
        $source = preg_replace_callback(
            '/\{include\s+(?:file\s*=\s*)?["\']?(\w+(?:\/\w+)*\.tpl)["\']?(?:\s+([^}]*?))?\s*\}/',
            function($m) {
                $file = $m[1];
                $params = isset($m[2]) ? trim($m[2]) : '';
                
                $result = '{% include "' . $file . '"';
                
                if ($params) {
                    // Convert parameter syntax - carefully parse key=value pairs
                    $param_pairs = [];
                    
                    // Match quoted values
                    if (preg_match_all('/(\w+)=["\']([^"\']*)["\']/', $params, $matches, PREG_SET_ORDER)) {
                        foreach ($matches as $match) {
                            $param_pairs[$match[1]] = "\"" . addslashes($match[2]) . "\"";
                        }
                    }
                    
                    // Match $var values
                    if (preg_match_all('/(\w+)=\$(\w+)/', $params, $matches, PREG_SET_ORDER)) {
                        foreach ($matches as $match) {
                            $param_pairs[$match[1]] = $match[2];
                        }
                    }
                    
                    // Match backtick expressions
                    if (preg_match_all('/(\w+)=`([^`]*)`/', $params, $matches, PREG_SET_ORDER)) {
                        foreach ($matches as $match) {
                            $param_pairs[$match[1]] = self::normalizeSyntax($match[2]);
                        }
                    }
                    
                    // Add parameters to result
                    foreach ($param_pairs as $key => $value) {
                        $result .= ' ' . $key . '=' . $value;
                    }
                }
                
                return $result . ' %}';
            },
            $source
        );
        
        // 8. Handle backtick expressions in template variables
        $source = preg_replace_callback(
            '/\{\{\s*`(.+?)`\s*\}\}/',
            function($m) {
                $expr = self::normalizeSyntax($m[1]);
                return '{{ ' . $expr . ' }}';
            },
            $source
        );
        
        // 9. Fix references to $smarty.section.*.index → use template loop counter
        $source = str_replace('$smarty.section.', 'smarty_section_', $source);
        $source = str_replace('.index', '_index', $source);
        
        // 10. Fix bracket-dot notation in template tags
        $source = preg_replace(
            '/\{\{([^}]*)\$([a-zA-Z_]\w*)(?:\[(\w+)\])?\.(\w+)/i',
            '{{ $\2[\3].\4',
            $source
        );
        
        return $source;
    }
    
    private static function normalizeSyntax($expr) {
        $expr = trim($expr);
        
        // Handle dot notation: $var.property → $var['property']
        $expr = preg_replace_callback(
            '/\$?(\w+)\.([a-zA-Z_]\w*)/',
            function($m) { return "\${$m[1]}['{$m[2]}']"; },
            $expr
        );
        
        // Ensure $ prefix for variables
        if (substr($expr, 0, 1) !== '$' && substr($expr, 0, 1) !== '"' && !is_numeric($expr[0])) {
            if (preg_match('/^[a-zA-Z_]/', $expr)) {
                $expr = '$' . $expr;
            }
        }
        
        return $expr;
    }
    
    private static function normalizeCondition($condition) {
        $condition = trim($condition);
        
        // Replace smarty comparison operators
        $condition = str_replace(' eq ', ' == ', $condition);
        $condition = str_replace(' ne ', ' != ', $condition);
        $condition = str_replace(' gt ', ' > ', $condition);
        $condition = str_replace(' lt ', ' < ', $condition);
        $condition = str_replace(' gte ', ' >= ', $condition);
        $condition = str_replace(' lte ', ' <= ', $condition);
        
        // Replace smarty variable syntax with dollar sign
        $condition = preg_replace_callback(
            '/(?<!["\'])(\w+(?:\[\w+\]|\.\w+)*)\b(?!["\'])/',
            function($m) {
                // Skip if it's a keyword or modifier
                if (in_array($m[1], ['and', 'or', 'not', 'is', 'even', 'odd', 'isset', 'empty'])) {
                    return $m[1];
                }
                if (preg_match('/^(FALSE|TRUE|NULL)$/i', $m[1])) {
                    return $m[1];
                }
                return '$' . $m[1];
            },
            $condition
        );
        
        return $condition;
    }
}
?>
