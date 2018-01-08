<?php foreach($families as $f) { ?>
<p class="title is-5"><?php echo $f['fa_name'] ?> - <?php for($i = 10; $i <= $f['fa_stars']; $i += 10) { ?> <i class="fa fa-star" aria-hidden="true"></i><?php } if($f['fa_stars'] % 10 != 0) { ?><i class="fa fa-star-half" aria-hidden="true"></i><?php } ?></p>
<div class="columns ligneMonstre is-mobile" style="overflow:auto;">
    <?php $i = 0; for($nb = 1; $nb <= 5; $nb++) {
        if(isset($monsters[$f['fa_id']][$i]) && $monsters[$f['fa_id']][$i]['m_type'] == $nb) { ?>
            <div class="column" style="min-width:10rem;">
                <div class="card">
                    <div class="card-image">
                        <figure class="image">
                            <img src="/images/bdd/<?php echo $monsters[$f['fa_id']][$i]['img_name']; ?>" alt="<?php echo $monsters[$f['fa_id']][$i]['m_name']; ?>" />
                        </figure>
                    </div>
                    <div class="card-content">
                        <p class="title is-4"><?php echo $monsters[$f['fa_id']][$i]['m_name']; ?></p>
                        <?php echo $monsters[$f['fa_id']][$i]['m_shortDesc']; ?>
                    </div>
                    <div class="card-footer">
                        <div class="card-footer-content has-text-centered">
                            <span class="stars"><?php for($k = 0; $k < $monsters[$f['fa_id']][$i]['m_stars']; $k += 1) { ?> <i class="fa fa-star" aria-hidden="true"></i><?php } ?></span>
                        </div>
                    </div>
                </div>
            </div>
        <?php $i++; } else { ?>
            <div class="column">
                <div class="card">
                    N'existe pas
                </div>
            </div>
        <?php }
    }?>
</div>
<?php } ?>
