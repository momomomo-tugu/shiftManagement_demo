<?php

require_once('../../common.php');

class RegularShift extends Common
{

    static function regularShiftExist($name)
    {
        $select = array();
        try {
            $sql = 'SELECT * FROM regularshift WHERE name=:NAME';
            list($pdo, $stmt) = self::staticWhoIs($sql);
            $stmt->bindParam(':NAME', $name);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($select, $row);
            }
        } catch (PDOException $e) {
            var_dump($select);
            return false;
        }
        return $select;
    }

    function regularShiftRegist()
    {
        //週間シフトをDBに保存
        try {
            $sql = 'INSERT INTO regularshift (name, regularshift, regularshift_times) VALUES (:NAME, :REGULARSHIFT, :REGULARSHIFT_TIMES)';
            list($pdo, $stmt) = $this->whoIs($sql);
            $stmt->bindParam(':NAME', $this->name);
            $stmt->bindParam(':REGULARSHIFT', $this->regularshift_day);
            $stmt->bindParam(':REGULARSHIFT_TIMES', $this->regularshift_times);
            return $stmt->execute();
        } catch (PDOException $e) {
            var_dump($stmt);
            return false;
        }
    }

    function regularShiftUpdate()
    {
        try {
            $sql = 'UPDATE regularshift SET regularShift=:REGULARSHIFT, regularShift_times=:REGULARSHIFT_TIMES WHERE name=:NAME';
            list($pdo, $stmt) = $this->whoIs($sql);
            $stmt->bindParam(':NAME', $this->name);
            $stmt->bindParam(':REGULARSHIFT', $this->regularshift_day);
            $stmt->bindParam(':REGULARSHIFT_TIMES', $this->regularshift_times);
            return $stmt->execute();
        } catch (PDOException $e) {
            var_dump($stmt);
            return false;
        }
    }
}
