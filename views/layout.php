<DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $title; ?></title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.1/css/bulma.min.css">
        <link rel="stylesheet" href="/views/custom.css">
    </head>
    <body>
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
            </div>
        </nav>

        <div class="container">
            <?php echo $body; ?>
        </div>

        <script>
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