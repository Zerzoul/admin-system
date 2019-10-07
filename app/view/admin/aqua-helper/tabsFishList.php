<div class="col-7">
    <h5><?= $titleList ?></h5>


        <?php if($notfication){?>
    <div id="notfication" class="alert alert-success">
        <h3>
            <small class="d-flex justify-content-center ">
                <?= $message ?>
            </small>
        </h3>
    </div>
        <?php }?>

    <table class="table table-hover">
        <thead>
        <tr>
            <th class="col">#</th>
            <th class="col">Image</th>
            <th class="col">Catégorie</th>
            <th class="col">Nom commun</th>
            <th class="col">Régime Alimentaire</th>
            <th class="col">Taille</th>
            <th class="col">Température</th>
            <th class="col">PH</th>
            <th class="col">Gh</th>
            <th class="col">volume mini</th>
            <th class="col">Individu mini</th>
            <th class="col">Prix</th>
            <th class="col"></th>
            <th class="col"></th>
        </tr>
        </thead>
        <?php
        foreach ($getFishList as $fish) {
            ?>

            <tbody>
            <tr>
                <th scope="row"><?= $fish->id ?></th>
                <td><img src="<?= '../api/image_entity/' . $fish->file_id ?>" style="width: 50%"></td>
                <td><?= $fish->category_name ?></td>
                <td><?= $fish->commun_name ?></td>
                <td><?= $fish->regime ?></td>
                <td><?= $fish->size . ' cm' ?></td>
                <td><?= $fish->heat . '°C' ?></td>
                <td><?= $fish->PH ?></td>
                <td><?= $fish->GH ?></td>
                <td><?= $fish->vol_mini ?></td>
                <td><?= $fish->individual_mini ?></td>
                <td><?= $fish->price . '&euro;' ?></td>
                <td>
                    <a href="updatefishlist-<?= $fish->id ?>">
                        <button type="button" class="btn btn-primary">Editer</button>
                    </a>
                </td>
                <td>
                    <a href="deletefishlist-<?= $fish->id ?>">
                        <button type="button" class="btn btn-danger">Suprimer</button>
                    </a>
                </td>

            </tr>
            </tbody>
            <?php
        }
        ?>

    </table>

</div>
<script>
const notification = document.getElementById('notfication');
setTimeout(() =>{
    notification.style.display = 'none';
}, 5000)
</script>