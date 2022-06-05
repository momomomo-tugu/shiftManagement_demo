<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=yes, maximum-scale=1, minimum-scale=1">
    <title>関根和三郎商店 | 週間シフト追加</title>
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

        <h2 class="subTitle">シフトを日時で追加</h2>

        <form action="../dayShift_controller/dayShift_RegisterCheck.php" method="post" class="shift">
            <div class="shift__nameinput">
                <p class="shift__nameinput__title">名前</p>
                <select name="dayshift_name">
                    <?php
                        for($i = 0; $i < count($all_staff); $i++) {
                            if($i == 0){
                                echo '<option value="' . $i . '">選択してください</option>';                                
                            } else {
                                echo '<option value="' . $i . '">' . $all_staff[$i]['name'] . '</option>';
                            }
                        }
                    ?>
                </select>
            </div>
            <div class="shift__shiftinput">
                <p class="shift__shiftinput__title">追加する日付を入力</p>
                <select name="dayshift_month">
                    <option value="0">--</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>                
                </select>
                月
                <input type="text" name="dayshift_day" value="" class="shift__shiftinput__day">
                日
            </div>
            <div class="shift__timeinput">
                <p class="shift__shiftinput__title">追加する時間を入力 ※2桁で入力してください</p>
                <div class="shift__timeinput__container">
                    <input type="text" name="dayshift_start_hour" value="17" class="shift__timeinput__container__form">
                    <p>:</p>
                    <input type="text" name="dayshift_start_minute" value="00" class="shift__timeinput__container__form">
                    <p>～</p>
                    <input type="text" name="dayshift_finish_hour" value="20" class="shift__timeinput__container__form">
                    <p>:</p>
                    <input type="text" name="dayshift_finish_minute" value="00" class="shift__timeinput__container__form">
                </div>
            </div>
            <input type="submit" value="登録">
            <input type="button" onclick="history.back()" value="戻る">
        </form>
    </div>

    <script src="../../js/jquery-3.5.1.min.js"></script>
    <script src="../../js/hamburger.js"></script>
</body>
</html>