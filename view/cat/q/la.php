<?php use \Michelf\MarkdownExtra; ?>

<?php foreach($data["latestAnswers"] as $la) : ?>
    <div class="shadow rounded p-4 mb-6">
        <div class="border-b-2 border-blue-300 mb-2 flex flex-row justify-end">
            <div class="flex flex-row mb-2">
                <p class="mr-4"><?= gmdate("Y-m-d", htmlentities($la->date)) ?></p>
                <a class="text-right" href="questions/single?id=<?= htmlentities($la->questionId) ?>">
                    <i class="fas fa-external-link-alt"></i>
                </a>
            </div>
        </div>
        <p><?= MarkdownExtra::defaultTransform($la->answer)?></p>
    </div>
<?php endforeach; ?>