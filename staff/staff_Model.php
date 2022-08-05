<?php

require_once('../../common.php');
require_once('../../staff/Staff.php');

class StaffModel extends Common
{
    function staffAddCheck()
    {
        $header = $this->header();
        $addStaff = $_POST['addStaff'];
        if ($addStaff == "") {
            $errorMessage = '! 未入力項目があります';
        } else {
            $errorMessage = '';
        }
        require_once('../staff_view/staff_AddCheckView.php');
    }

    function staffAddRegister()
    {
        // スタッフ情報を追加
        $addStaff_name = $_POST['addStaff'];

        $addStaff = new Staff();
        $addStaff->name = $addStaff_name;

        if ($addStaff->staffRegist()) {
            header('Location: ../../itiran/itiran_controller/itiran_index.php');
        } else {
            echo '登録に失敗しました。';
            echo '<a href="../../itiran/itiran_controller/itiran_index.php">トップに戻る</a>';
        }
    }

    function staffDeleteCheck()
    {
        $header = $this->header();
        $deleteStaff = $_POST['deleteStaff'];
        if ($deleteStaff == "") {
            $errorMessage = '! 未入力項目があります';
        } else {
            $errorMessage = '';
        }
        require_once('../staff_view/staff_DeleteCheckView.php');
    }

    function staffDeleteRegister()
    {
        // スタッフ情報を削除
        // $header = $this->header();
        $deleteStaff_name = $_POST['deleteStaff'];

        $deleteStaff_id = Staff::whatisId($deleteStaff_name);

        $deleteStaff = new Staff();
        $deleteStaff->id = $deleteStaff_id[0]['id'];

        if ($deleteStaff->staffDelete()) {
            header('Location: ../../itiran/itiran_controller/itiran_index.php');
        } else {
            var_dump($deleteStaff_id);
            echo '登録に失敗しました。';
            echo '<a href="../../itiran/itiran_controller/itiran_index.php">トップに戻る</a>';
        }
    }
}
