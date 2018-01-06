<h1 class="title">Hina</h1>

<div class="card">
    <div class="tabs">
        <ul>
            <li id="monsterLi" class="is-active"><a onclick="activate('monster')">Monstre</a></li>
            <li id="skillLi"><a onclick="activate('skill')">Compétences</a></li>
            <li id="obtentionLi"><a onclick="activate('obtention')">Obtention</a></li>
        </ul>
    </div>
    <div class="content columns" id="monster">
        <div class="column" style="max-width:15rem;">
            <div class="card" style="margin-left:1rem;">
                <div class="card-image">
                    <figure class="image">
                        <img src="/images/bdd/0e09fc30f134f09a146de1f707a8e1aa" alt="Hina" />
                    </figure>
                </div>
                <div class="card-content">
                    <p class="title is-4">Hina</p>
                    La courte description du monstre
                </div>
                <div class="card-footer">
                    <div class="card-footer-content has-text-centered">
                        <span class="stars"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="tile column">
            <div class="content">
                Ici, on peut décrire mieux le monstre.
                <br />&nbsp;<br />
                Par exemple, ceci est un premier paragraphe, qui pourrait parler de combien ce monstre est génial, autant en PVE qu'en PVP. En plus, ses skills sont surpuissant, et son skin adorable. C'est en effet mon monstre préféré (de loin), ainsi que sûrmenet celui de bon nombre d'invocateurs !
            </div>
        </div>
    </div>
    <div class="content columns" id="skill" style="display:none;">
        <div class="column" style="max-width:15rem;">
            <div class="card" style="margin-left:1rem;">
                <div class="card-image">
                    <figure class="image">
                        <img src="/images/bdd/0e09fc30f134f09a146de1f707a8e1aa" alt="Hina" />
                    </figure>
                </div>
                <div class="card-content">
                    <p class="title is-4">Hina</p>
                    La courte description du monstre
                </div>
                <div class="card-footer">
                    <div class="card-footer-content has-text-centered">
                        <span class="stars"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="tile column">
            Test
        </div>
    </div>
    <div class="content" id="obtention" style="display:none;">
        Autre test : les lieux d'obtention
    </div>
    <div class="card-footer">
        <figure class="image is-64x64" style="margin:1rem;">
            <img src="/images/bdd/3e5fdc1f543b4c9f25ef315d1ea6f165" alt="User" />
        </figure>
        <span style="margin:2rem;margin-left:0;">- ArtenixBlack</span>
    </div>
</div>

<script>

function activate(id) {
    document.getElementById("monster").style.display = "none";
    document.getElementById("skill").style.display = "none";
    document.getElementById("obtention").style.display = "none";

    document.getElementById("monsterLi").className = "";
    document.getElementById("skillLi").className = "";
    document.getElementById("obtentionLi").className = "";
    // document.getElementById(id + "Li").classList.remove("is-active");

    document.getElementById(id).style.display = "flex";
    document.getElementById(id + "Li").className = "is-active";
    // document.getElementById(id + "Li").classList.add("is-active");
}

</script>
