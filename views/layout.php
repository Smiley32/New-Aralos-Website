<DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $title; ?></title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.1/css/bulma.min.css">
        <link rel="stylesheet" href="/views/custom.css">
    </head>
    <body class="layout-default">
        <div class="container">
            <nav class="navbar" role="navigation" aria-label="main navigation">
                <div class="navbar-brand">
                    <a class="navbar-item" href="/">
                        Aralos
                    </a>
                    <button class="button navbar-burger" data-target="navMenu">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
                <div class="navbar-menu" id="navMenu">
                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link" href="/monsters/list">Monstres</a>
                        <div class="navbar-dropdown is-packed">
                            <a class="navbar-item" href="/monsters/list">Liste</a>
                            <a class="navbar-item" href="/monsters/add">Nouveau</a>
                        </div>
                    </div>
                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link" href="/plus/contact">Plus</a>
                        <div class="navbar-dropdown is-packed">
                            <a class="navbar-item" href="/plus/contact">Contact</a>
                            <a class="navbar-item" href="/plus/site">Le site</a>
                        </div>
                    </div>
                    <div class="navbar-end">
                        <div class="navbar-item has-dropdown is-mega">
                            <a class="icon navbar-link" onclick="showLogin()"><i class="fa fa-user fa-2x"></i></a>
                            <div class="navbar-dropdown coMenu">
                                <div class="container is-fluid">
                                    <?php echo $coMenu; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <?php if(isset($_SESSION['message'])) { ?>
                <article class="message is-<?php echo $_SESSION['messageType'] == 'error' ? 'danger' : 'success'; ?>">
                    <div class="message-header">
                        <p><?php echo $_SESSION['messageType'] == 'error' ? 'Erreur' : 'Succès'; ?></p>
                        <button class="delete" aria-label="delete"></button>
                    </div>
                    <div class="message-body">
                        <?php echo $_SESSION['message']; ?>
                    </div>
                </article>
            <?php unset($_SESSION['message']); } ?>

            <?php echo $body; ?>
        </div>

        <script>



var msgs = document.getElementsByClassName("delete");
for(var i = 0, len = msgs.length; i < len; i++) {
  msgs[i].onclick = function() {
      this.parentElement.parentElement.style.display = "none";
  }
}

function hide() {

}

var resetButton = document.getElementById("coReset");
if(resetButton !== null) {
    resetButton.onclick = showLogin;
}

function showLogin() {
    if(document.getElementsByClassName("coMenu")[0].style.display == "none") {
        document.getElementsByClassName("coMenu")[0].style.display = "block";
    } else {
        document.getElementsByClassName("coMenu")[0].style.display = "none";
    }
}

document.addEventListener('DOMContentLoaded', function () {

    // Get all "navbar-burger" elements
    var $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

    // Check if there are any navbar burgers
    if ($navbarBurgers.length > 0) {

    // Add a click event on each of them
    $navbarBurgers.forEach(function ($el) {
        $el.addEventListener('click', function () {

        // Get the target from the "data-target" attribute
        var target = $el.dataset.target;
        var $target = document.getElementById(target);

        // Toggle the class on both the "navbar-burger" and the "navbar-menu"
        $el.classList.toggle('is-active');
        $target.classList.toggle('is-active');

        });
    });
    }

});
        </script>
    </body>
</html>
