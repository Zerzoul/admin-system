<div class="p-3 m-0">
    <div class="row justify-content-between">
        <div class="col-4">
            <p class="font-weight-bold p-0 m-0">
                Date de création
            </p>
            <p class="p-0 m-0">
                <?php $date = new DateTime($actionCom->date);
                echo $date->format('d/m/Y'); ?>
            </p>
        </div>
    </div>

    <div class="py-3">
        <div>
            <h5><?= $actionCom->title ?></h5>
        </div>
        <div>
            <p>
                <?= $actionCom->content ?>
            </p>
        </div>
        <div class="row justify-content-between mt-5 mx-1">
            <form method="post" action="<?= $checkCom ?>">
                <button type="submit" name="actionOnCom" value="valider" class="btn btn-success">Valider</button>
                <button type="submit" name="actionOnCom" value="ignorer" class="btn btn-danger">Ignorer</button>
            </form>
        </div>
    </div>
</div>
