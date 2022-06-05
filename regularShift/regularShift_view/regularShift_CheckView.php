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
                    echo $all_staff[$regularshift_name]['name'] . 'さん';
                ?>
            </p>
            <br />
            <p>
                <?php 
                    $regularshift_times = array(
                        "0" => array("start" => array(), "fin" => array()), 
                        "1" => array("start" => array(), "fin" => array()),
                        "2" => array("start" => array(), "fin" => array()),
                        "3" => array("start" => array(), "fin" => array()),
                        "4" => array("start" => array(), "fin" => array()),
                        "5" => array("start" => array(), "fin" => array()),
                        "6" => array("start" => array(), "fin" => array()),
                    );
                    $week = ['日', '月', '火', '水', '木', '金', '土'];
                    for($i = 1; $i < count($regularShift_day); $i++){
                        echo $week[$regularShift_day[$i]] . '  ';
                        if($regularShift_day[$i] == 1){
                            $regularshift_times["1"]["start"][] = $start_hour_1;
                            $regularshift_times["1"]["start"][] = $start_minute_1;
                            $regularshift_times["1"]["fin"][] = $fin_hour_1;
                            $regularshift_times["1"]["fin"][] = $fin_minute_1;
                            echo h($start_hour_1) . ':' . h($start_minute_1) . "～" . h($fin_hour_1) . ":" . h($fin_minute_1) . "<br /><br />";
                        } else if($regularShift_day[$i] == 2) {
                            $regularshift_times["2"]["start"][] = $start_hour_2;
                            $regularshift_times["2"]["start"][] = $start_minute_2;
                            $regularshift_times["2"]["fin"][] = $fin_hour_2;
                            $regularshift_times["2"]["fin"][] = $fin_minute_2;
                            echo h($start_hour_2) . ':' . h($start_minute_2) . "～" . h($fin_hour_2) . ":" . h($fin_minute_2) . "<br /><br />";                            
                        } else if($regularShift_day[$i] == 3) {
                            $regularshift_times["3"]["start"][] = $start_hour_3;
                            $regularshift_times["3"]["start"][] = $start_minute_3;
                            $regularshift_times["3"]["fin"][] = $fin_hour_3;
                            $regularshift_times["3"]["fin"][] = $fin_minute_3;
                            echo h($start_hour_3) . ':' . h($start_minute_3) . "～" . h($fin_hour_3) . ":" . h($fin_minute_3) . "<br /><br />";
                        } else if($regularShift_day[$i] == 4) {
                            $regularshift_times["4"]["start"][] = $start_hour_4;
                            $regularshift_times["4"]["start"][] = $start_minute_4;
                            $regularshift_times["4"]["fin"][] = $fin_hour_4;
                            $regularshift_times["4"]["fin"][] = $fin_minute_4;
                            echo h($start_hour_4) . ':' . h($start_minute_4) . "～" . h($fin_hour_4) . ":" . h($fin_minute_4) . "<br /><br />";
                        } else if($regularShift_day[$i] == 5) {
                            $regularshift_times["5"]["start"][] = $start_hour_5;
                            $regularshift_times["5"]["start"][] = $start_minute_5;
                            $regularshift_times["5"]["fin"][] = $fin_hour_5;
                            $regularshift_times["5"]["fin"][] = $fin_minute_5;
                            echo h($start_hour_5) . ':' . h($start_minute_5) . "～" . h($fin_hour_5) . ":" . h($fin_minute_5) . "<br /><br />";
                        } else if($regularShift_day[$i] == 6) {
                            $regularshift_times["6"]["start"][] = $start_hour_6;
                            $regularshift_times["6"]["start"][] = $start_minute_6;
                            $regularshift_times["6"]["fin"][] = $fin_hour_6;
                            $regularshift_times["6"]["fin"][] = $fin_minute_6;
                            echo h($start_hour_6) . ':' . h($start_minute_6) . "～" . h($fin_hour_6) . ":" . h($fin_minute_6) . "<br /><br />";
                        } else {
                            $regularshift_times["0"]["start"][] = $start_hour_0;
                            $regularshift_times["0"]["start"][] = $start_minute_0;
                            $regularshift_times["0"]["fin"][] = $fin_hour_0;
                            $regularshift_times["0"]["fin"][] = $fin_minute_0;
                            echo h($start_hour_0) . ':' . h($start_minute_0) . "～" . h($fin_hour_0) . ":" . h($fin_minute_0) . "<br /><br />";
                        }
                    }    
                ?>
            </p>
            <p>以上の内容を確認し、登録ボタンを押してください。</p>
            <form action="../regularShift_controller/regularShift_Register.php" method="post">
                <input type="hidden" name="regularshift_name" value="<?= $regularshift_name ?>">
                <input type="hidden" name="regularshift_day" value="<?= implode(',', $regularshift_day); ?>">
                <input type="hidden" name="regularshift_times" value="<?= http_build_query($regularshift_times); ?>">
                <input type="submit" value="登録">
                <input type="button" onclick="history.back()" value="戻る">
            </form>
        <?php } ?>
    </div>
           
    <script src="../../js/jquery-3.5.1.min.js"></script>
    <script src="../../js/hamburger.js"></script>

</body>
</html>