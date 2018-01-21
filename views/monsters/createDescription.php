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

<form method="POST">
    <label class="label">Ajouter une catégorie</label>

    <input type="text" name="categories" id="inputCat" hidden />

    <div class="field has-addons">
        <p class="control is-expanded">
            <input class="input" id="catToChange" oninput="searchCategorie(this)" type="text" placeholder="Categorie">
        </p>
        <p class="control">
            <a class="button is-info" onclick="addTag()">Ajouter</a>
        </p>
    </div>
    <div class="dropdown-content" id="dropdownCat" style="display: none;">

    </div>

    <div id="tagList" class="field is-grouped is-grouped-multiline">

    </div>

    <label class="label">Ajouter des lieux d'obtention du monstre</label>

    <input type="text" name="places" id="inputPlaces" hidden />

    <div class="field has-addons">
        <p class="control is-expanded">
            <input class="input" id="placeToChange" oninput="searchPlace(this)" type="text" placeholder="Lieu">
        </p>
        <p class="control">
            <a class="button is-info" onclick="addPlace()">Ajouter</a>
        </p>
    </div>
    <div class="dropdown-content" id="dropdownPlace" style="display: none;">

    </div>

    <div id="placeList" class="field is-grouped is-grouped-multiline">

    </div>

    <div class="field">
        <label class="label">Description complète du monstre</label>
        <p class="control is-expanded">
            <textarea name="desc" class="textarea" placeholder="Écrivez ici une description du monstre"></textarea>
        </p>
    </div>

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

var tags = [];

function addTag() {
    tags.push(document.getElementById("catToChange").value);
    displayTags();
}

function displayTags() {
    document.getElementById("tagList").innerHTML = "";
    document.getElementById("inputCat").value = "";

    for(var i = 0; i < tags.length; i++) {
        document.getElementById("tagList").innerHTML += '<div class="control"><div class="tags has-addons"><span class="tag is-danger">' + tags[i] + '</span><a class="tag is-delete" onclick="removeTag(' + i + ')"></a></div></div>';
        document.getElementById("inputCat").value += " " + tags[i];
    }
}


function removeTag(index) {
    tags.splice(index, 1);
    displayTags();
}

function changeCat(txt) {
    document.getElementById("catToChange").value = txt;
    document.getElementById("dropdownCat").style.display = "none";
    document.getElementById("dropdownCat").innerHTML = "";
}

function changePlace(txt) {
    document.getElementById("placeToChange").value = txt;
    document.getElementById("dropdownPlace").style.display = "none";
    document.getElementById("dropdownPlace").innerHTML = "";
}

function searchPlace(element) {
    var txt = element.value;
    if(txt.length > 2) {
        txt = encodeURIComponent(txt);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if(xhttp.readyState == 4 && (xhttp.status == 200 || xhttp.status == 0)) {
                document.getElementById("dropdownPlace").innerHTML = xhttp.responseText;
                document.getElementById("dropdownPlace").style.display = "block";
            }
        };

        console.log(txt);
        xhttp.open("GET", "/monsters/ajaxGetPlace?search=" + txt, true);
        xhttp.send();
    }
}

function searchCategorie(element) {
    var txt = element.value;
    if(txt.length > 2) {
        txt = encodeURIComponent(txt);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if(xhttp.readyState == 4 && (xhttp.status == 200 || xhttp.status == 0)) {
                document.getElementById("dropdownCat").innerHTML = xhttp.responseText;
                document.getElementById("dropdownCat").style.display = "block";
            }
        };

        console.log(txt);
        xhttp.open("GET", "/compos/ajaxGetCategorie?search=" + txt, true);
        xhttp.send();
    }
}

</script>
