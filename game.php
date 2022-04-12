<?php
    session_start();

    define("DRAW", 0);
    define("COMPUTER_WIN", 1);
    define("USER_WIN", 2);

    // 入力されたユーザー名の取得
    $userName = isset($_POST['user_name']) ? $_POST['user_name'] : '';

    if(empty($userName) && isset($_SESSION['userName'])){
        $userName = $_SESSION['userName'];
    }

    // バリデーション
    $errorMessage = [];
    if(empty($userName)) {
        array_push($errorMessage, "ユーザー名が空です。ユーザー名を入力してください。");
    }

    if(8 < mb_strlen($userName)) {
        array_push($errorMessage, "ユーザー名は8文字以内で入力してください。");
    }

    if(0 < count($errorMessage)) {
        $_SESSION["errors"] = $errorMessage;
        header("location: index.php");
        exit;
    }

    $_SESSION['userName'] = $userName;

    $userHand = null;
    $computerHand = null;
    if(isset($_POST['user_hand'])){
        $userHand = $_POST['user_hand'];

        // コンピュータが出す手を決める
        $handTypes = ['rock', 'scissors', 'paper'];
        $handImages = ['rock' => 'images/janken_gu.png', 'scissors' => 'images/janken_choki.png', 'paper' => 'images/janken_pa.png'];

        $number = mt_rand(0,2);
        $computerHand = $handTypes[$number];

        $computerHandImage = $handImages[$handTypes[$number]];
        $userHandImage = $handImages[$userHand];

        $winnerFlag = DRAW;
        if($computerHand === $userHand) {
            } else if($computerHand === 'rock' && $userHand === 'scissors') {
                $winnerFlag = COMPUTER_WIN;
            } else if($computerHand === 'scissors' && $userHand === 'paper') {
                $winnerFlag = COMPUTER_WIN;
            } else if($computerHand === 'paper' && $userHand === 'rock') {
                $winnerFlag = COMPUTER_WIN;
            } else {
                $winnerFlag = USER_WIN;
            }

            // 回数のカウント
            $playCount = isset($_SESSION['count']) ? $_SESSION['count'] : 0;
            $playCount = $playCount + 1;
            $_SESSION['count'] = $playCount;

            $userWinCount = isset($_SESSION['userWinCount']) ? $_SESSION['userWinCount'] : 0;
            if($winnerFlag == USER_WIN) {
                $userWinCount = $userWinCount + 1;
                $_SESSION['userWinCount'] = $userWinCount;
            }

    }

    ?>


<html>
    <?php require_once 'parts/header.php' ?>
    <body>
        <?php require_once 'parts/navibar.php' ?>
        <script lang="javascript">
            function submitUserHand(hand){
                document.querySelector("#user_hand").value = hand;
                document.querySelector("#second_hand_form").submit();
            }
        </script>
        <div class="container">
            <?php if($userHand && $computerHand): ?>
            <div>
                <?php if($winnerFlag === 0): ?>
                    <div class="fs-2 blue text-danger">あいこです。</div>
                <?php elseif($winnerFlag === 1): ?>
                    <div class="fs-2 blue text-danger">コンピュータの勝ち</div>
                <?php elseif($winnerFlag === 2): ?>
                    <div class="fs-2 blue text-danger"><?php echo $userName; ?>さんの勝ち</div>
                <?php endif; ?>
                <div class="fs-4"><?php echo $playCount; ?>回のうち、<?php echo $userWinCount; ?>回勝ちました。</div>
            </div>
            <div class="d-flex justify-content-center align-items-center flex-column mt-2">
                <div class="border rounded p-3 mt-2">
                    <img src="<?php echo $computerHandImage; ?>" width="100" class="rounded">
                </div>
                <div class="d-flex justify-content-center fs-2 mt-1 mb-1">
                    VS
                </div>
                <div class="border rounded p-3">
                    <img src="<?php echo $userHandImage; ?>" width="100" class="rounded">
                </div>
            </div>
            <?php else: ?>
                <div class="fs-2 blue text-danger">手を選んでください。</div>
            <?php endif; ?>
            <form method="post" action="game.php" id="select_hand_form">
                <input type="hidden" name="user_hand" id="user_hand" value="">
                <div class="d-flex justify-content-evenly mt-5">
                    <button class="btn btn-outline-primary" onclick="submitUserHand(`rock`);">
                        <img src="images/janken_gu.png" width="80" class="rounded">
                    </button>
                    <button class="btn btn-outline-primary" onclick="submitUserHand(`scissors`);">
                        <img src="images/janken_choki.png" width="80" class="rounded">
                    </button>
                    <button class="btn btn-outline-primary" onclick="submitUserHand(`paper`);">
                        <img src="images/janken_pa.png" width="80" class="rounded">
                    </button>
                </div>
            </form>
        </div>
    </body>
</html>