<?php foreach($compos as $compo) { ?>
    <span onclick="changeCompo('<?php echo $compo['comp_id']; ?>');changeColor(this);" class="dropdown-item">
        <?php foreach($compo['monsters'] as $monster) {
            echo ' | ', $monster['m_name'];
        } ?> |
        <?php echo $compo['cat_label']; ?>
    </span>
<?php } ?>
