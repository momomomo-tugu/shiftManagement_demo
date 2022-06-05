<?php
    function h($s) {
        return htmlspecialchars($s, ENT_QUOTES);
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=yes, maximum-scale=1, minimum-scale=1">
    <title>関根和三郎商店 | 週間シフト追加確認</title>
    <link rel="stylesheet" href="../../css/html5reset-1.6.1.css">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <header class="header">
        <h1 class="header__title"><a href="../../itiran/itiran_controller/itiran_index.php" class="mainTitle">関根和三郎商店</a></h1>
        <!-- リンクリスト -->
        <div class="index__linklist">
            <a href="../../regularShift/regularShift_controller/regularShift_DispView.php" class="index__linklist__linkbox__link">曜日で追加</a>
            <a href="../../dayShift/dayShift_controller/dayShift_DispView.php" class="index__linklist__linkbox__link">日時で追加</a>
            <a href="../../delete/delete_controller/delete_DispView.php" class="index__linklist__linkbox__link">シフトを削除</a>
        </div>
        <!-- /リンクリスト -->
        <!-- ハンバーガーメニュー -->
        <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <nav class="globalMenuSp">
            <ul>
                <li>
                        <a href="../../regularShift/regularShift_controller/regularShift_DispView.php" class="index__linklist__linkbox__link">曜日で追加</a>
                </li>
                <li>
                    <a href="../../dayShift/dayShift_controller/dayShift_DispView.php" class="index__linklist__linkbox__link">日時で追加</a>
                </li>
                <li>
                    <a href="../../delete/delete_controller/delete_DispView.php" class="index__linklist__linkbox__link">シフトを削除</a>
                </li>
            </ul>
        </nav>
        <!-- ハンバーガーメニュー -->
    </header>

    <div class="container">
        <?php 
            if($errorMessage !== ''){
                echo $errorMessage;
        ?>
            <form>
                <input type="button" onclick="history.back()" value="戻る">
            </form>
        <?php } else { ?>
            <p>
                <?php
                    echo $all_staff[$dayshift_name]['name'] . 'さん';
                ?>
            </p>
            <p>
                <?php echo h($dayshift_month) ?>月
                <?php echo h($dayshift_day) ?>日
            </p>
            <p>
                <?php echo h($dayshift_start_hour) ?> : <?php echo h($dayshift_start_minute) ?> ～
                <?php echo h($dayshift_finish_hour) ?> : <?php echo h($dayshift_finish_minute) ?>
            </p>

            

            <?php 
                $dayshift_times = array(array("start" => array($dayshift_start_hour, $dayshift_start_minute), "fin" => array($dayshift_finish_hour, $dayshift_finish_minute)), 
                );
            ?>

            <p>以上の内容を確認し、登録ボタンを押してください。</p>
            <form action="../dayShift_controller/dayShift_Register.php" method="post">
                <input type="hidden" name="dayshift_name" value="<?= $dayshift_name ?>">
                <input type="hidden" name="dayshift_month" value="<?= $dayshift_month ?>">
                <input type="hidden" name="dayshift_day" value="<?= $dayshift_day ?>">
                <input type="hidden" name="dayshift_times" value="<?= http_build_query($dayshift_times); ?>">
                <input type="submit" value="登録">
                <input type="button" onclick="history.back()" value="戻る">
            </form>
        <?php } ?>
    </div>

    <script src="../../js/jquery-3.5.1.min.js"></script>
    <script src="../../js/hamburger.js"></script>
            
</body>
</html>