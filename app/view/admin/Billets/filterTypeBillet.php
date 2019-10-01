<form action="" method="POST">
    <div class="row">

        <label for="typeCheck">Type : </label>

        <select name="type" class="form-control col-3" id="typeCheck" onchange="submit();">
            <option value="news" <?php if ($typeSelected == 'news') echo 'selected'; ?>>News</option>
            <option value="episodes" <?php if ($typeSelected == 'episodes') echo 'selected'; ?>>Episodes</option>
        </select>

    </div>
</form>