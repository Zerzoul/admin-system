<!DOCTYPE html>
<html>
<head>

    <meta charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/Billet-simple-Pour-Alaska/Public/css/admin.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    <script src="https://cdn.tiny.cloud/1/1tfphb8xnzzjkde7ncwbl7z8yu6qlf29l0ml53t1jnk5lbbi/tinymce/5/tinymce.min.js"></script>
    <script>tinymce.init({selector: 'textarea'});</script>
    <title>Admin Manager</title>
</head>
<body>

<div class="container-fluid p-0 mh-100"">
    <div class="row p-0 m-0 w-auto d-flex align-items-stretch">
            <div id="sidebar" class="d-none col-2 p-0">
                <?php
                if (isset($_SESSION['admin'])) {
                    ?>
                    <nav>
                        <?php include 'nav.php'; ?>
                    </nav>
                    <?php
                }
                ?>
            </div>
            <div id="content" class="col p-0 pb-5">
                <div>
                    <?php include 'header.php'; ?>
                </div>
                <section class="container-fluid mt-5 ">
                    <?= $content ?>
                </section>
            </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('d-block');
            $('#content').toggleClass('col-10');
        });
    });
</script>
</body>
</html>