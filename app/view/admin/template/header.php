<div class="row justify-content-between align-items-center m-0 bg-info text-white">
    <?php
    if (isset($_SESSION['admin'])) {
        ?>
        <div>
            <button type="button"
                    class="btn btn-info"
                    id="sidebarCollapse"
            >
                <svg style="width:40px;height:40px;" viewBox="0 0 24 24">
                    <path fill="#ffffff" d="M3,6H21V8H3V6M3,11H21V13H3V11M3,16H21V18H3V16Z"/>
                </svg>
            </button>

        </div>

        <div class="justify-content-end">
            <div class="col">
                Welcome <?= $_SESSION['admin'] ?> <a href="?action=deconnexion" class="text-warning stretched-link">Deconnexion</a>
            </div>
        </div>
        <?php
    }
    ?>
</div>