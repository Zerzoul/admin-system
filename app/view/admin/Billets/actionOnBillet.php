<div class="p-3 m-0">
    <div class="row justify-content-between">
        <div class="col-4 ">
            <p class="font-weight-bold p-0 m-0">
                Date de création
            </p>
            <p class="p-0 m-0">
                <?php $date = new DateTime($actionBillet->date_create);
                echo $date->format('d/m/Y'); ?>
            </p>
        </div>

        <?php
        if (!is_null($actionBillet->date_modif)) {
            ?>
            <div class="text-right">
                <p class="font-weight-bold m-0">Date de modification</p>
                <p class="p-0 m-0">  <?php $date = new DateTime($actionBillet->date_modif);
                    echo $date->format('d/m/Y'); ?></p>
            </div>
            <?php
        }
        ?>
    </div>
    <div class="py-3">
        <img src="<?= '../api/image_entity/'. $actionBillet->file_id ?>" style="width: 50%" >
        
    </div>

    <div class="py-3">
        <div>
            <h5><?= $actionBillet->title ?></h5>
        </div>
        <div>
            <p>
                <?= (substr(strip_tags($actionBillet->content), 0, 200)) ?>...

            </p>
        </div>
    </div>




    <div class="row justify-content-between mt-5 mx-1">
        <a href="<?= $linkAction1 ?>-<?= $actionBillet->id ?>">
            <button type="button" class="btn btn-warning"><?= $bouton1 ?></button>
        </a>
        <a href="<?= $linkAction2 ?>-<?= $actionBillet->id ?>">
            <button type="button" class="btn btn-danger"><?= $bouton2 ?></button>
        </a>
    </div>

</div>
