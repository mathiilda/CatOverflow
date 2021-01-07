<form action="questions/vote" method="POST">
    <input type="hidden" name="action" value="upvote">
    <input type="hidden" name="type" value="question">
    <input type="hidden" name="questionId" value="<?= htmlentities($q->id) ?>">
    <input type="hidden" name="author" value="<?= htmlentities($q->author) ?>">

    <?php
    foreach ($data["votes"] as $v) {
        if ($v->questionId == $q->id && $v->voter == $_SESSION["user"] && $v->vote == 0) {
            $view = "gray";
            break;
        } else if ($v->questionId == $q->id && $v->voter == $_SESSION["user"] && $v->vote == 1) {
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
    <?php else : ?>
        <button type="submit">
            <i title="Upvote" class="fas fa-paw text-gray-800 bg-blue-300 p-2 rounded shadow hover:bg-blue-400"></i>
        </button>
    <?php endif; ?>

    <?php if ($data["votes"] == []) : ?>
        <button type="submit">
            <i title="Downvote" class="fas fa-paw text-gray-800 bg-blue-300 p-2 rounded shadow hover:bg-blue-400"></i>
        </button>
    <?php endif; ?>
</form>

<p class="mt-1 mb-1 ml-2 mr-2 sm:ml-0 sm:mr-0"><?= htmlentities($q->points) ?></p>

<form action="questions/vote" method="POST">
    <input type="hidden" name="action" value="downvote">
    <input type="hidden" name="type" value="question">
    <input type="hidden" name="questionId" value="<?= htmlentities($q->id) ?>">
    <input type="hidden" name="author" value="<?= htmlentities($q->author) ?>">

    <?php
    foreach ($data["votes"] as $v) {
        if ($v->questionId == $q->id && $v->voter == $_SESSION["user"] && $v->vote == 0) {
            $view = "red";
            break;
        } else if ($v->questionId == $q->id && $v->voter == $_SESSION["user"] && $v->vote == 1) {
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
    <?php else : ?>
        <button type="submit">
            <i title="Downvote" class="fas fa-paw text-gray-800 transform rotate-180 bg-blue-300 p-2 rounded shadow hover:bg-blue-400"></i>
        </button>
    <?php endif; ?>

    <?php if ($data["votes"] == []) : ?>
        <button type="submit">
            <i title="Downvote" class="fas fa-paw text-gray-800 transform rotate-180 bg-blue-300 p-2 rounded shadow hover:bg-blue-400"></i>
        </button>
    <?php endif; ?>

</form>