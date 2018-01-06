<div class="card" style="max-width:30rem;">
    <div class="card-content">
        <?php foreach($sets as $set) { ?>
            <?php echo $set['set_name'], '<br />'; ?>
        <?php } ?>
        <hr />
        <?php foreach($stats as $stat) { ?>
            <div class="card" style="display:inline-block;">
                <div class="card-content">
                    <?php echo $stat['sl_name'] ?>
                    <hr />
                    <?php echo $importances[$stat['stat_importance']]; ?>
                    <?php if($stat['stat_value'] != NULL) { echo '<hr />Min ', $stat['stat_value']; } ?>
                </div>
            </div>
        <?php } ?>
        <hr />
        <?php echo $runage['ru_txt']; ?>
    </div>
</div>
