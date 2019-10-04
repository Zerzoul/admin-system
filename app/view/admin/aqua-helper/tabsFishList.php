<div class="container">
    <h5><?= $titleList ?></h5>
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Image</th>
            <th scope="col">Catégorie</th>
            <th scope="col">Nom latin</th>
            <th scope="col">Nom commun</th>
            <th scope="col">Régime Alimentaire</th>
            <th scope="col">Taille</th>
            <th scope="col">Température</th>
            <th scope="col">PH</th>
            <th scope="col">Gh</th>
            <th scope="col">volume mini</th>
            <th scope="col">Individu mini</th>
            <th scope="col">Prix</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <?php
        foreach ($getFishList as $fish) {
            ?>

            <tbody>
            <tr>
                <th scope="row"><?= $fish->id ?></th>
                <td><img src="<?= '../api/image_entity/'. $fish->file_id ?>" style="width: 50%"></td>
                <td><?= $fish->category_name ?></td>
                <td> <?= $fish->latin_name ?></td>
                <td><?= $fish->commun_name ?></td>
                <td><?= $fish->regime ?></td>
                <td><?= $fish->size ?></td>
                <td><?= $fish->heat ?></td>
                <td><?= $fish->PH ?></td>
                <td><?= $fish->GH ?></td>
                <td><?= $fish->vol_mini ?></td>
                <td><?= $fish->individual_mini ?></td>
                <td><?= $fish->price.'&euro;' ?></td>
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