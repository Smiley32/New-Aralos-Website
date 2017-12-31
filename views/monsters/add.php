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
            Le monstre a été ajouté correctement !
        </div>
    </article>
<?php } ?>

<form method="POST" enctype="multipart/form-data">
    <div class="field-body">
        <div class="field">
            <label class="label">Nom propre du monstre</label>
            <p class="control is-expanded has-icons-left">
                <input name="name" class="input" type="text" placeholder="Galion" value="<?php if($post) echo $_POST['name']; ?>" required>
                <span class="icon is-small is-left">
                    <i class="fa fa-user"></i>
                </span>
            </p>
        </div>

        <div class="field">
            <label class="label">Nom anglais (facultatif)</label>
            <p class="control is-expanded has-icons-left">
                <input name="englishName" class="input" type="text" placeholder="Galleon" value="<?php if($post) echo $_POST['englishName']; ?>">
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
                <select name="stars">
                    <option value="1">1 étoile</option>
                    <option value="2">2 étoiles</option>
                    <option value="3" selected>3 étoiles</option>
                    <option value="4">4 étoiles</option>
                    <option value="5">5 étoiles</option>
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
                <select name="type">
                    <option value="1" selected>Vent</option>
                    <option value="3">Feu</option>
                    <option value="2">Eau</option>
                    <option value="4">Lumière</option>
                    <option value="5">Ténèbre</option>
                </select>
            </span>
        </p>
    </div>

    <div class="field">
        <label class="label">Chosir une famille (elle sera créée si elle n'exsite pas)</label>
        <p class="control is-expanded has-icons-left">
            <input id="toChange" autocomplete="off" name="familyName" class="input" type="text" oninput="searchFamily(this)" placeholder="Amazones" value="<?php if($post) echo $_POST['familyName']; ?>">
            <span class="icon is-small is-left">
                <i class="fa fa-users"></i>
            </span>
            <div class="dropdown-content" id="dropdown" style="display: none;">
                
            </div>
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
            <textarea name="shortDesc" class="textarea" placeholder="Écrivez ici une courte description du monstre"><?php if($post) echo $_POST['shortDesc']; ?></textarea>
        </p>
    </div>
    <br>
    <div class="field is-grouped is-grouped-centered">
        <p class="control">
            <input type="submit" name="submit" value="Confirmer" class="button is-primary">
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

function change(txt) {
    document.getElementById("toChange").value = txt;
    document.getElementById("dropdown").style.display = "none";
    document.getElementById("dropdown").innerHTML = "";
}

function searchFamily(element) {
    var txt = element.value;
    if(txt.length > 2) {
        txt = encodeURIComponent(txt);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if(xhttp.readyState == 4 && (xhttp.status == 200 || xhttp.status == 0)) {
                console.log("reçu : " + xhttp.responseText);
                document.getElementById("dropdown").innerHTML = xhttp.responseText;
                document.getElementById("dropdown").style.display = "block";
            }
        };

        console.log(txt);
        xhttp.open("GET", "/monsters/ajax?search=" + txt, true);
        xhttp.send();
    }
}

</script>