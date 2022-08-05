<?php

class Common
{

    function whoIs()
    {
        $pdo = new PDO('mysql:host=127.0.0.1;dbname=hoge;charset=utf8;', 'hogehoge', 'hogehogehoge');
        return $pdo;
    }

    static function staticWhoIs()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=hoge;charset=utf8;', 'hogehoge', 'hogehogehoge');
        return $pdo;
    }

    function header()
    {
        $header = <<<EOF

            <header class="header">
            <h1 class="header__title"><a href="../../itiran/itiran_controller/itiran_index.php" class="mainTitle">demoShift</a></h1>
            <!-- リンクリスト -->
            <div class="index__linklist">
                <a href="../../regularShift/regularShift_controller/regularShift_DispView.php" class="index__linklist__linkbox__link">曜日で追加</a>
                <a href="../../dayShift/dayShift_controller/dayShift_DispView.php" class="index__linklist__linkbox__link">日時の追加/編集</a>
                <a href="../../delete/delete_controller/delete_DispView.php" class="index__linklist__linkbox__link">シフトを削除</a>
                <a href="../../staff/staff_controller/staff_DispView.php" class="index__linklist__linkbox__link">メンバーを編集</a>
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
                        <a href="../../dayShift/dayShift_controller/dayShift_DispView.php" class="index__linklist__linkbox__link">日時の追加/編集</a>
                    </li>
                    <li>
                        <a href="../../delete/delete_controller/delete_DispView.php" class="index__linklist__linkbox__link">シフトを削除</a>
                    </li>
                </ul>
            </nav>
            <!-- ハンバーガーメニュー -->
        </header>

        EOF;

        return $header;
    }
}
