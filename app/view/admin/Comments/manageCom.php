<div class="border rounded p-2 mr-1 col-7">
    <?php require 'tabsListComments.php'; ?>
</div>


<?php
if (!$isIdNull) {
    ?>
    <div class="border sticky-top rounded p-2 col">
        <?php require 'actionOnComments.php'; ?>
    </div>
    <?php
}
?>

