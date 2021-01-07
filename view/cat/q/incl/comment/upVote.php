<?php
$view = "";

foreach ($data["votes"] as $vo) {
    if ($vo->questionId == $i->questionId && $vo->commentId == $i->id && $vo->voter == $_SESSION["user"] && $vo->vote == 0 && $i->answerId == $a) {
        $view = "gray";
        break;
    } else if ($vo->questionId == $i->questionId && $vo->commentId == $i->id && $vo->voter == $_SESSION["user"] && $vo->vote == 1 && $i->answerId == $a) {
        $view = "green";
        break;
    } else {
        $view = "normal";
    }
}
?>

<?php if ($view == "gray") : ?>
    <button class="pointer-events-none">
        <i title="Upvote" class="fas fa-paw text-gray-800 bg-gray-200 p-2 rounded shadow hover:bg-blue-400"></i>
    </button>
<?php elseif ($view == "green") : ?>
    <button class="pointer-events-none">
        <i title="Upvote" class="fas fa-paw text-gray-800 bg-green-300 p-2 rounded shadow hover:bg-blue-400"></i>
    </button>
<?php elseif ($view == "normal") : ?>
    <button type="submit">
        <i title="Upvote" class="fas fa-paw text-gray-800 bg-blue-300 p-2 rounded shadow hover:bg-blue-400"></i>
    </button>
<?php endif; ?>

<?php if ($data["votes"] == []) : ?>
    <button type="submit">
        <i title="Downvote" class="fas fa-paw text-gray-800 bg-blue-300 p-2 rounded shadow hover:bg-blue-400"></i>
    </button>
<?php endif; ?>