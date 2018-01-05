<div class="column input-centered" style="max-width: 15rem;">
    <div class="card">
        <div class="card-image">
            <figure class="image">
                <img src="/images/bdd/<?php echo $monster['img_name']; ?>" alt="<?php echo $monster['m_name']; ?>" />
            </figure>
        </div>
        <div class="card-content">
            <p class="title is-4"><?php echo $monster['m_name']; ?></p>
            <?php echo $monster['m_shortDesc']; ?>
        </div>
        <div class="card-footer">
            <div class="card-footer-content has-text-centered">
                <span class="stars"><?php for($k = 0; $k < $monster['m_stars']; $k += 1) { ?> <i class="fa fa-star" aria-hidden="true"></i><?php } ?></span>
            </div>
        </div>
    </div>
</div>
