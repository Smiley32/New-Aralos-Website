<form method="POST">
    <div class="field-body">
        <div class="field">
            <label class="label">Pseudo</label>
            <p class="control is-expanded has-icons-left">
                <input class="input" type="text" placeholder="Pseudo" required>
                <span class="icon is-small is-left">
                    <i class="fa fa-user"></i>
                </span>
            </p>
        </div>

        <div class="field">
        <label class="label">Mot de passe</label>
            <p class="control is-expanded has-icons-left">
                <input class="input" type="password" placeholder="Mot de passe" required>
                <span class="icon is-small is-left">
                    <i class="fa fa-unlock-alt"></i>
                </span>
            </p>
        </div>
    </div>
    <br>
    <div class="field is-grouped is-grouped-centered">
        <p class="control">
            <input type="submit" value="Confirmer" class="button is-primary">
        </p>
        <p class="control">
            <input type="reset" value="Annuler" class="button is-light">
        </p>
    </div>
</form>