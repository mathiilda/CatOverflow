<?php use \Michelf\MarkdownExtra; ?>

<div class="rounded shadow p-4 pl-8 w-full mb-4 bg-gray-100 border-l-2 border-blue-300 bg-blue-100 flex flex-row">
    <div class="text-center">
        <form action="vote" method="POST">
            <input type="hidden" name="action" value="upvote">
            <input type="hidden" name="type" value="comment">
            <input type="hidden" name="questionId" value="<?= $comment->questionId ?>">
            <input type="hidden" name="commentId" value="<?= $comment->id ?>">
            <input type="hidden" name="answerId" value="<?= $comment->answerId ?>">
            <input type="hidden" name="author" value="<?= $comment->author ?>">
            <button type="submit">
                <i title="Upvote" class="fas fa-paw bg-blue-300 p-2 rounded shadow hover:bg-blue-400"></i>
            </button>
        </form>
        <p class="mt-1 mb-1"><?= $comment->points ?></p>
        <form action="vote" method="POST">
            <input type="hidden" name="action" value="downvote">
            <input type="hidden" name="type" value="comment">
            <input type="hidden" name="questionId" value="<?= $comment->questionId ?>">
            <input type="hidden" name="commentId" value="<?= $comment->id ?>">
            <input type="hidden" name="answerId" value="<?= $comment->answerId ?>">
            <input type="hidden" name="author" value="<?= $comment->author ?>">
            <button type="submit">
                <i title="Downvote" class="fas fa-paw transform rotate-180 bg-blue-300 p-2 rounded shadow hover:bg-blue-400"></i>
            </button>
        </form>
    </div>
    <div class="ml-8">
        <p class="text-sm"> <?= MarkdownExtra::defaultTransform($comment->comment) ?>
        <a class="border-b-2 border-blue-300" href="../profile?user=<?= $comment->author ?>"> - <?= $comment->author ?></a>
        </p>
    </div>
</div>