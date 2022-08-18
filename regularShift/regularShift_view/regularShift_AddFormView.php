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


    <div class="container">

        <h2 class="subTitle">シフトを曜日で追加</h2>

        <form action="../regularShift_controller/regularShift_RegisterCheck.php" method="post" class="shift">
            <div class="shift__nameinput">
                <p class="shift__nameinput__title">名前</p>
                <select name="regularshift_name">
                    <?php
                    for ($i = -1; $i < count($all_staff); $i++) {
                        if ($i === -1) {
                            echo '<option value="' . $i . '">選択してください</option>';
                        } else {
                            echo '<option value="' . $all_staff[$i]['id'] . '">' . $all_staff[$i]['name'] . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="shift__shiftinput">
                <p class="shift__shiftinput__title">追加する曜日を選択</p>
                <input type="hidden" name="regularshift_day[]" value="7">

                <!-- 月 -->
                <div class="shift__shiftinput__container">
                    <label class="shift__shiftinput__youbi"><input type="checkbox" name="regularshift_day[]" value="1">月曜日</label>
                    <div class="shift__timeinput__container">
                        <input type="text" name="<?= 'start_hour_1' ?>" value="17" class="shift__timeinput__container__form">
                        <input type="text" name="<?= 'start_minute_1' ?>" value="00" class="shift__timeinput__container__form">
                        <p>～</p>
                        <input type="text" name="<?= 'fin_hour_1' ?>" value="20" class="shift__timeinput__container__form">
                        <input type="text" name="<?= 'fin_minute_1' ?>" value="00" class="shift__timeinput__container__form">
                    </div>
                </div>

                <br />

                <!-- 火 -->
                <div class="shift__shiftinput__container">
                    <label class="shift__shiftinput__youbi"><input type="checkbox" name="regularshift_day[]" value="2">火曜日</label>
                    <div class="shift__timeinput__container">
                        <input type="text" name="<?= 'start_hour_2' ?>" value="17" class="shift__timeinput__container__form">
                        <input type="text" name="<?= 'start_minute_2' ?>" value="00" class="shift__timeinput__container__form">
                        <p>～</p>
                        <input type="text" name="<?= 'fin_hour_2' ?>" value="20" class="shift__timeinput__container__form">
                        <input type="text" name="<?= 'fin_minute_2' ?>" value="00" class="shift__timeinput__container__form">
                    </div>
                </div>

                <br />

                <!-- 水 -->
                <div class="shift__shiftinput__container">
                    <label class="shift__shiftinput__youbi"><input type="checkbox" name="regularshift_day[]" value="3">水曜日</label>
                    <div class="shift__timeinput__container">
                        <input type="text" name="<?= 'start_hour_3' ?>" value="17" class="shift__timeinput__container__form">
                        <input type="text" name="<?= 'start_minute_3' ?>" value="00" class="shift__timeinput__container__form">
                        <p>～</p>
                        <input type="text" name="<?= 'fin_hour_3' ?>" value="20" class="shift__timeinput__container__form">
                        <input type="text" name="<?= 'fin_minute_3' ?>" value="00" class="shift__timeinput__container__form">
                    </div>
                </div>

                <br />

                <!-- 木 -->
                <div class="shift__shiftinput__container">
                    <label class="shift__shiftinput__youbi"><input type="checkbox" name="regularshift_day[]" value="4">木曜日</label>
                    <div class="shift__timeinput__container">
                        <input type="text" name="<?= 'start_hour_4' ?>" value="17" class="shift__timeinput__container__form">
                        <input type="text" name="<?= 'start_minute_4' ?>" value="00" class="shift__timeinput__container__form">
                        <p>～</p>
                        <input type="text" name="<?= 'fin_hour_4' ?>" value="20" class="shift__timeinput__container__form">
                        <input type="text" name="<?= 'fin_minute_4' ?>" value="00" class="shift__timeinput__container__form">
                    </div>
                </div>

                <br />

                <!-- 金 -->
                <div class="shift__shiftinput__container">
                    <label class="shift__shiftinput__youbi"><input type="checkbox" name="regularshift_day[]" value="5">金曜日</label>
                    <div class="shift__timeinput__container">
                        <input type="text" name="<?= 'start_hour_5' ?>" value="17" class="shift__timeinput__container__form">
                        <input type="text" name="<?= 'start_minute_5' ?>" value="00" class="shift__timeinput__container__form">
                        <p>～</p>
                        <input type="text" name="<?= 'fin_hour_5' ?>" value="20" class="shift__timeinput__container__form">
                        <input type="text" name="<?= 'fin_minute_5' ?>" value="00" class="shift__timeinput__container__form">
                    </div>
                </div>

                <br />

                <!-- 土 -->
                <div class="shift__shiftinput__container">
                    <label class="shift__shiftinput__youbi"><input type="checkbox" name="regularshift_day[]" value="6">土曜日</label>
                    <div class="shift__timeinput__container">
                        <input type="text" name="<?= 'start_hour_6' ?>" value="17" class="shift__timeinput__container__form">
                        <input type="text" name="<?= 'start_minute_6' ?>" value="00" class="shift__timeinput__container__form">
                        <p>～</p>
                        <input type="text" name="<?= 'fin_hour_6' ?>" value="20" class="shift__timeinput__container__form">
                        <input type="text" name="<?= 'fin_minute_6' ?>" value="00" class="shift__timeinput__container__form">
                    </div>
                </div>

                <br />

                <!-- 日 -->
                <div class="shift__shiftinput__container">
                    <label class="shift__shiftinput__youbi"><input type="checkbox" name="regularshift_day[]" value="0">日曜日</label>
                    <div class="shift__timeinput__container">
                        <input type="text" name="<?= 'start_hour_0' ?>" value="17" class="shift__timeinput__container__form">
                        <input type="text" name="<?= 'start_minute_0' ?>" value="00" class="shift__timeinput__container__form">
                        <p>～</p>
                        <input type="text" name="<?= 'fin_hour_0' ?>" value="20" class="shift__timeinput__container__form">
                        <input type="text" name="<?= 'fin_minute_0' ?>" value="00" class="shift__timeinput__container__form">
                    </div>
                </div>
            </div>
            <input type="submit" value="登録">
            <input type="button" onclick="history.back()" value="戻る">
        </form>

        <script src="../../js/jquery-3.5.1.min.js"></script>
        <script src="../../js/hamburger.js"></script>

    </div>
</body>

</html>