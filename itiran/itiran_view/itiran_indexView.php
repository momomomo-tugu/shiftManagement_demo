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
    <title>関根和三郎商店 | シフト管理TOP</title>
    <link rel="stylesheet" href="../../css/html5reset-1.6.1.css">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

    <header class="header">
        <h1 class="header__title"><a href="#" class="mainTitle">関根和三郎商店</a></h1>
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

        <h2 class="subTitle">シフト管理</h2>

        <form action="itiran_index.php" method="POST">
            <div class="choiceName">
                <select name="index_choiced_name" class="choiceName__choiceform">
                    <?php
                        $all_staff[0] = array(
                            'id' => 0,
                            'name' => '全員'
                        );
                        foreach($all_staff as $staff){
                                if($staff['id'] == $name) {
                                    echo '<option value="' . $staff['id'] . '" selected>' . $staff['name'] . '</option>';
                                } else {
                                    echo '<option value="' . $staff['id'] . '">' . $staff['name'] . '</option>';
                            }
                            
                        }
                    ?>
                </select>
                <input type="submit" value="表示" class="choiceName__button">
            </div>
        </form>

        <div class="calendar__titlebox">
            <form action="itiran_index.php" method="GET">
                <input type="hidden" name="calendar_prev" value=<?= $month ?>>
                <input type="submit" value="<<">
            </form>
            <h3 class="calendar__title">― <?= $month ?>月 ―</h3>
            <form action="itiran_index.php" method="GET">
                <input type="hidden" name="calendar_next" value=<?= $month ?>>
                <input type="submit" value=">>">
            </form>
        </div>

        <?php
        ?>
        
        <!-- カレンダー -->
        <table class="calendar calendar__detail">
            <!-- 曜日 -->
            <tr class="calendar__youbiContainer">
                <!-- _model の $week から $youbi を取得 -->
                <?php foreach($week as $youbi){ ?>
                    <th class="calendar__youbiContainer__youbi">
                        <?php echo $youbi ?>
                    </th>
                <?php } ?>
            </tr>

            <!-- _model の $day_list から $weekdays を取得 -->
            <!-- $weekdays = 一週間分の日付リスト -->
            <?php foreach($day_list as $weekdays) { ?>
                <tr class="calendar__dayContainer calendar__dayContainer__detail">    
                    <?php 
                        // $weekdays から $day を取得
                        foreach($weekdays as $day) {
                            // 今日の日付
                            if($currentmonth == $month && $day == $today)  {
                    ?>  
                                <td class="calendar__dayContainer__day today calendar__dayContainer__day__detail">
                                    <!-- 日付を出力 -->
                                    <?= $day; ?>
                                    <!-- 名前と時間 -->
                                    <div class="calendar__dayContainer__day__whois">
                                        <?php 
                                            // 今日の日付__特定の人のシフト
                                            if($index_choiced_name != "0"){
                                                // 今日の日付__特定の人のシフト__臨時シフト
                                                foreach($dayshift_list as $dayshift) {
                                                    $flag = 0;
                                                    parse_str($dayshift['dayshift_times'], $dayshift_times);                                                    
                                                    if(($regularshift_list[0]['name'] == $dayshift['name']) && ($month == $dayshift['dayshift_month']) && ($dayshift['dayshift_day'] == $day)){
                                                        if(count($deleteshift_list) != 0) {
                                                            foreach($deleteshift_list as $deleteshift){
                                                                if(($month == $deleteshift['delete_month']) && ($day == $deleteshift['delete_day'])){
                                                                    $this -> deletedShift(
                                                                        '×', 
                                                                        $dayshift_times[0]
                                                                    );
                                                                    $flag = 1;
                                                                    break;
                                                                }
                                                            } 
                                                            if($flag != 1) {
                                                                $this -> scheduledShift(
                                                                    '〇', 
                                                                    $dayshift_times[0]
                                                                );
                                                            }
                                                        } else {
                                                            $this -> scheduledShift(
                                                                '〇', 
                                                                $dayshift_times[0]
                                                            );
                                                        }
                                                    }
                                                }
                                                // 今日の日付__特定の人のシフト__レギュラーシフト
                                                $regularshift_array = explode(',', $regularshift_list[0]['regularshift']);
                                                parse_str($regularshift_list[0]['regularshift_times'], $times);
                                                array_shift($regularshift_array);
                                                foreach($regularshift_array as $regularshift) {
                                                    $flag = 0;
                                                    if($day != '') {
                                                        if($weekdays[$regularshift] == $day){
                                                            if(count($deleteshift_list) != 0) {
                                                                foreach($deleteshift_list as $deleteshift){
                                                                    if(($month == $deleteshift['delete_month']) && ($day == $deleteshift['delete_day'])) {
                                                                        $this -> deletedShift_individual(
                                                                            $times[$regularshift]
                                                                        );
                                                                        $flag = 1;
                                                                        break;
                                                                    }
                                                                } 
                                                                if($flag != 1) {
                                                                    $this -> scheduledShift(
                                                                        '〇', 
                                                                        $times[$regularshift]
                                                                    );
                                                                }
                                                            } else {
                                                                $this -> scheduledShift(
                                                                    '〇', 
                                                                    $times[$regularshift]
                                                                );
                                                            }
                                                        }
                                                    }
                                                }
                                            } else {
                                                // 全員分
                                                // 今日の日付__全員分__臨時シフト
                                                foreach($dayshift_list as $dayshift) {
                                                    $flag = 0;
                                                    parse_str($dayshift['dayshift_times'], $dayshift_times);                                                    
                                                    if($month == $dayshift['dayshift_month'] and $day == $dayshift['dayshift_day']){
                                                        if(count($deleteshift_list) != 0) {
                                                            foreach($deleteshift_list as $deleteshift){
                                                                if(($all_staff[$dayshift['name']]['id'] == $deleteshift['name']) && ($month == $deleteshift['delete_month']) && ($day == $deleteshift['delete_day'])){
                                                                    $this -> deletedShift(
                                                                        $all_staff[$dayshift['name']]['name'], 
                                                                        $dayshift_times[0]
                                                                    );
                                                                    $flag = 1;
                                                                    break;
                                                                }
                                                            }
                                                            if($flag != 1) {
                                                                $this -> scheduledShift(
                                                                    $all_staff[$dayshift['name']]['name'], 
                                                                    $dayshift_times[0]
                                                                );
                                                                break;
                                                            }
                                                        } else {
                                                            $this -> scheduledShift(
                                                                $all_staff[$dayshift['name']]['name'], 
                                                                $dayshift_times[0]
                                                            );
                                                        }
                                                    }
                                                }
                                                // 今日の日付__全員分__レギュラーシフト
                                                foreach($regularshift_list as $regularshift) {
                                                    $flag = 0;
                                                    $regularshift_all = explode(',', $regularshift['regularshift']);
                                                    parse_str($regularshift['regularshift_times'], $times);
                                                    array_shift($regularshift_all);
                                                    foreach($regularshift_all as $regularshift_day) {
                                                        if($day != '') {
                                                            if($weekdays[$regularshift_day] == $day){
                                                                if(count($deleteshift_list) != 0) {
                                                                    foreach($deleteshift_list as $deleteshift){
                                                                        if(($all_staff[$regularshift['name']]['id'] == $deleteshift['name']) && ($month == $deleteshift['delete_month']) && ($day == $deleteshift['delete_day'])){
                                                                            $this -> deletedShift(
                                                                                $all_staff[$regularshift['name']]['name'], 
                                                                                $times[$regularshift_day]
                                                                            );
                                                                            $flag = 1;
                                                                            break;
                                                                        }
                                                                    } 
                                                                    if($flag != 1) {
                                                                        $this -> scheduledShift(
                                                                            $all_staff[$regularshift['name']]['name'], 
                                                                            $times[$regularshift_day]
                                                                        );
                                                                    }
                                                                } else {
                                                                    $this -> scheduledShift(
                                                                        $all_staff[$regularshift['name']]['name'], 
                                                                        $times[$regularshift_day]
                                                                    );
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        ?>
                                        </div>
                                </td>
                        <?php } else { ?>
                        <!-- 今日の日付以外 -->
                        <td class="calendar__dayContainer__day calendar__dayContainer__day__detail">
                            <?php echo $day; ?>
                            <div class="calendar__dayContainer__day__whois">
                                <?php 
                                    if(count($regularshift_list) == 1) {
                                        // 今日の日付以外__特定の人のシフト
                                        // 今日の日付以外__特定の人のシフト__臨時シフト
                                        foreach($dayshift_list as $dayshift) {
                                            $flag = 0;
                                            parse_str($dayshift['dayshift_times'], $dayshift_times);    
                                            if($regularshift_list[0]['name'] == $dayshift['name']){
                                                if($month == $dayshift['dayshift_month']){
                                                    if($dayshift['dayshift_day'] == $day) {
                                                        if(count($deleteshift_list) != 0) {
                                                            foreach($deleteshift_list as $deleteshift){
                                                                if(($month == $deleteshift['delete_month']) && ($day == $deleteshift['delete_day'])){
                                                                    $this -> deletedShift_individual(
                                                                        $times[$regularshift]
                                                                    );
                                                                    $flag = 1;
                                                                    break;
                                                                }
                                                            } 
                                                            if($flag != 1) {
                                                                $this -> scheduledShift(
                                                                    '〇', 
                                                                    $dayshift_times[0]
                                                                );
                                                            }
                                                        } else {
                                                            $this -> scheduledShift(
                                                                '〇', 
                                                                $dayshift_times[0]
                                                            );
                                                        }
                                                        
                                                    }
                                                }
                                            }
                                        }
                                        // 今日の日付以外__特定の人のシフト__レギュラーシフト
                                        $regularshift_array = explode(',', $regularshift_list[0]['regularshift']);
                                        array_shift($regularshift_array);
                                        parse_str($regularshift_list[0]['regularshift_times'], $times);
                                        foreach($regularshift_array as $regularshift) {
                                            $flag = 0;
                                            if($day != '') {
                                                if($weekdays[$regularshift] == $day){
                                                    if(count($deleteshift_list) != 0) {
                                                        foreach($deleteshift_list as $deleteshift){
                                                            if(($month == $deleteshift['delete_month']) && ($day == $deleteshift['delete_day'])){
                                                                $this -> deletedShift_individual(
                                                                    $times[$regularshift]
                                                                );
                                                                $flag = 1;
                                                                break;
                                                            }
                                                        }
                                                        if($flag != 1) {
                                                            $this -> scheduledShift(
                                                                '〇', 
                                                                $times[$regularshift]
                                                            );
                                                        }
                                                    } else {
                                                        $this -> scheduledShift(
                                                            '〇', 
                                                            $times[$regularshift]
                                                        );
                                                    }
                                                }
                                            }
                                        }
                                    } else {
                                        // 全員分
                                        // 今日の日付以外__全員分__臨時シフト
                                        foreach($dayshift_list as $dayshift) {
                                            $flag = 0;
                                            parse_str($dayshift['dayshift_times'], $dayshift_times);    
                                            if($month == $dayshift['dayshift_month']){
                                                if($dayshift['dayshift_day'] == $day) {
                                                    if(count($deleteshift_list) != 0) {
                                                        foreach($deleteshift_list as $deleteshift){
                                                            if(($all_staff[$dayshift['name']]['id'] == $deleteshift['name']) && ($month == $deleteshift['delete_month']) && ($day == $deleteshift['delete_day'])){
                                                                $this -> deletedShift(
                                                                    $all_staff[$dayshift['name']]['name'], 
                                                                    $dayshift_times[0]
                                                                );
                                                                $flag = 1;
                                                                break;
                                                            }
                                                        }
                                                        if($flag = 1) {
                                                            $this -> scheduledShift(
                                                                $all_staff[$dayshift['name']]['name'], 
                                                                $dayshift_times[0]
                                                            );
                                                        }
                                                    } else {
                                                        $this -> scheduledShift(
                                                            '<span class="shiftinfo__temporary">[臨]</span>' .$all_staff[$dayshift['name']]['name'], 
                                                            $dayshift_times[0]
                                                        );
                                                    }
                                                    
                                                }
                                            }
                                        }
                                        // 今日の日付以外__全員分__レギュラーシフト
                                        foreach($regularshift_list as $regularshift) {
                                            $flag = 0;
                                            $regularshift_all = explode(',', $regularshift['regularshift']);
                                            array_shift($regularshift_all);
                                            parse_str($regularshift['regularshift_times'], $times);
                                            foreach($regularshift_all as $regularshift_day) {
                                                if($day != '') {
                                                    if($weekdays[$regularshift_day] == $day){
                                                        if(count($deleteshift_list) > 0){
                                                            foreach($deleteshift_list as $deleteshift){
                                                                if(($all_staff[$regularshift['name']]['id'] == $deleteshift['name']) && ($month == $deleteshift['delete_month']) && ($day == $deleteshift['delete_day'])){
                                                                        $this -> deletedShift(
                                                                            $all_staff[$regularshift['name']]['name'], 
                                                                            $times[$regularshift_day]
                                                                        );
                                                                        $flag = 1;
                                                                        break;
                                                                }
                                                            }
                                                            if($flag != 1) {
                                                                    $this -> scheduledShift(
                                                                        $all_staff[$regularshift['name']]['name'], 
                                                                        $times[$regularshift_day]
                                                                    );
                                                            }
                                                        } else {
                                                                $this -> scheduledShift(
                                                                    $all_staff[$regularshift['name']]['name'], 
                                                                    $times[$regularshift_day]
                                                                );
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                ?>
                            </div>
                        </td>
                    <?php }} ?>
                </tr>
            <?php } ?>
        </table>
        <!-- /カレンダー -->



        <!-- コメントフォーム -->
        <div class="commentform">

            <h2 class="subTitle">コメント入力</h2>
            <!-- コメント入力欄 -->
            <form action="itiran_commentsRegister.php" method="POST">
                <select name="name" id="name" oninput="check()" class="commentform__nameinput">
                    <?php
                        for($i = 0; $i < count($all_staff); $i++) {
                            if($i === 0){
                                echo '<option value="' . $i . '">選択してください</option>';                                
                            } else {
                                echo '<option value="' . $i . '">' . $all_staff[$i]['name'] . '</option>';
                            }
                        }
                    ?>
                </select>
                <div>
                    <label for="comment">コメント入力欄</label><br>
                    <textarea name="comment" id="comment" class="commentform__commentinput" id="comment" oninput="check()"></textarea><br><br>
                    <div><input type="submit" class="itemDetail__commentButton" id="button" disabled value="投稿する"></div>
                </div>
            </form>
            <!-- /コメント入力欄 -->

            <!-- コメント一覧 -->
            <table class="commenttable">
                <tr class="commenttable__topline">
                    <th class="commenttable__topline__cell">名前</th>
                    <th class="commenttable__topline__cell">コメント</th>
                    <th class="commenttable__topline__cell">日付</th>
                </tr>
                <?php 
                    foreach ($comments as $comment) { 
                    
                ?>
                    <tr class="commenttable__cells">
                        <td class="commenttable__name"><?= h($comment['name']) ?></td>
                        <td class="commenttable__comment"><?= h($comment['comment']) ?></td>
                        <td class="commenttable__commentDate"><?= h($comment['dt']) ?></td>
                    </tr>
                <?php } ?>
            </table>
            <!-- /コメント一覧 -->
        </div>
        <!-- /コメントフォーム -->

    </div>
    
    <script src="../../js/jquery-3.5.1.min.js"></script>
    <script src="../../js/index.js"></script>
    <script src="../../js/hamburger.js"></script>
    
</body>
</html>