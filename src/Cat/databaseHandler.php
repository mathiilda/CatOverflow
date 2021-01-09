<?php

namespace mabw\Cat;

class DatabaseHandler
{
    // Kollar om användaren finns sen tidigare, gör den det returneras true
    // annars false.
    public function checkUser($result, $saveInSession = true)
    {
        $user = $_POST["user"];

        foreach ($result as $u) {
            if ($u->username == $user) {
                if ($saveInSession) {
                    $_SESSION["user"] = $user;
                    $_SESSION["email"] = $u->email;
                    $_SESSION["userId"] = $u->id;
                }
                return true;
            }
        }

        return false;
    }

    // Kollar om användaren finns sen tidigare, gör den det returneras true
    // annars false. Kollar även lösenordet.
    public function checkUserPassword($result)
    {
        $user = $_POST["user"];
        $pass = $_POST["pass"];

        foreach ($result as $u) {
            if ($u->username == $user && $u->password == $pass) {
                $_SESSION["user"] = $user;
                $_SESSION["email"] = $u->email;
                $_SESSION["userId"] = $u->id;
                return true;
            }
        }

        return false;
    }

    public function createTagsString()
    {
        if (!isset($_POST["tags"])) {
            return "";
        }

        $tags = $_POST["tags"];
        $tagsStr = "";
        $count = count($tags);

        for ($i=0; $i < $count; $i++) {
            if ($i+1 == $count) {
                $tagsStr .= $tags[$i];
            } else {
                $tagsStr .= $tags[$i] . ",";
            }
        }

        return $tagsStr;
    }

    public function updateVote()
    {
        $type = $_POST["type"];
        $action = $_POST["action"];
        $questionId = $_POST["questionId"];
        $answerId = $_POST["answerId"] ?? null;
        $commentId = $_POST["commentId"] ?? null;

        $sql = "";
        $arr = [];
        $redirect = "";

        if ($type == "question") {
            if ($action == "upvote") {
                $sql = "UPDATE Questions SET points = points + 1 WHERE id = ?;";
            } else {
                $sql = "UPDATE Questions SET points = points - 1 WHERE id = ?;";
            }

            $arr = [$questionId];
            $redirect = "questions";
        } else if ($type == "answer") {
            if ($action == "upvote") {
                $sql = "UPDATE Answers SET points = points + 1 WHERE id = ?  AND questionId = ?;";
            } else {
                $sql = "UPDATE Answers SET points = points - 1 WHERE id = ?  AND questionId = ?;";
            }

            $arr = [$answerId, $questionId];
            $redirect = "questions/single?id=" . $questionId;
        } else if ($type == "comment") {
            if ($answerId == "") {
                if ($action == "upvote") {
                    $sql = "UPDATE Comments SET points = points + 1 WHERE id = ? AND questionId = ?";
                } else {
                    $sql = "UPDATE Comments SET points = points - 1 WHERE id = ? AND questionId = ?";
                }

                $arr = [$commentId, $questionId];
            } else {
                if ($action == "upvote") {
                    $sql = "UPDATE Comments SET points = points + 1 WHERE id = ? AND questionId = ? AND answerId = ?;";
                } else {
                    $sql = "UPDATE Comments SET points = points - 1 WHERE id = ? AND questionId = ? AND answerId = ?;";
                }

                $arr = [$commentId, $questionId, $answerId];
            }

            $redirect = "questions/single?id=" . $questionId;
        }

        return [$sql, $arr, $redirect];
    }

    public function insertVote()
    {
        $type = $_POST["type"];
        $action = $_POST["action"];
        $questionId = $_POST["questionId"];
        $answerId = $_POST["answerId"] ?? null;
        $commentId = $_POST["commentId"] ?? null;

        if ($action == "upvote") {
            $vote = 1;
        } else {
            $vote = 0;
        }

        if ($type == "question") {
            $sql = "INSERT INTO Votes (questionId, voter, date, vote) VALUES (?, ?, ?, ?) ";
            $arr = [$questionId, $_SESSION["user"], time(), $vote];
        } else if ($type == "answer") {
            $sql = "INSERT INTO Votes (questionId, answerId, voter, date, vote) VALUES (?, ?, ?, ?, ?)";
            $arr = [$questionId, $answerId, $_SESSION["user"], time(), $vote];
        } else {
            $sql = "INSERT INTO Votes (questionId, answerId, commentId, voter, date, vote) VALUES (?, ?, ?, ?, ?, ?) ";
            $arr = [$questionId, $answerId, $commentId, $_SESSION["user"], time(), $vote];
        }

        return [$sql, $arr];
    }

    public function checkSort($table)
    {
        $sort = $_GET["sort"] ?? "desc";
        $type = $_GET["type"] ?? "date";

        if ($table == "Questions") {
            $sql = "SELECT * FROM " . $table . " ORDER BY " . $type . " " . $sort;
        } else {
            $sql = "SELECT * FROM " . $table . " WHERE questionId = " . $_GET["id"] . " ORDER BY " . $type . " " . $sort;
        }

        return $sql;
    }

    public function countTags($res)
    {
        $arr = ["Health" => 0, "Toys" => 0, "Food" => 0, "Breeding" => 0, "Kitten" => 0, "Other" => 0];

        foreach ($res as $r) {
            if (strpos($r->tags, "Health") !== false) {
                $arr["Health"] += 1;
            } else if (strpos($r->tags, "Toys") !== false) {
                $arr["Toys"] += 1;
            } else if (strpos($r->tags, "Food") !== false) {
                $arr["Food"] += 1;
            } else if (strpos($r->tags, "Breeding") !== false) {
                $arr["Breeding"] += 1;
            } else if (strpos($r->tags, "Kitten") !== false) {
                $arr["Kitten"] += 1;
            } else if (strpos($r->tags, "Other") !== false) {
                $arr["Other"] += 1;
            }
        }

        arsort($arr);

        return array_slice($arr, 0, 4);
    }
}
