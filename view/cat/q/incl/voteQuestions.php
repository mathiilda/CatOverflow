<form action="questions/vote" method="POST">
    <input type="hidden" name="action" value="upvote">
    <input type="hidden" name="type" value="question">
    <input type="hidden" name="questionId" value="<?= $q->id ?>">
    <input type="hidden" name="author" value="<?= $q->author ?>">
    <button type="submit">
        <i title="Upvote" class="fas fa-paw bg-blue-300 p-2 rounded shadow hover:bg-blue-400"></i>
    </button>
</form>
<p class="mt-1 mb-1"><?= $q->points ?></p>
<form action="questions/vote" method="POST">
    <input type="hidden" name="action" value="downvote">
    <input type="hidden" name="type" value="question">
    <input type="hidden" name="questionId" value="<?= $q->id ?>">
    <input type="hidden" name="author" value="<?= $q->author ?>">
    <button type="submit">
        <i title="Downvote" class="fas fa-paw transform rotate-180 bg-blue-300 p-2 rounded shadow mb-4 hover:bg-blue-400"></i>
    </button>
</form>