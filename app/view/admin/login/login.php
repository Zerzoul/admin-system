<div class="container">
    <div class="col-md-6 offset-md-3">
        <h2>Admin Manager</h2>
        <div>
            <?= $errorMessage ?>
        </div>
        <div>
            <form action="" method="post">
                <div class="form-group">
                    <?= $nameLabel ?>
                    <?= $name ?>
                </div>
                <div class="form-group">
                    <?= $passLabel ?>
                    <?= $pass ?>
                </div>
                <div class="form-group">
                    <?= $submit ?>
                </div>
            </form>
        </div>
    </div>
</div>