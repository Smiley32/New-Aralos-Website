<h1 class="title">Liste des monstres</h1>

<div class="field has-addons">
    <p class="control is-expanded has-icons-left">
        <input id="searchTxt" class="input" type="text" placeholder="Recherche">
        <span class="icon is-small is-left">
            <i class="fa fa-search"></i>
        </span>
    </p>
    <div class="control">
        <a class="button is-info" onclick="recherche(<?php echo $page; ?>)">Rechercher</a>
  </div>
</div>

<div id="results">

</div>

<?php if($page > 1) { ?>
    <a href="/monsters/list?page=<?php echo $page-1; ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
<?php }
echo $page; ?>
<a href="/monsters/list?page=<?php echo $page+1; ?>"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>


<script>

recherche(<?php echo $page; ?>);

function recherche(page) {
    var txt = document.getElementById("searchTxt").value;
    txt = encodeURIComponent(txt);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if(xhttp.readyState == 4 && (xhttp.status == 200 || xhttp.status == 0)) {
            document.getElementById("results").innerHTML = xhttp.responseText;
        }
    };

    console.log(txt);
    xhttp.open("GET", "/monsters/ajaxlist?search=" + txt + "&page=" + page, true);
    xhttp.send();
}

</script>
