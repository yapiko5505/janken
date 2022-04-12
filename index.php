<?php
    session_start();

    if(isset($_SESSION['userName'])) {
        header('location: game.php');
        exit;
    }
?>

<html>
    <?php require_once 'parts/header.php' ?>
    <body>
        <?php require_once 'parts/navibar.php' ?>
        <div class="container">
            <?php if(isset($_SESSION['errors'])): ?>
                <?php foreach ($_SESSION['errors'] as $error): ?>
                    <div class="alert alert-danger mt-3" role="alert">
                        <?php echo $error; ?>
                    </div>
                <?php endforeach; ?>
                <?php unset($_SESSION['errors']); ?>
            <?php endif; ?>
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

