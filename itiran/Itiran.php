<?php

require_once('../../common.php');

class Itiran extends Common
{

    function commentRegist()
    {
        // コメントをDB に保存
        try {
            $commentInfo = array();
            $pdo = $this->whoIs();
            $stmt = $pdo->prepare('INSERT INTO comments (name, comment, dt) values ' .
                ' (:NAME, :COMMENT, CURRENT_DATE)');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt->bindParam(':NAME', $this->name);
            $stmt->bindParam(':COMMENT', $this->comment);
            $commentInfo = $stmt->fetch(PDO::FETCH_ASSOC);
            return $stmt->execute();
        } catch (PDOException $e) {
            var_dump($stmt);
            return false;
        }
    }

    static function allComments()
    {
        // DBからすべてのコメントを引いてくる
        $allcomments = array();
        try {
            $pdo = self::staticWhoIs();
            $stmt = $pdo->prepare('SELECT * FROM comments ORDER BY id DESC LIMIT 10');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($allcomments, $row);
            }
        } catch (PDOException $e) {
            var_dump($stmt);
            return false;
        }
        return $allcomments;
    }

    static function allShift()
    {
        // staffs DBからすべてのシフト情報を引いてくる
        $allshift = array();
        try {
            $pdo = self::staticWhoIs();
            $stmt = $pdo->prepare('SELECT * FROM regularshift');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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

    static function itiranDetail($name)
    {
        // regularshift DBから詳細情報を引く
        $shift = array();
        try {
            $pdo = self::staticWhoIs();
            $stmt = $pdo->prepare('SELECT * FROM regularshift WHERE name=:NAME');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt->bindParam(':NAME', $name);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($shift, $row);
            }
        } catch (PDOException $e) {
            var_dump($stmt);
            return false;
        }
        return $shift;
    }

    static function itiranAll()
    {
        $shiftAll = array();
        try {
            $pdo = self::staticWhoIs();
            $stmt = $pdo->prepare('SELECT * FROM regularshift');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($shiftAll, $row);
            }
        } catch (PDOException $e) {
            var_dump($stmt);
            return false;
        }
        return $shiftAll;
    }

    static function itiranDayshift($name)
    {
        $dayshift = array();
        try {
            $pdo = self::staticWhoIs();
            $stmt = $pdo->prepare('SELECT * FROM dayshift WHERE name=:NAME');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt->bindParam(':NAME', $name);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($dayshift, $row);
            }
        } catch (PDOException $e) {
            var_dump($stmt);
            return false;
        }
        return $dayshift;
    }

    static function dayshiftAll()
    {
        $dayshift = array();
        try {
            $pdo = self::staticWhoIs();
            $stmt = $pdo->prepare('SELECT * FROM dayshift');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($dayshift, $row);
            }
        } catch (PDOException $e) {
            var_dump($stmt);
            return false;
        }
        return $dayshift;
    }

    static function deleteshiftAll()
    {
        $deleteshift = array();
        try {
            $pdo = self::staticWhoIs();
            $stmt = $pdo->prepare('SELECT * FROM deleteshift');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($deleteshift, $row);
            }
        } catch (PDOException $e) {
            var_dump($stmt);
            return false;
        }
        return $deleteshift;
    }

    static function deleteshift($name)
    {
        $deleteshift = array();
        try {
            $pdo = self::staticWhoIs();
            $stmt = $pdo->prepare('SELECT * FROM deleteshift WHERE name=:NAME');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt->bindParam(':NAME', $name);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($deleteshift, $row);
            }
        } catch (PDOException $e) {
            var_dump($stmt);
            return false;
        }
        return $deleteshift;
    }
}
