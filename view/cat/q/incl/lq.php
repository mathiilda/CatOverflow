<?php use \Michelf\MarkdownExtra; ?>

<?php foreach($data["latestQuestions"] as $lq) : ?>
    <div class="shadow rounded p-4 mb-6">
        <div class="border-b-2 border-blue-300 mb-2 flex flex-row justify-between">
            <a href="questions/single?id=<?= htmlentities($lq->id) ?>">
                <h2 class="text-lg mb-2"><?= htmlentities($lq->title) ?></h2>
            </a>
            <div class="flex flex-row">
                <p class="mr-4"><?= gmdate("Y-m-d", htmlentities($lq->date)) ?></p>
                <a class="text-right" href="questions/single?id=<?= htmlentities($lq->id) ?>">
                    <i class="text-xl fas fa-external-link-alt mr-4"></i>
                </a>
                <?php if ($lq->answered) : ?>
                    <i class="fas fa-user-check text-green-500 text-xl"></i>
                <?php else : ?>
                    <i class="fas fa-user-times text-xl"></i>
                <?php endif; ?>
            </div>
        </div>
        <p><?= MarkdownExtra::defaultTransform($lq->question)?></p>
    </div>
<?php endforeach; ?>