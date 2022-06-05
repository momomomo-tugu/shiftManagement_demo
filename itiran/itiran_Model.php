<?php

    require_once('../Itiran.php');
    require_once('../../staff/Staff.php');


    class ItiranModel {

        function scheduledShift($name, $times) {
            echo '<div class="shiftinfo">';
            echo '<p class="shiftinfo__name">' . $name . '</p>';
            echo '<p class="shiftinfo__time">';
            echo $times['start'][0] . ':' . $times['start'][1] . '～' . $times['fin'][0] . ':' . $times['fin'][1];
            echo '</p>';
            echo '</div>';
        } 

        function deletedShift($name, $times) {
            echo '<div class="shiftinfo">';
            echo '<p style="text-decoration: line-through;" class="shiftinfo__name">' . $name . '</p>';
            echo '<p class="shiftinfo__time" style="text-decoration: line-through;">';
            echo $times['start'][0] . ':' . $times['start'][1] . '～' . $times['fin'][0] . ':' . $times['fin'][1];
            echo '</p>';
            echo '</div>';
        } 

        function deletedShift_individual($times) {
            echo '<div class="shiftinfo">';
            echo '<p class="shiftinfo__name">×</p>';
            echo '<p class="shiftinfo__time" style="text-decoration: line-through;">';
            echo $times['start'][0] . ':' . $times['start'][1] . '～' . $times['fin'][0] . ':' . $times['fin'][1];
            echo '</p>';
            echo '</div>';
        } 

        function itiranDispView() {
            // IndexView

            // カレンダー
            date_default_timezone_set('Asia/Tokyo');

            $year = date('Y');
            $month = date('n');
            $currentmonth = date('n');
            $lastday = date('t');
            $today = date('j');

            $week = ['日', '月', '火', '水', '木', '金', '土'];

            // 月を移動
            if($_SERVER["REQUEST_METHOD"] == "GET")  {
                if(isset($_GET['calendar_prev'])){
                    $month = intval($_GET['calendar_prev']) - 1;
                }
                if(isset($_GET['calendar_next'])){
                    $month = intval($_GET['calendar_next']) + 1;
                }
            }            

            // 1日目の曜日を取得
            $firstdate = date('w', mktime(0, 0, 0, $month, 1, $year));

            $day_list = array();
            $j = 0;

            for($m = 0; $m < $firstdate; $m++){
                $day_list[$j][] = '';
            }

            for($n = 1; $n <= $lastday; $n++){
                // 日付をリストに追加
                if(isset($day_list[$j]) && count($day_list[$j]) === 7 ){
                    $j++;
                }
                $day_list[$j][] = $n;
            }

            for($i = count($day_list[$j]); $i < 7; $i++){
                $day_list[$j][] = '';
            }
            // //カレンダー

            // 名前選択
            if($_SERVER["REQUEST_METHOD"] == "POST")  {
                if(isset($_POST['index_choiced_name'])){
                    $index_choiced_name = $_POST['index_choiced_name'];
                } else {
                    $index_choiced_name = "0";
                }
            }else {
                $index_choiced_name = "0";
            }

            // スタッフリスト
            $all_staff = Staff::allStaff();
            $name = 0;

            if($index_choiced_name != "0") {
                $name = intval($index_choiced_name);
                $regularshift_list = Itiran::itiranDetail($name);
                $dayshift_list = Itiran::itiranDayshift($name);
                $deleteshift_list = Itiran::deleteshift($name);
                $comments = Itiran::allComments();
                require_once('../itiran_view/itiran_indexView.php');
            } else {
                $regularshift_list = Itiran::itiranAll();
                $dayshift_list = Itiran::dayshiftAll();
                $deleteshift_list = Itiran::deleteshiftAll();
                $comments = Itiran::allComments();
                require_once('../itiran_view/itiran_indexView.php');
            }
        }

        function comments() {
            // コメント登録
            $name = $_POST['name'];
            $post_comment = $_POST['comment'];

            $comment = new Itiran();
            $comment->name = $name;
            $comment->comment = $post_comment;
            if ($comment->commentRegist()) {
                require_once('../itiran_controller/itiran_index.php');
            } else {
                echo '登録に失敗しました。';
            }
            
        } 
    }