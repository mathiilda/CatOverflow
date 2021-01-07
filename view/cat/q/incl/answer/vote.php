<?php use \Michelf\MarkdownExtra; ?>

<div class="flex flex-col w-2/24 mr-8 justify-start text-center text-xl h-30">
    <form action="vote" method="POST">
        <input type="hidden" name="action" value="upvote">
        <input type="hidden" name="type" value="answer">
        <input type="hidden" name="questionId" value="<?= htmlentities($answer->questionId) ?>">
        <input type="hidden" name="answerId" value="<?= htmlentities($answer->id) ?>">
        <input type="hidden" name="author" value="<?= htmlentities($answer->author) ?>">
        <?php include("upVote.php") ?>
    </form>
    <p class="mt-1 mb-1"><?= htmlentities($answer->points) ?></p>
    <form action="vote" method="POST">
        <input type="hidden" name="action" value="downvote">
        <input type="hidden" name="type" value="answer">
        <input type="hidden" name="questionId" value="<?= htmlentities($answer->questionId) ?>">
        <input type="hidden" name="answerId" value="<?= htmlentities($answer->id) ?>">
        <input type="hidden" name="author" value="<?= htmlentities($answer->author) ?>">
        <?php include("downVote.php") ?>
    </form>
    <?php if ($answer->accepted == 1) : ?>
        <i class="fas fa-check text-green-500 "></i>
    <?php else : ?>
        <form action="accept" method="POST">
            <input type="hidden" name="id" value="<?= htmlentities($answer->id) ?>">
            <input type="hidden" name="questionId" value="<?= htmlentities($answer->questionId) ?>">
            <button type="submit">
                <i class="fas fa-check"></i>
            </button>
        </form>
    <?php endif; ?>
</div>
<div class="w-full">
    <p><?= MarkdownExtra::defaultTransform($answer->answer) ?></p>
    <p class="float-right mt-4 b-0">
        <?= gmdate("Y-m-d", htmlentities($answer->date)) ?> |
        <a class="border-b-2 border-blue-300" href="../profile?user=<?= htmlentities($answer->author) ?>">Author: <?= htmlentities($answer->author) ?></a>
    </p>
</div>