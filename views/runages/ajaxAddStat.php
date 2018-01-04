<div class="column">
    <div class="card" style="max-width:150px;">
        <div class="card-content">
            <input type="number" name="stat<?php echo $_GET['nb']; ?>" value="<?php echo $statID; ?>" hidden />
            <?php echo $_GET['name']; ?>
            <hr />
            <?php echo $importances[$importance]; ?>
            <?php if($value != NULL) { echo '<hr />Min ', $value; } ?>
        </div>
    </div>
</div>
