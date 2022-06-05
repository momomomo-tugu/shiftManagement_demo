<?php

class Staff
{

    function whoIs()
    {
        $pdo = new PDO('mysql:host=127.0.0.1;dbname=hoge;charset=utf8;', 'hogehoge', 'hogehogehoge');
        return $pdo;
    }

    static function staticWhoIs()
    {
        $pdo = new PDO('mysql:host=127.0.0.1;dbname=hoge;charset=utf8;', 'hogehoge', 'hogehogehoge');
        return $pdo;
    }

    static function allStaff()
    {
        // DB から staffs の内容をすべて引く
        $all_staff = array('none');
        try {
            $pdo = self::staticWhoIs();
            $stmt = $pdo->prepare('SELECT * FROM staffs');
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($all_staff, $row);
            }
        } catch (PDOException $e) {
            var_dump($stmt);
            return false;
        }
        return $all_staff;
    }


    function allShiftRegist()
    {
        // 週間シフトを日付に変更して保存
        try {
            $pdo = $this->whoIs();
            $stmt = $pdo->prepare('UPDATE staffs SET allshift=:ALLSHIFT WHERE id=:NAME');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt->bindParam(':NAME', $this->name);
            $stmt->bindParam(':ALLSHIFT', $this->shiftday);
            return $stmt->execute();
        } catch (PDOException $e) {
            var_dump($stmt);
            return false;
        }
    }

    static function getShift($name)
    {
        // allshift の内容を引く
        $allshift = [];
        try {
            $pdo = self::staticWhoIs();
            $stmt = $pdo->prepare('SELECT allshift FROM staffs WHERE id=:NAME');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt->bindParam(':NAME', $name);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($allshift, $row);
            }
        } catch (PDOException $e) {
            var_dump($stmt);
            return false;
        }
        return $allshift;
    }
}
