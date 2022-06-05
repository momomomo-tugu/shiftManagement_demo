<?php

class RegularShift
{

    function whoIs()
    {
        $pdo = new PDO('mysql:host=127.0.0.1;dbname=hoge;charset=utf8;', 'hogehoge', 'hogehogehoge');
        return $pdo;
    }

    function regularShiftRegist()
    {
        //週間シフトをDBに保存
        try {
            $pdo = $this->whoIs();
            $stmt = $pdo->prepare('UPDATE regularshift SET regularShift=:REGULARSHIFT, regularShift_times=:REGULARSHIFT_TIMES WHERE name=:NAME');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt->bindParam(':NAME', $this->name);
            $stmt->bindParam(':REGULARSHIFT', $this->regularShift_day);
            $stmt->bindParam(':REGULARSHIFT_TIMES', $this->regularShift_times);
            return $stmt->execute();
        } catch (PDOException $e) {
            var_dump($stmt);
            return false;
        }
    }
}
