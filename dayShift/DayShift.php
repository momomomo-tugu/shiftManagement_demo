<?php

class DayShift
{

    function whoIs()
    {
        $pdo = new PDO('mysql:host=127.0.0.1;dbname=hoge;charset=utf8;', 'hogehoge', 'hogehogehoge');
        return $pdo;
    }

    function dayShiftRegist()
    {
        // 臨時シフトをDBに保存
        try {
            $pdo = $this->whoIs();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $pdo->prepare('INSERT INTO dayshift (name, dayshift_month, dayshift_day, dayshift_times) VALUES (:NAME, :DAYSHIFT_MONTH, :DAYSHIFT_DAY, :DAYSHIFT_TIMES)');
            $stmt->bindParam(':NAME', $this->dayshift_name);
            $stmt->bindParam(':DAYSHIFT_MONTH', $this->dayshift_month);
            $stmt->bindParam(':DAYSHIFT_DAY', $this->dayshift_day);
            $stmt->bindParam(':DAYSHIFT_TIMES', $this->dayshift_times);
            return $stmt->execute();
        } catch (PDOException $e) {
            var_dump($stmt);
            return false;
        }
    }
}
