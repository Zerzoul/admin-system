<div class="border rounded p-2 mr-1 col-7">
    <?php require 'tabsListBillets.php'; ?>
</div>

<?php
if (!$isIdNull) {
    ?>
    <div class="border fixed rounded p-2 col">
        <?php require 'actionOnBillet.php'; ?>
    </div>
    <?php
}
?>

