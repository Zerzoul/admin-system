<div class="justify-item-center">
    <h2>DashBoard</h2>
    <div class="border mb-2 p-1">
        <h3>Billets</h3>
        <div>
            <h5>Billet en cours d'écriture</h5>
            <p> Vous avez <span class="font-weight-bold"><?= $billetRough->postCount ?></span> Billet(s) en cours
                d'éciture.</p>
        </div>
        <div>
            <h5>Billet en cours de validation</h5>
            <p> Vous avez <span class="font-weight-bold"><?= $billetToValidate->postCount ?></span> Billet(s) en cours
                de validation.</p>
        </div>
        <div>
            <h5>Billet publié</h5>
            <p> Vous avez <span class="font-weight-bold"><?= $billetPublished->postCount ?></span> publier.</p>
        </div>
        <div>
            <a href="billets">
                <button class="btn btn-primary">
                    Billets
                </button>
            </a>
        </div>
    </div>
    <div class="border p-1">
        <h3>Commentaires</h3>
        <div>
            <h5>Nouveau commentaire</h5>
            <p> Vous avez <span class="font-weight-bold"><?= $newComment->commentCount ?></span> nouveau(x)
                commentaire(s) à valider</p>
        </div>
        <div>
            <h5>Commentaire signalé</h5>
            <p> Vous avez <span class="font-weight-bold"><?= $reportedComment->commentCount ?></span> commentaire(s)
                signaler</p>
        </div>
        <div>
            <a href="comments">
                <button class="btn btn-primary">
                    Commentaires
                </button>
            </a>
        </div>
    </div>
</div>
