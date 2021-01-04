<div class="flex flex-col w-2/24 mr-8 justify-between text-center text-2xl h-36">
    <form action="vote" method="POST">
        <input type="hidden" name="action" value="upvote">
        <input type="hidden" name="type" value="answer">
        <input type="hidden" name="questionId" value="<?= $answer->questionId ?>">
        <input type="hidden" name="answerId" value="<?= $answer->id ?>">
        <input type="hidden" name="author" value="<?= $answer->author ?>">
        <button type="submit">
            <i title="Upvote" class="fas fa-paw bg-blue-300 p-2 rounded shadow hover:bg-blue-400"></i>
        </button>
    </form>
    <p class="mt-1 mb-1"><?= $answer->points ?></p>
    <form action="vote" method="POST">
        <input type="hidden" name="action" value="downvote">
        <input type="hidden" name="type" value="answer">
        <input type="hidden" name="questionId" value="<?= $answer->questionId ?>">
        <input type="hidden" name="answerId" value="<?= $answer->id ?>">
        <input type="hidden" name="author" value="<?= $answer->author ?>">
        <button type="submit">
            <i title="Downvote" class="fas fa-paw transform rotate-180 bg-blue-300 p-2 rounded shadow mb-4 hover:bg-blue-400"></i>
        </button>
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