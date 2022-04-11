<html>
    <?php require_once 'parts/header.php' ?>
    <body>
        <?php require_once 'parts/navibar.php' ?>
        <div class="container">
            <div class="d-flex justify-content-center">
                <img src="images/janken_boys.png" width="400">
            </div>
            <form class="d-flex justify-content-center" method="post" action="game.php">
                <div class="mt-3 col-5">
                    <label for="user_name" class="form-label">ユーザー名</label>
                    <input type="text" class="form-control" id="user_name" name="user_name">
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary mt-3 pl-3">始める</button>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>

