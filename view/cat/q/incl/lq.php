<?php use \Michelf\MarkdownExtra; ?>

<?php foreach($data["latestQuestions"] as $lq) : ?>
    <div class="shadow rounded p-4 mb-6">
        <div class="border-b-2 border-gray-200 flex flex-col flex-wrap md:flex-row justify-between">
            <a href="questions/single?id=<?= htmlentities($lq->id) ?>">
                <h2 class="text-lg mb-2"><?= htmlentities($lq->title) ?></h2>
            </a>
            <div class="flex flex-row mb-2 lg:mb-0">
                <p class="mr-4"><?= gmdate("Y-m-d", htmlentities($lq->date)) ?></p>
                <a class="text-right" href="questions/single?id=<?= htmlentities($lq->id) ?>">
                    <i class="fas fa-external-link-alt mr-4"></i>
                </a>
                <?php if ($lq->answered) : ?>
                    <i class="fas text-xl fa-comment text-green-500"></i>
                <?php else : ?>
                    <i class="fas text-xl fa-comment"></i>
                <?php endif; ?>
            </div>
        </div>
        <p><?= MarkdownExtra::defaultTransform($lq->question)?></p>
    </div>
<?php endforeach; ?>