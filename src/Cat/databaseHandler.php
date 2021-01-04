<?php

namespace mabw\Cat;

class DatabaseHandler
{
    // Kollar om användaren finns sen tidigare, gör den det returneras true
    // annars false.
    public function checkUser($result, $saveInSession=true)
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

        for ($i=0; $i < count($tags); $i++) {
            if ($i+1 == count($tags)) {
                $tagsStr .= $tags[$i];
            } else {
                $tagsStr .= $tags[$i] . ",";
            }
        }

        return $tagsStr;
    }

    public function getVoteInfo()
    {
        $type = $_POST["type"];
        $action = $_POST["action"];
        $questionId = $_POST["questionId"];
        $answerId = $_POST["answerId"] ?? null;
        $commentId = $_POST["commentId"] ?? null;

        if ($type == "question" && $action == "upvote") {
            $sql = "UPDATE Questions SET points = points + 1 WHERE id = ?;";
            $arr = [$questionId];
            $redirect = "questions";
        } else if ($type == "question" && $action == "downvote") {
            $sql = "UPDATE Questions SET points = points - 1 WHERE id = ?;";
            $arr = [$questionId];
            $redirect = "questions";
        } else if ($type == "answer" && $action == "upvote") {
            $sql = "UPDATE Answers SET points = points + 1 WHERE id = ? AND questionId = ?;";
            $arr = [$answerId, $questionId];
            $redirect = "questions/single?id=" . $questionId;
        } else if ($type == "answer" && $action == "downvote") {
            $sql = "UPDATE Answers SET points = points - 1 WHERE id = ?  AND questionId = ?;";
            $arr = [$answerId, $questionId];
            $redirect = "questions/single?id=" . $questionId;
        } else if ($type == "comment" && $action == "upvote") {
            $sql = "UPDATE Comments SET points = points + 1 WHERE id = ? AND questionId = ? AND answerId = ?;";
            $arr = [$commentId, $questionId, $answerId];
            $redirect = "questions/single?id=" . $questionId;
        } else if ($type == "comment" && $action == "downvote") {
            $sql = "UPDATE Comments SET points = points - 1 WHERE id = ? AND questionId = ? AND answerId = ?;";
            $arr = [$commentId, $questionId, $answerId];
            $redirect = "questions/single?id=" . $questionId;
        }

        return [$sql, $arr, $redirect];
    }
}
