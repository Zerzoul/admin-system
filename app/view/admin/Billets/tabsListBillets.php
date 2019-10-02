<table class="table table-hover">
    <thead>
    <tr>
        <th scope="col-2">#</th>
        <th scope="col">Statue</th>
        <th scope="col">Date</th>
        <th scope="col">Title</th>
        <th scope="col">Action</th>
    </tr>
    </thead>


    <?php
    foreach ($listBillet as $billet) {
        ?>

        <tbody>
        <tr>
            <th scope="row"><?= $billet->id ?></th>
            <td><?php echo $this->statueReport($billet); ?></td>

            <td><?php $date = new DateTime($billet->date_create);
                echo $date->format('d/m/Y à H:i'); ?></td>
            <td><?= $billet->title ?></td>
            <td>
                <a href="<?= $path ?>-<?= $billet->id ?>" class="text-light">
                    <button
                        <?php if (isset($actionBillet->id)) {
                            echo $billet->id === $actionBillet->id ? 'disabled' : '';
                        } ?>
                            class="btn btn-primary">
                        Voir
                    </button>
                </a>
            </td>
        </tr>
        </tbody>
        <?php
    }
    ?>

</table>