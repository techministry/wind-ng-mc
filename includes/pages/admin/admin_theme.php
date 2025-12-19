<?php
// WiND Admin Theme Selection Page
require_once(ROOT_PATH.'globals/common.php');
if (!$main->userdata->privileges['admin']) {
    die('Access denied');
}

$themes = $vars['templates']['available'];
$current = $vars['templates']['default'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['theme'])) {
    $theme = $_POST['theme'];
    if (in_array($theme, $themes)) {
        // Save theme selection to .env or config (for demo, use .env)
        file_put_contents(ROOT_PATH.'.env', "WIND_THEME=$theme\n", FILE_APPEND | LOCK_EX);
        header('Location: ?page=admin&subpage=theme&success=1');
        exit;
    }
}
?>
<h2>Select Site Theme</h2>
<form method="post">
    <label for="theme">Theme:</label>
    <select name="theme" id="theme">
        <?php foreach ($themes as $theme): ?>
            <option value="<?= htmlspecialchars($theme) ?>" <?= $theme === $current ? 'selected' : '' ?>><?= ucfirst($theme) ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Save</button>
</form>
<?php if (isset($_GET['success'])): ?>
    <div class="message-success">Theme updated! Please reload the page.</div>
<?php endif; ?>
