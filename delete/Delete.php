<?php

require_once('../../common.php');

class DeleteShift extends Common
{

    function deleteShiftRegist()
    {
        // 削除するシフトをDBに保存
        try {
            $sql = 'INSERT INTO deleteshift (name, delete_month, delete_day) SELECT :NAME, :DELETE_MONTH, :DELETE_DAY WHERE NOT EXISTS (SELECT * FROM deleteshift WHERE name=:NAME AND delete_month=:DELETE_MONTH AND delete_day=:DELETE_DAY)';
            list($pdo, $stmt) = $this->whoIs($sql);
            $stmt->bindParam(':NAME', $this->delete_name);
            $stmt->bindParam(':DELETE_MONTH', $this->delete_month);
            $stmt->bindParam(':DELETE_DAY', $this->delete_day);
            return $stmt->execute();
        } catch (PDOException $e) {
            var_dump($stmt);
            return false;
        }
    }
}
