<div class="container col-10">
    <?php if (isset($error)) { ?>
        <div class="alert alert-danger">
            <?= $error ?>
        </div>
    <?php } ?>

    <form action="" method="POST">
        <div class="row form-group px-3">
            <select name="statue" class="form-control col-2" id="publication" required>
                <option value="">Statue Publication :</option>
                <option value="3" <?php if ($statue === '3') {
                    echo 'selected';
                } ?>>Brouillon
                </option>
                <option value="2" <?php if ($statue === '2') {
                    echo 'selected';
                } ?>>A valider
                </option>
                <option value="1" <?php if ($statue === '1') {
                    echo 'selected';
                } ?>>Publier
                </option>
            </select>
        </div>
        <div class="form-group">
            <?= $titleLabel ?>
            <?= $title ?>
        </div>
        <div class="form-group">
            <span>
                <?= $contentBilletTextarea ?>
            </span>
        </div>

        <div>
            <span>
                <?= $submit ?>
            </span>
        </div>

    </form>
</div>