<h1 class="title">Choisir le monstre et la compo</h1>

<div class="columns">
    <div class="column input-centered" style="max-width:30rem;">
        <?php if(!$error) require_once('views/runages/ajaxGetRunage.php'); ?>
    </div>
    <div id="monsters" class="input-centered">

    </div>
</div>

<form method="POST" action="/runages/connect?id=<?php echo $_GET['id']; ?>">

    <input type="text" name="monster" id="hiddenMonster" hidden />

    <label class="label">Choisir un monstre (il doit exister)</label>
    <div class="field has-addons">

        <p class="control is-expanded has-icons-left">
            <input id="toChange" autocomplete="off" class="input" type="text" oninput="searchMonster(this)" placeholder="Hina">
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

    <br />

    <input type="text" name="compo" id="changeCompo" hidden />
    <label class="label">Choisir une compo</label>
    <div id="compos" class="dropdown-content">

    </div>

    <div class="field">
        <label class="label">Explication du runage sur ce monstre</label>
        <p class="control is-expanded">
            <textarea name="desc" class="textarea" placeholder="Écrivez ici une description"></textarea>
        </p>
    </div>

    <br />
    <div class="field is-grouped is-grouped-centered">
        <p class="control">
            <input type="submit" name="submit" value="Confirmer" class="button is-primary">
        </p>
        <p class="control">
            <input type="reset" value="Annuler" onclick="resetPage()" class="button is-light">
        </p>
    </div>
</form>

<script>

var monstersCount = 0;
var currentMonsterName = "";

function addMonster() {
    if(monstersCount < 1) {
        var txt = document.getElementById("toChange").value;
        currentMonsterName = txt;
        txt = encodeURIComponent(txt);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if(xhttp.readyState == 4 && (xhttp.status == 200 || xhttp.status == 0)) {
                document.getElementById("monsters").innerHTML += xhttp.responseText;
                if(xhttp.responseText) {
                    document.getElementById("hiddenMonster").value = currentMonsterName;
                    searchCompos();
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

var changed = false;
function changeCompo(txt) {
    if(!changed) {
        document.getElementById("changeCompo").value = txt;
        console.log("salut -" + txt + "-");
    }
}

function changeColor(element) {
    if(!changed) {
        element.style.backgroundColor = "#209cee";
        changed = true;
    }
}

function resetPage() {
    changed = false;
    monstersCount = 0;
    currentMonsterName = "";
    document.getElementById("dropdown").style.display = "none";
    document.getElementById("dropdown").innerHTML = "";
    document.getElementById("compos").innerHTML = "";
    document.getElementById("monsters").innerHTML = "";
}

function searchCompos() {
    var txt = document.getElementById("toChange").value;

    txt = encodeURIComponent(txt);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if(xhttp.readyState == 4 && (xhttp.status == 200 || xhttp.status == 0)) {
            document.getElementById("compos").innerHTML = xhttp.responseText;
            document.getElementById("compos").style.display = "block";
        }
    };

    console.log(txt);
    xhttp.open("GET", "/compos/ajaxSearchCompos?monster=" + txt, true);
    xhttp.send();
}

</script>
