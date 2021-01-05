<?php
    $view = "";

    foreach ($data["votes"] as $vo) {
        if ($vo->questionId == $i->questionId && $vo->commentId == $i->id && $vo->voter == $_SESSION["user"] && $vo->vote == 0) {
            $view = "red";
            break;
        } else if ($vo->questionId == $i->questionId && $vo->commentId == $i->id && $vo->voter == $_SESSION["user"] && $vo->vote == 1) {
            $view = "gray";
            break;
        } else {
            $view = "normal";
        }
    }
?>

<?php if ($view == "red") : ?>
    <button class="pointer-events-none">
        <i title="Downvote" class="fas fa-paw text-gray-800 transform rotate-180 bg-red-400 p-2 rounded shadow hover:bg-blue-400"></i>
    </button>
<?php elseif ($view == "gray") : ?>
    <button class="pointer-events-none">
        <i title="Downvote" class="fas fa-paw text-gray-800 transform rotate-180 bg-gray-200 p-2 rounded shadow hover:bg-blue-400"></i>
    </button>
<?php elseif ($view == "normal"): ?>
    <button type="submit">
        <i title="Downvote" class="fas fa-paw text-gray-800 transform rotate-180 bg-blue-300 p-2 rounded shadow hover:bg-blue-400"></i>
    </button>
<?php endif; ?>

<?php if ($data["votes"] == []) : ?>
    <button type="submit">
        <i title="Downvote" class="fas fa-paw text-gray-800 transform rotate-180 bg-blue-300 p-2 rounded shadow hover:bg-blue-400"></i>
    </button>
<?php endif; ?>