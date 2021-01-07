<?php use \Michelf\MarkdownExtra; ?>

<?php foreach ($data["latestComments"] as $lc) : ?>
    <div class="shadow rounded p-4 mb-6">
        <div class="border-b-2 border-blue-300 mb-2 flex flex-row justify-end">
            <div class="flex flex-row mb-2">
                <p class="mr-4"><?= gmdate("Y-m-d", htmlentities($lc->date)) ?></p>
                <a class="text-right" href="questions/single?id=<?= htmlentities($lc->questionId) ?>">
                    <i class="fas fa-external-link-alt"></i>
                </a>
            </div>
        </div>
        <p><?= MarkdownExtra::defaultTransform($lc->comment)?></p>
    </div>
<?php endforeach; ?>