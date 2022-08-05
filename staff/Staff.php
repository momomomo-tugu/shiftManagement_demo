<?php

require_once('../../common.php');

class Staff extends Common
{

    static function allStaff()
    {
        // DB から staffs の内容をすべて引く
        $all_staff = array();
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

    function staffRegist()
    {
        // staffs にスタッフを登録する
        try {
            $pdo = $this->whoIs();
            $stmt = $pdo->prepare('INSERT INTO staffs (name) VALUES (:NAME)');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt->bindParam(':NAME', $this->name);
            return $stmt->execute();
        } catch (PDOException $e) {
            var_dump($stmt);
            return false;
        }
    }

    static function whatisId($name)
    {
        $target = array();
        try {
            $pdo = self::staticWhoIs();
            $stmt = $pdo->prepare('SELECT id FROM staffs WHERE name=:NAME');
            $stmt->bindParam(':NAME', $name);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($target, $row);
            }
        } catch (PDOException $e) {
            var_dump($e);
            return false;
        }

        return $target;
    }

    function staffDelete()
    {
        // staffs からスタッフを削除、関連情報を削除
        try {
            $pdo = $this->whoIs();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->beginTransaction();

            $del_staffs  = 'DELETE FROM staffs       WHERE id  =:ID';
            $del_regular = 'DELETE FROM regularshift WHERE name=:ID';
            $del_day     = 'DELETE FROM dayshift     WHERE name=:ID';
            $del_delete  = 'DELETE FROM deleteshift  WHERE name=:ID';

            $del_staffs_stmt = $pdo->prepare($del_staffs);
            $del_staffs_stmt->bindParam(':ID', $this->id);
            $del_staffs_stmt->execute();

            $del_regular_stmt = $pdo->prepare($del_regular);
            $del_regular_stmt->bindParam(':ID', $this->id);
            $del_regular_stmt->execute();

            $del_day_stmt = $pdo->prepare($del_day);
            $del_day_stmt->bindParam(':ID', $this->id);
            $del_day_stmt->execute();

            $del_delete_stmt = $pdo->prepare($del_delete);
            $del_delete_stmt->bindParam(':ID', $this->id);

            $pdo->commit();

            return $del_delete_stmt->execute();
        } catch (PDOException $e) {
            $pdo->rollBack();
            var_dump($e);
            return false;
        }
    }

    static function whoisRegister($id)
    {
        $whoisRegister = array();
        try {
            $pdo = self::staticWhoIs();
            $stmt = $pdo->prepare('SELECT * FROM staffs WHERE id=:ID');
            $stmt->bindParam(':ID', $id);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($whoisRegister, $row);
            }
        } catch (PDOException $e) {
            var_dump($stmt);
            return false;
        }
        return $whoisRegister;
    }
}
