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

<?php if($succes) { ?>
    <article class="message is-success">
        <div class="message-header">
            <p>Success</p>
            <button class="delete" aria-label="delete"></button>
        </div>
        <div class="message-body">
            Tu as été inscris correctement !
        </div>
    </article>
<?php } ?>

<form method="POST">
    <div class="field">
        <label class="label">Pseudo</label>
        <p class="control is-expanded has-icons-left">
            <input name="pseudo" class="input" type="text" placeholder="Pseudo" required value="<?php if($post) echo $pseudo; ?>">
            <span class="icon is-small is-left">
                <i class="fa fa-user"></i>
            </span>
        </p>
    </div>

    <div class="field-body">
        <div class="field">
            <label class="label">Mot de passe</label>
            <p class="control is-expanded has-icons-left">
                <input name="pass" class="input" type="password" placeholder="Mot de passe" required>
                <span class="icon is-small is-left">
                    <i class="fa fa-unlock-alt"></i>
                </span>
            </p>
        </div>
        <div class="field">
            <label class="label">Répétez le mot de passe</label>
            <p class="control is-expanded has-icons-left">
                <input name="passAgain" class="input" type="password" placeholder="Mot de passe" required>
                <span class="icon is-small is-left">
                    <i class="fa fa-unlock-alt"></i>
                </span>
            </p>
        </div>
    </div>
    <div class="field">
        <label class="label">Mail</label>
        <p class="control is-expanded has-icons-left">
            <input name="mail" class="input" type="mail" placeholder="mail" required value="<?php if($post && $mail !== NULL) echo $mail; ?>">
            <span class="icon is-small is-left">
                <i class="fa fa-envelope"></i>
            </span>
        </p>
    </div>
    <div class="field">
        <div class="control">
            <label class="checkbox" onclick="check()">
                <input type="checkbox" id="guildCheck">
                J'appartiens à la guilde Aralos
            </label>
        </div>
    </div>
    <div id="guild" style="display:none;">
        <div class="field">
            <label class="label">Clé d'inscription (donnée par la guilde)</label>
            <p class="control is-expanded has-icons-left">
                <input name="guildKey" class="input" type="text" placeholder="Clé d'inscription" required>
                <span class="icon is-small is-left">
                    <i class="fa fa-unlock-alt"></i>
                </span>
            </p>
        </div>
        <div class="field">
            <label class="label">Sélectionne la guilde</label>
            <p class="control">
                <span class="select">
                    <select name="guildId">
                        <option value="1" selected>Aralos</option>
                        <option value="2">Aralos 2</option>
                    </select>
                </span>
            </p>
        </div>
    </div>
    <br>
    <div class="field is-grouped is-grouped-centered">
        <p class="control">
            <input name="submit" type="submit" value="Confirmer" class="button is-primary">
        </p>
        <p class="control">
            <input type="reset" value="Annuler" class="button is-light">
        </p>
    </div>
</form>

<script>

function check() {
    if(document.getElementById("guildCheck").checked) {
        document.getElementById("guild").style.display = "block";
    } else {
        document.getElementById("guild").style.display = "none";
    }
}

</script>