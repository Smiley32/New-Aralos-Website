<?php foreach($families as $family) { ?>
    <span onclick="change('<?php echo $family['fa_name']; ?>')" class="dropdown-item">
        <?php echo $family['fa_name']; ?>
    </span>
<?php } ?>