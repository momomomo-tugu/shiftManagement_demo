<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=yes, maximum-scale=1, minimum-scale=1">
    <title>demoShift | シフト削除</title>
    <link rel="stylesheet" href="../../css/html5reset-1.6.1.css">
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>
    <?= $header ?>

    <div class="container">
        <form action="../delete_controller/delete_RegisterCheck.php" method="post">
            <div>
                <p>名前</p>
                <select name="delete_name">
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
            <br />
            <div>
                <p>削除する日付を入力してください</p>
                <select name="delete_month">
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
                <input type="text" name="delete_day" value="" class="shift__shiftinput__day">
                日
            </div>
            <br />
            <input type="submit" value="登録">
            <input type="button" onclick="history.back()" value="戻る">
        </form>
    </div>

    <script src="../../js/jquery-3.5.1.min.js"></script>
    <script src="../../js/hamburger.js"></script>

</body>

</html>