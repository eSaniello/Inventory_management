<?php

/**
 * index.php
 *
 * @package default
 */


ob_start();
require_once 'includes/load.php';
if ($session->isUserLoggedIn(true)) {
    redirect('home.php', false);
}
?>
<?php include_once 'layouts/header.php'; ?>
<div class="login-page">
    <div class="text-center">
        <img src="libs/logo.png" alt="NATIN LOGO" style="width: 10vw;">
        <h2>VOORRAADBEHEER</h2>
        <p>Inloggen</p>
    </div>
    <?php echo display_msg($msg); ?>
    <form method="post" action="auth.php" class="clearfix">
        <div class="form-group">
            <label for="username" class="control-label">Gebruikersnaam</label>
            <input type="name" class="form-control" name="username" placeholder="Gebruikersnaam">
        </div>
        <div class="form-group">
            <label for="Password" class="control-label">Wachtwoord</label>
            <input type="password" name="password" class="form-control" placeholder="Wachtwoord">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-info  pull-right">Log in</button>
        </div>
    </form>
</div>
<?php include_once 'layouts/footer.php'; ?>