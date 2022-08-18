<?php

require_once('../../common.php');

class DayShift extends Common
{

    function dayShiftRegist()
    {
        // 臨時シフトをDBに保存
        try {
            $sql = 'INSERT INTO dayshift (name, dayshift_month, dayshift_day, dayshift_times) SELECT :NAME, :DAYSHIFT_MONTH, :DAYSHIFT_DAY, :DAYSHIFT_TIMES WHERE NOT EXISTS (SELECT * FROM dayshift WHERE name=:NAME AND dayshift_month=:DAYSHIFT_MONTH AND dayshift_day=:DAYSHIFT_DAY AND dayshift_times=:DAYSHIFT_TIMES)';
            list($pdo, $stmt) = $this->whoIs($sql);
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
