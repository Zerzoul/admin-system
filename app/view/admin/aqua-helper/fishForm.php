<div class="container col-10">
    <?php if (isset($error)) { ?>
        <div class="alert alert-danger">
            <?= $error ?>
        </div>
    <?php } ?>

    <form action="checkFish" method="POST" enctype="multipart/form-data">
        <div class="row form-group px-3">
            <div class="col px-2">
                <?= $category_Label ?>
                <?= $category ?>
            </div>
            <div class="col px-2">
                <?= $commun_name_Label ?>
                <?= $commun_name ?>
            </div>
            <div class="col px-2">
                <?= $latin_name_Label ?>
                <?= $latin_name ?>
            </div>
        </div>
        <div class="row form-group px-3">
            <div class="col px-2">
                <?= $regime_Label ?>
                <select id="regime" name="regime" class="form-control" required>
                    <option value="carnivore">Carnivore</option>
                    <option value="omnivore">Omnivore</option>
                    <option value="herbivore">Herbivore</option>
                </select>
            </div>
            <div class="col px-2">
                <?= $size_Label ?>
                <?= $size ?>
            </div>
            <div class="col px-2">
                <?= $vol_mini_Label ?>
                <?= $vol_mini ?>
            </div>
            <div class="col px-2">
                <?= $individual_mini_Label ?>
                <?= $individual_mini ?>
            </div>
        </div>
        <div class="row form-group px-3">
            <div class="col px-2">
                <?= $ph_Label ?>
                <?= $ph ?>
            </div>
            <div class="col px-2">
                <?= $gh_Label ?>
                <?= $gh ?>
            </div>
            <div class="col px-2">
                <?= $heat_mini_Label ?>
                <?= $heat_mini ?>
            </div>
            <div class="col px-2">
                <?= $heat_max_Label ?>
                <?= $heat_max ?>
            </div>
        </div>
        <div class="form-group">
            <span>
                <?= $contentDetailTextarea ?>
            </span>
        </div>

        <div class="form-group">
            <?= $upload_photo_Label ?>
            <?= $upload_photo ?>
        </div>
        <div class="form-group">
            <?= $price_Label ?>
            <?= $price ?>
        </div>

        <div>
            <span>
                <?= $submit ?>
            </span>
        </div>

    </form>
</div>