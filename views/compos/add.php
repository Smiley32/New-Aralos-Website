<h1 class="title">Ajouter une compo</h1>

<div id="monsters" class=columns>

</div>

<form method="POST" action="/compos/add">

    <input type="text" name="monsters" id="hiddenMonsters" hidden />

    <label class="label">Choisir un monstre (il doit exister)</label>
    <div class="field has-addons">

        <p class="control is-expanded has-icons-left">
            <input id="toChange" autocomplete="off" name="familyName" class="input" type="text" oninput="searchMonster(this)" placeholder="Hina">
            <span class="icon is-small is-left">
                <i class="fa fa-user"></i>
            </span>
        </p>
        <div class="control">
            <a class="button is-info" onclick="addMonster()">Ajouter</a>
        </div>
    </div>
    <div class="dropdown-content" id="dropdown" style="display: none;">

    </div>

    <div class="field">
        <label class="label">Courte description de la compo</label>
        <p class="control is-expanded">
            <textarea name="shortDesc" class="textarea" placeholder="Écrivez ici une courte description de la compo"></textarea>
        </p>
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

<script>

var monstersCount = 0;
var currentMonsterName = "";

function addMonster() {
    if(monstersCount < 5) {
        var txt = document.getElementById("toChange").value;
        currentMonsterName = txt;
        txt = encodeURIComponent(txt);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if(xhttp.readyState == 4 && (xhttp.status == 200 || xhttp.status == 0)) {
                document.getElementById("monsters").innerHTML += xhttp.responseText;
                if(xhttp.responseText) {
                    document.getElementById("hiddenMonsters").value += ";" + currentMonsterName;
                    monstersCount++;
                }
            }
        };

        xhttp.open("GET", "/compos/ajaxAddMonster?name=" + txt, true);
        xhttp.send();
    }
}

function change(txt) {
    document.getElementById("toChange").value = txt;
    document.getElementById("dropdown").style.display = "none";
    document.getElementById("dropdown").innerHTML = "";
}

function searchMonster(element) {
    var txt = element.value;
    if(txt.length > 2) {
        txt = encodeURIComponent(txt);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if(xhttp.readyState == 4 && (xhttp.status == 200 || xhttp.status == 0)) {
                document.getElementById("dropdown").innerHTML = xhttp.responseText;
                document.getElementById("dropdown").style.display = "block";
            }
        };

        console.log(txt);
        xhttp.open("GET", "/compos/ajaxGetMonster?search=" + txt, true);
        xhttp.send();
    }
}

</script>
