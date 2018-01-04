<?php foreach($sets as $set) { ?>
    <span onclick="changeSet<?php echo $_GET['nb'], '(\'', $set['set_name']; ?>')" class="dropdown-item">
        <?php echo $set['set_name']; ?>
    </span>
<?php } ?>
