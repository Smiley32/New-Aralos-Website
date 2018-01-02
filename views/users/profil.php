
<div class="container">
<section class="hero is-info welcome is-small">
<div class="hero-body">
<div class="container">
  <h1 class="title">
    Bonjour <?php echo $_SESSION['pseudo']; ?> !
  </h1>
  <h2 class="subtitle">
    J'espère que tu passes une bonne journée !
  </h2>
</div>
</div>
</section>
<br />
<div class="columns">
<div class="column is-6">
    <section class="tile is-centered">
      <div class="card">
          <div class="card-content">
              <div class="content">
                  <p class="is-medium">
                      Pseudo : <?php echo $_SESSION['pseudo']; ?>
                  </p>
                  <p>
                      E-Mail : <?php echo $_SESSION['mail']; ?>
                  </p>
              </div>
          </div>
      </div>
    </section>
    <?php if($_SESSION['guild'] !== false) { ?>
        <br />
        <section class="tile is-centered">
          <div class="card">
              <div class="card-content">
                  <div class="content">
                      <p class="is-medium">
                          Guilde : <?php echo $_SESSION['guild']; ?>
                      </p>
                  </div>
              </div>
          </div>
        </section>
    <?php } ?>
  </div>
<div class="column is-6">
    <div class="tile is-centered">
        <figure class="image is-256x256 is-centered">
            <img src="/uploads/test.png">
        </figure>
    </div>
</div>
</div>
</div>
