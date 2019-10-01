<h5><?= ucfirst($typeSelected) ?></h5>
<table class="table table-hover">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Statue</th>
        <th scope="col">Date</th>
        <th scope="col">Auteur</th>
        <th scope="col">Commentaire sur ?</th>
    </tr>
    </thead>


    <?php
    foreach ($listCom as $com) {
        ?>

        <tbody>
        <tr>
            <th scope="row"><?= $com->id ?></th>

            <td><?php echo $this->statueReport($com); ?></td>

            <td><?php $date = new DateTime($com->date);
                echo $date->format('d/m/Y à H:i'); ?></td>
            <td><?= $com->author ?></td>
            <td><?= $com->title ?></td>
            <td>
                <form action="<?= $path ?>-<?= $type ?>-<?= $com->post_id ?>" method="get">
                    <button type="submit" class="btn btn-primary " name="idCom" value="<?= $com->id ?>"
                        <?php if (isset($actionCom->id)) {
                            echo $com->id === $actionCom->id ? 'disabled' : '';
                        } ?>
                    >Voir
                    </button>
                </form>

            </td>
        </tr>
        </tbody>
        <?php
    }
    ?>

</table>