<?php
require_once('../../common.php');
$common = new Common();
$header = $common->header();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=yes, maximum-scale=1, minimum-scale=1">
    <title>demoShift | シフト管理TOP</title>
    <link rel="stylesheet" href="../../css/html5reset-1.6.1.css">
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>

    <?= $header ?>

    <div class="container">

        <h2 class="subTitle">スタッフ管理</h2>
        <div class="staffManagement">
            <h3 class="staffManagement__title">スタッフを追加する</h3>
            <form action="../staff_controller/staff_AddCheck.php" method="post">
                <input type="text" name="addStaff">
                <input type="submit" value="登録">
            </form>
        </div>
        <div class="staffManagement">
            <h3 class="staffManagement__title">スタッフを削除する</h3>
            <form action="../staff_controller/staff_DeleteCheck.php" method="post">
                <input type="text" name="deleteStaff">
                <input type="submit" value="削除">
            </form>
        </div>

    </div>

    <script src="../../js/jquery-3.5.1.min.js"></script>
    <script src="../../js/hamburger.js"></script>

</body>

</html>