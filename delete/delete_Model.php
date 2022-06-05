<?php

    require_once('../Delete.php');
    require_once('../../staff/Staff.php');
    require_once('../../itiran/Itiran.php');

    class DeleteModel {

        function deleteDispView() {
            $all_staff = Staff::allStaff();
            require_once('../delete_view/delete_AddFormView.php');
        }

        function deleteRegisterCheck(){
            // シフト削除 登録内容確認
            $delete_name = $_POST['delete_name'];
            $delete_month = $_POST['delete_month'];
            $delete_day = $_POST['delete_day'];

            if($delete_name === 0 || $delete_month === "0" || mb_strlen($delete_day) === 0){
                $errorMessage = '! 未入力項目があります';
                require_once('../delete_view/delete_CheckView.php');
            } else {
                $errorMessage = '';
                $all_staff = Staff::allStaff();
                require_once('../delete_view/delete_CheckView.php');
            }
        }

        function deleteRegister(){
            // シフト削除情報
            $delete_name = $_POST['delete_name'];
            $delete_month = $_POST['delete_month'];
            $delete_day = $_POST['delete_day'];

            $delete = new DeleteShift();
            $delete->delete_name = $delete_name;
            $delete->delete_month = $delete_month;
            $delete->delete_day = $delete_day;

            if ($delete->deleteShiftRegist()) {
                $all_staff = Staff::allStaff();
                $staff = array('none');
                for($i = 1; $i <= count($all_staff); $i++) {
                    $staff[] = $all_staff[$i]['name'];
                }
                $regist_comment = '[system] 臨時シフトを登録しました';
                $system = new Itiran();
                $system->name = $staff[$delete_name];
                $system->comment = $regist_comment;
                $system->commentRegist();
                header('Location: ../../itiran/itiran_controller/itiran_index.php');        
            } else {
                echo '登録に失敗しました。';
                echo '<a href="../../itiran/itiran_controller/itiran_index.php">トップに戻る</a>';
            }
        }

    }