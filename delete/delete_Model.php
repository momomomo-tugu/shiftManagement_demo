<?php

require_once('../../common.php');
require_once('../Delete.php');
require_once('../../staff/Staff.php');
require_once('../../itiran/Itiran.php');

class DeleteModel extends Common
{

    function deleteDispView()
    {
        $this->header();
        $all_staff = Staff::allStaff();
        require_once('../delete_view/delete_AddFormView.php');
    }

    function deleteRegisterCheck()
    {
        // シフト削除 登録内容確認
        $delete_name = $_POST['delete_name'];
        $delete_month = $_POST['delete_month'];
        $delete_day = $_POST['delete_day'];

        $this->header();

        if ($delete_name === -1 || $delete_month === "0" || mb_strlen($delete_day) === 0) {
            $errorMessage = '! 未入力項目があります';
            require_once('../delete_view/delete_CheckView.php');
        } else {
            $errorMessage = '';
            $whoisRegister = Staff::whoisRegister($delete_name);
            $all_staff = Staff::allStaff();
            require_once('../delete_view/delete_CheckView.php');
        }
    }

    function deleteRegister()
    {
        // シフト削除情報
        $delete_name = $_POST['delete_name'];
        $delete_month = $_POST['delete_month'];
        $delete_day = $_POST['delete_day'];

        $delete = new DeleteShift();
        $delete->delete_name = $delete_name;
        $delete->delete_month = $delete_month;
        $delete->delete_day = $delete_day;

        if ($delete->deleteShiftRegist()) {
            $this->prepareComment($delete_name, '[system] シフトを削除しました');
            header('Location: ../../itiran/itiran_controller/itiran_index.php');
        } else {
            echo '登録に失敗しました。';
            echo '<a href="../../itiran/itiran_controller/itiran_index.php">トップに戻る</a>';
        }
    }
}
