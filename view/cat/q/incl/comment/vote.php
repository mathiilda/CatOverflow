<?php use \Michelf\MarkdownExtra; ?>

<?php foreach ($iterate as $i) : ?>
    <?php if ($i->answerId == $a) : ?>
        <div class="rounded shadow p-4 pl-8 w-full mb-4 bg-gray-100 border-l-2 border-blue-300 bg-blue-100 flex flex-row">
            <div class="text-center">
                <form action="vote" method="POST">
                    <input type="hidden" name="action" value="upvote">
                    <input type="hidden" name="type" value="<?= $v ?>">
                    <input type="hidden" name="questionId" value="<?= htmlentities($i->questionId) ?>">
                    <input type="hidden" name="commentId" value="<?= htmlentities($i->id) ?>">
                    <input type="hidden" name="answerId" value="<?= htmlentities($i->answerId) ?>">
                    <input type="hidden" name="author" value="<?= htmlentities($i->author) ?>">
                    <input type="hidden" name="typeSort" value="<?= htmlentities($_GET["type"] ?? "date") ?>">
                    <input type="hidden" name="sort" value="<?= htmlentities($_GET["sort"] ?? "asc") ?>">
                    <?php include("upVote.php") ?>
                </form>
                <p class="mt-1 mb-1"><?= htmlentities($i->points) ?></p>
                <form action="vote" method="POST">
                    <input type="hidden" name="action" value="downvote">
                    <input type="hidden" name="type" value="<?= $v ?>">
                    <input type="hidden" name="questionId" value="<?= htmlentities($i->questionId) ?>">
                    <input type="hidden" name="commentId" value="<?= htmlentities($i->id) ?>">
                    <input type="hidden" name="answerId" value="<?= htmlentities($i->answerId) ?>">
                    <input type="hidden" name="author" value="<?= htmlentities($i->author) ?>">
                    <input type="hidden" name="typeSort" value="<?= htmlentities($_GET["type"] ?? "date") ?>">
                    <input type="hidden" name="sort" value="<?= htmlentities($_GET["sort"] ?? "asc") ?>">
                    <?php include("downVote.php") ?>
                </form>
            </div>
            <div class="ml-8">
                <p class="text-sm"> <?= MarkdownExtra::defaultTransform($i->comment) ?>
                    <a class="border-b-2 border-blue-300" href="../profile?user=<?= htmlentities($i->author) ?>"> - <?= htmlentities($i->author) ?></a>
                </p>
            </div>
        </div>
    <?php endif; ?>
<?php endforeach; ?>