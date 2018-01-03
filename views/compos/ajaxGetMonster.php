<?php foreach($monsters as $m) { ?>
    <span onclick="change('<?php echo $m['m_name']; ?>')" class="dropdown-item">
        <?php echo $m['m_name']; ?>
    </span>
<?php } ?>
