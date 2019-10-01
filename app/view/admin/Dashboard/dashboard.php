<div class="justify-item-center">
    <h2>DashBoard</h2>
    <div class="border mb-2 p-1">
        <h3>Billets</h3>
        <p class="font-italic"> Ici vous pourrez écrire une vos <span class="font-weight-bold">billets</span> : <br/>
            Une "<span class="font-weight-bold">news</span>" qui vous permettra de prévenir vos lecteurs de différentes
            informations. <br/>
            Un "<span class="font-weight-bold">épisode</span>" pour continuer votre histoire.
        </p>
        <div>
            <h5>Billet en cours d'écriture</h5>
            <p> Vous avez <span class="font-weight-bold"><?= $billetRough->billetCount ?></span> Billet(s) en cours
                d'éciture.</p>
        </div>
        <div>
            <h5>Billet en cours de validation</h5>
            <p> Vous avez <span class="font-weight-bold"><?= $billetToValidate->billetCount ?></span> Billet(s) en cours
                de validation.</p>
        </div>
        <div>
            <h5>Billet publié</h5>
            <p> Vous avez <span class="font-weight-bold"><?= $billetPublished->billetCount ?></span> publier.</p>
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
        <p class="font-italic"> Ici vous pourrez manager les <span class="font-weight-bold">commentaires</span> de vos
            lecteurs : <br/>
        </p>
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
