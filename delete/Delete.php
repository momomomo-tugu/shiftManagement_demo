<?php

class DeleteShift
{

    function whoIs()
    {
        $pdo = new PDO('mysql:host=127.0.0.1;dbname=hoge;charset=utf8;', 'hogehoge', 'hogehogehoge');
        return $pdo;
    }

    function deleteShiftRegist()
    {
        // 削除するシフトをDBに保存
        try {
            $pdo = $this->whoIs();
            $stmt = $pdo->prepare('INSERT INTO deleteshift (name, delete_month, delete_day) VALUES (:NAME, :DELETE_MONTH, :DELETE_DAY)');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
