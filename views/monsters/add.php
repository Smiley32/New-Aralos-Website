<form method="POST">
    <div class="field-body">
        <div class="field">
            <label class="label">Nom propre du monstre</label>
            <p class="control is-expanded has-icons-left">
                <input name="name" class="input" type="text" placeholder="Galion" required>
                <span class="icon is-small is-left">
                    <i class="fa fa-user"></i>
                </span>
            </p>
        </div>

        <div class="field">
            <label class="label">Nom anglais (facultatif)</label>
            <p class="control is-expanded has-icons-left">
                <input name="englishName" class="input" type="text" placeholder="Galleon">
                <span class="icon is-small is-left">
                    <i class="fa fa-user"></i>
                </span>
            </p>
        </div>
    </div>
    <br>
    <div class="field">
        <label class="label">Étoiles naturelles</label>
        <p class="control has-icons-left">
            <span class="select">
                <select>
                    <option>2 étoiles</option>
                    <option selected>3 étoiles</option>
                    <option>4 étoiles</option>
                    <option>5 étoiles</option>
                </select>
            </span>
            <span class="icon is-small is-left">
                <i class="fa fa-star"></i>
            </span>
        </p>
    </div>

    <div class="field">
        <label class="label">Type du monstre</label>
        <p class="control">
            <span class="select">
                <select>
                    <option selected>Vent</option>
                    <option>Feu</option>
                    <option>Eau</option>
                    <option>Light</option>
                    <option>Dark</option>
                </select>
            </span>
        </p>
    </div>

    <div class="field">
        <label class="label">Famille</label>
        <p class="control">
            <span class="select">
                <select>
                    <option selected>Choisir une famille</option>
                    <option>Amazones</option>
                    <option>Pirates</option>
                    <option>Ajouter une famille</option>
                </select>
            </span>
        </p>
    </div>

    <div class="field">
        <label class="label">Création d'une famille</label>
        <p class="control is-expanded has-icons-left">
            <input name="familyName" class="input" type="text" placeholder="Amazones">
            <span class="icon is-small is-left">
                <i class="fa fa-users"></i>
            </span>
        </p>
    </div>

    <div class="field">
        <label class="label">Icone du monstre (PNG 102x102)</label>
        <div class="file is-info has-name is-boxed">
            <label class="file-label">
            <input class="file-input" type="file" name="file" id="upload" accept="image/PNG" onChange="changeName()">
            <span class="file-cta">
                <span class="file-icon">
                    <i class="fa fa-cloud-upload"></i>
                </span>
                <span class="file-label">
                    Icone
                </span>
            </span>
            <span class="file-name" id="fileName">
                Aucun fichier sélectionné
            </span>
            </label>
        </div>
    </div>

    <div class="field">
        <label class="label">Courte description du monstre</label>
        <p class="control is-expanded">
            <textarea class="textarea" placeholder="Écrivez ici une courte description du monstre"></textarea>
        </p>
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

<script>

function changeName() {
    var fullPath = document.getElementById('upload').value;
    if(fullPath) {
        var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
        var filename = fullPath.substring(startIndex);
        if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
            filename = filename.substring(1);
        }

        document.getElementById('fileName').innerHTML = filename;
    }
}

</script>