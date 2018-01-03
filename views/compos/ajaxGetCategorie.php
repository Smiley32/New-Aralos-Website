<?php foreach($categories as $cat) { ?>
    <span onclick="changeCat('<?php echo $cat['cat_label']; ?>')" class="dropdown-item">
        <?php echo $cat['cat_label']; ?>
    </span>
<?php } ?>
