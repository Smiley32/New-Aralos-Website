<h1 class="title is-6 is-mega-menu-title">Connection</h1>

<?php if($error) { foreach($errors as $e) { ?>
    <article class="message is-danger">
        <div class="message-header">
            <p>Erreur</p>
            <button class="delete" aria-label="delete"></button>
        </div>
        <div class="message-body">
            <?php echo $e; ?>
        </div>
    </article>
<?php }} ?>

<form method="POST" action="/users/connection">
    <div class="field-body">
        <div class="field">
            <label class="label">Pseudo</label>
            <p class="control is-expanded has-icons-left">
                <input name="pseudo" class="input" type="text" placeholder="Pseudo" required value="<?php if(isset($_POST['pseudo'])) echo $_POST['pseudo']; ?>">
                <span class="icon is-small is-left">
                    <i class="fa fa-user"></i>
                </span>
            </p>
        </div>

        <div class="field">
        <label class="label">Mot de passe</label>
            <p class="control is-expanded has-icons-left">
                <input name="pass" class="input" type="password" placeholder="Mot de passe" required>
                <span class="icon is-small is-left">
                    <i class="fa fa-unlock-alt"></i>
                </span>
            </p>
        </div>
    </div>
    <br />
    <div class="field is-grouped is-grouped-centered">
        <p class="control">
            <input type="submit" name="coSubmit" value="Confirmer" class="button is-primary">
        </p>
        <p class="control">
            <input id="coReset" type="reset" value="Annuler" class="button is-light">
        </p>
    </div>
</form>

<a href="/users/inscription">Je ne suis pas inscrit</a>
