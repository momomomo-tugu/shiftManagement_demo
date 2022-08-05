<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=yes, maximum-scale=1, minimum-scale=1">
    <title>demoShift | シフト削除確認</title>
    <link rel="stylesheet" href="../../css/html5reset-1.6.1.css">
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>
    <?= $header ?>

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
                echo $deleteStaff . 'さんを削除してよろしいですか？';
                ?>
            </p>
            <form action="../staff_controller/staff_DeleteRegister.php" method="post">
                <input type="hidden" name="deleteStaff" value="<?= $deleteStaff ?>">
                <input type="submit" value="削除">
            </form>
        <?php } ?>
    </div>

    <script src="../../js/jquery-3.5.1.min.js"></script>
    <script src="../../js/hamburger.js"></script>

</body>

</html>