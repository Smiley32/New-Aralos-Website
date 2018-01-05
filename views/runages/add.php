<h1 class="title">Ajouter un runage</h1>

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
    <label class="label">Choix des sets (0 à 3)</label>
    <div class="columns">
        <div class="field column">
            <p class="control is-expanded">
                <input id="changeSet1" autocomplete="off" name="set1" class="input" type="text" oninput="searchSet(1)" placeholder="Fatale">
                <div class="dropdown-content" id="dropdownSet1" style="display: none;">

                </div>
            </p>
        </div>
        <div class="field column">
            <p class="control is-expanded">
                <input id="changeSet2" autocomplete="off" name="set2" class="input" type="text" oninput="searchSet(2)" placeholder="Lame">
                <div class="dropdown-content" id="dropdownSet2" style="display: none;">

                </div>
            </p>
        </div>
        <div class="field column">
            <p class="control is-expanded">
                <input id="changeSet3" autocomplete="off" name="set3" class="input" type="text" oninput="searchSet(3)">
                <div class="dropdown-content" id="dropdownSet3" style="display: none;">

                </div>
            </p>
        </div>
    </div>

    <label class="label">Choix des statistiques importantes</label>
    <div class="field columns">
        <div class="column">
            <div class="field">
                <p class="control is-expanded input-centered">
                    <br />
                    <input id="changeStat" autocomplete="off" class="input" type="text" oninput="searchStat()" placeholder="Attaque">
                    <div class="dropdown-content" id="dropdownStat" style="display: none;">

                    </div>
                </p>
            </div>
        </div>
        <div class="column">
            <div class="field">
                <p class="control is-expanded input-centered">
                    <br />
                    <input id="importance" autocomplete="off" class="input" type="number" max="3" min="1" value="1">
                </p>
            </div>
        </div>
        <div class="column">
            <div class="field">
                <p class="control is-expanded input-centered">
                    <br />
                    <input id="value" autocomplete="off" class="input" type="txt" placeholder="81%">
                </p>
            </div>
        </div>
    </div>
    <div class="control">
        <a class="button is-info" id="a-centered" onclick="addStat()">Ajouter la stat</a>
    </div>

    <div class="columns" id="stats">

    </div>

    <div class="field">
        <label class="label">Description du runage</label>
        <p class="control is-expanded">
            <textarea name="desc" class="textarea" placeholder="Écrivez ici une description du runage"></textarea>
        </p>
    </div>

    <div class="field is-grouped is-grouped-centered">
        <p class="control">
            <input name="submit" type="submit" value="Confirmer" class="button is-primary">
        </p>
        <p class="control">
            <input type="reset" value="Annuler" class="button is-light" onclick="resetStats()">
        </p>
    </div>
</form>

<script>

var nbStats = 0;

function resetStats() {
    document.getElementById("stats").innerHTML = "";
    nbStats = 0;
}

function changeStat(txt) {
    document.getElementById("changeStat").value = txt;
    document.getElementById("dropdownStat").style.display = "none";
    document.getElementById("dropdownStat").innerHTML = "";
}

function searchStat() {
    var txt = document.getElementById("changeStat").value;
    if(txt.length > 1) {
        txt = encodeURIComponent(txt);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if(xhttp.readyState == 4 && (xhttp.status == 200 || xhttp.status == 0)) {
                document.getElementById("dropdownStat").innerHTML = xhttp.responseText;
                document.getElementById("dropdownStat").style.display = "block";
            }
        };

        console.log(txt);
        xhttp.open("GET", "/runages/ajaxSearchStat?search=" + txt, true);
        xhttp.send();
    }
}

function addStat(nb) {
    var stat = document.getElementById("changeStat").value;
    var importance = document.getElementById("importance").value;
    var value = document.getElementById("value").value;
    if(stat.length > 1) {
        stat = encodeURIComponent(stat);
        importance = encodeURIComponent(importance);
        value = encodeURIComponent(value);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if(xhttp.readyState == 4 && (xhttp.status == 200 || xhttp.status == 0)) {
                if(xhttp.responseText) {
                    document.getElementById("stats").innerHTML += xhttp.responseText;
                    nbStats++;
                }
            }
        };

        xhttp.open("GET", "/runages/ajaxAddStat?name=" + stat + "&nb=" + nbStats  + "&value=" + value  + "&importance=" + importance, true);
        xhttp.send();
    }
}

function changeSet1(txt) {
    document.getElementById("changeSet1").value = txt;
    document.getElementById("dropdownSet1").style.display = "none";
    document.getElementById("dropdownSet1").innerHTML = "";
}

function changeSet2(txt) {
    document.getElementById("changeSet2").value = txt;
    document.getElementById("dropdownSet2").style.display = "none";
    document.getElementById("dropdownSet2").innerHTML = "";
}

function changeSet3(txt) {
    document.getElementById("changeSet3").value = txt;
    document.getElementById("dropdownSet3").style.display = "none";
    document.getElementById("dropdownSet3").innerHTML = "";
}

function searchSet(nb) {
    var txt = document.getElementById("changeSet" + nb).value;
    if(txt.length > 1) {
        txt = encodeURIComponent(txt);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if(xhttp.readyState == 4 && (xhttp.status == 200 || xhttp.status == 0)) {
                document.getElementById("dropdownSet" + nb).innerHTML = xhttp.responseText;
                document.getElementById("dropdownSet" + nb).style.display = "block";
            }
        };

        xhttp.open("GET", "/runages/ajaxGetSet?search=" + txt + "&nb=" + nb, true);
        xhttp.send();
    }
}

</script>
