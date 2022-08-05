<?php

require_once('../../common.php');
require_once('../DayShift.php');
require_once('../../staff/Staff.php');
require_once('../../itiran/Itiran.php');

class DayShiftModel extends Common
{

    function dayShiftDispView()
    {
        // dayShift_AddFormView を表示
        $header = $this->header();
        $all_staff = Staff::allStaff();
        require_once('../dayShift_view/dayShift_AddFormView.php');
    }

    function dayShiftRegisterCheck()
    {
        // 臨時シフト 登録内容確認
        $header = $this->header();
        $dayshift_name = $_POST['dayshift_name'];
        $dayshift_month = $_POST['dayshift_month'];
        $dayshift_day = $_POST['dayshift_day'];
        $dayshift_start_hour = $_POST['dayshift_start_hour'];
        $dayshift_start_minute = $_POST['dayshift_start_minute'];
        $dayshift_finish_hour = $_POST['dayshift_finish_hour'];
        $dayshift_finish_minute = $_POST['dayshift_finish_minute'];

        if ($dayshift_name === -1 || $dayshift_month === "0" || mb_strlen($dayshift_day) === 0) {
            $errorMessage = '! 未入力項目があります';
            require_once('../dayShift_view/dayShift_CheckView.php');
        } else {
            $errorMessage = '';
            $whoisRegister = Staff::whoisRegister($dayshift_name);
            $all_staff = Staff::allStaff();
            require_once('../dayShift_view/dayShift_CheckView.php');
        }
    }

    function dayShiftRegister()
    {
        // 臨時シフト DB登録
        $dayshift_name = $_POST['dayshift_name'];
        $dayshift_month = $_POST['dayshift_month'];
        $dayshift_day = $_POST['dayshift_day'];
        $dayshift_times = $_POST['dayshift_times'];

        $dayshift = new DayShift();
        $dayshift->dayshift_name = $dayshift_name;
        $dayshift->dayshift_month = $dayshift_month;
        $dayshift->dayshift_day = $dayshift_day;
        $dayshift->dayshift_times = $dayshift_times;

        if ($dayshift->dayShiftRegist()) {
            $all_staff = Staff::allStaff();
            $key = array_search($dayshift_name, array_column($all_staff, 'id'));
            $regist_comment = '[system] 臨時シフトを登録しました';
            $system = new Itiran();
            $system->name = $all_staff[$key]['name'];
            $system->comment = $regist_comment;
            $system->commentRegist();
            header('Location: ../../itiran/itiran_controller/itiran_index.php');
        } else {
            echo '登録に失敗しました。';
            echo '<a href="../../itiran/itiran_controller/itiran_index.php">トップに戻る</a>';
        }
    }
}
