<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=yes, maximum-scale=1, minimum-scale=1">
    <title>関根和三郎商店 | シフト削除確認</title>
    <link rel="stylesheet" href="../../css/html5reset-1.6.1.css">
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>


    <div class="container">
        <?php
        if ($errorMessage !== '') {
            echo $errorMessage;
        ?>
            <form>
                <input type="button" onclick="history.back()" value="戻る">
            </form>
        <?php } else { ?>
            <p>
                <?php
                echo $addStaff . 'さんを追加してよろしいですか？';
                ?>
            </p>
            <form action="../staff_controller/staff_AddRegister.php" method="post">
                <input type="hidden" name="addStaff" value="<?= $addStaff ?>">
                <input type="submit" value="登録">
            </form>
        <?php } ?>
    </div>

    <script src="../../js/jquery-3.5.1.min.js"></script>
    <script src="../../js/hamburger.js"></script>

</body>

</html>