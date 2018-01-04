<?php foreach($stats as $stat) { ?>
    <span onclick="changeStat('<?php echo $stat['sl_name']; ?>')" class="dropdown-item">
        <?php echo $stat['sl_name']; ?>
    </span>
<?php } ?>
