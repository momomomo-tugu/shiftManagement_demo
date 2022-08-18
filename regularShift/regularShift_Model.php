<?php

require_once('../../common.php');
require_once('../RegularShift.php');
require_once('../../staff/Staff.php');
require_once('../../itiran/Itiran.php');

class RegularShiftModel extends Common
{

    function regularShiftDispView()
    {
        $this->header();
        $all_staff = Staff::allStaff();
        require_once('../regularShift_view/regularShift_AddFormView.php');
    }

    function regularShiftRegisterCheck()
    {
        // 週間シフト 登録内容確認
        $regularshift_name = $_POST['regularshift_name'];
        $regularshift_day = $_POST['regularshift_day'];

        // 月
        $start_hour_1 = $_POST['start_hour_1'];
        $start_minute_1 = $_POST['start_minute_1'];
        $fin_hour_1 = $_POST['fin_hour_1'];
        $fin_minute_1 = $_POST['fin_minute_1'];

        // 火
        $start_hour_2 = $_POST['start_hour_2'];
        $start_minute_2 = $_POST['start_minute_2'];
        $fin_hour_2 = $_POST['fin_hour_2'];
        $fin_minute_2 = $_POST['fin_minute_2'];

        // 水
        $start_hour_3 = $_POST['start_hour_3'];
        $start_minute_3 = $_POST['start_minute_3'];
        $fin_hour_3 = $_POST['fin_hour_3'];
        $fin_minute_3 = $_POST['fin_minute_3'];

        // 木
        $start_hour_4 = $_POST['start_hour_4'];
        $start_minute_4 = $_POST['start_minute_4'];
        $fin_hour_4 = $_POST['fin_hour_4'];
        $fin_minute_4 = $_POST['fin_minute_4'];

        // 金
        $start_hour_5 = $_POST['start_hour_5'];
        $start_minute_5 = $_POST['start_minute_5'];
        $fin_hour_5 = $_POST['fin_hour_5'];
        $fin_minute_5 = $_POST['fin_minute_5'];

        // 土
        $start_hour_6 = $_POST['start_hour_6'];
        $start_minute_6 = $_POST['start_minute_6'];
        $fin_hour_6 = $_POST['fin_hour_6'];
        $fin_minute_6 = $_POST['fin_minute_6'];

        // 日
        $start_hour_0 = $_POST['start_hour_0'];
        $start_minute_0 = $_POST['start_minute_0'];
        $fin_hour_0 = $_POST['fin_hour_0'];
        $fin_minute_0 = $_POST['fin_minute_0'];

        $this->header();

        if ($regularshift_name === "-1") {
            $errorMessage = '! 未入力項目があります';
            require_once('../regularShift_view/regularShift_CheckView.php');
        } else {
            $errorMessage = '';
            $whoisRegister = Staff::whoisRegister($regularshift_name);
            $all_staff = Staff::allStaff();
            require_once('../regularShift_view/regularShift_CheckView.php');
        }
    }

    function regularShiftRegister()
    {
        // 週間シフト DB登録
        $regularshift_name = $_POST['regularshift_name'];
        $regularshift_day = $_POST['regularshift_day'];
        $regularshift_times = $_POST['regularshift_times'];

        $exist = RegularShift::regularShiftExist($regularshift_name);

        $regularshift = new RegularShift();
        $regularshift->name = $regularshift_name;
        $regularshift->regularshift_day = $regularshift_day;
        $regularshift->regularshift_times = $regularshift_times;

        if (empty($exist)) {
            if ($regularshift->regularShiftRegist()) {
                $this->prepareComment($regularshift_name, '[system] 週間シフトを登録しました');
                header('Location: ../../itiran/itiran_controller/itiran_index.php');
            } else {
                echo '登録に失敗しました。';
                echo '<a href="../../itiran/itiran_controller/itiran_index.php">トップに戻る</a>';
            }
        } else {
            if ($regularshift->regularShiftUpdate()) {
                $this->prepareComment($regularshift_name, '[system] 週間シフトを登録しました');
                header('Location: ../../itiran/itiran_controller/itiran_index.php');
            } else {
                echo '登録に失敗しました。';
                echo '<a href="../../itiran/itiran_controller/itiran_index.php">トップに戻る</a>';
            }
        }
    }
}
