<?php foreach($places as $p) { ?>
    <span onclick="changePlace('<?php echo $p['p_name']; ?>')" class="dropdown-item">
        <?php echo $p['p_name']; ?>
    </span>
<?php } ?>
