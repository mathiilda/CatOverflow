<?php use \Michelf\MarkdownExtra; ?>

<?php foreach($data["questions"] as $q) : ?>
    <div class="shadow rounded p-4 mb-6">
        <div class="border-b-2 border-blue-300 mb-2 flex flex-row justify-between">
            <a href="questions/single?id=<?= htmlentities($q->id) ?>">
                <h2 class="text-lg mb-2"><?= htmlentities($q->title) ?></h2>
            </a>
            <?php if ($q->answered) : ?>
                <i class="fas fa-user-check text-green-500 text-xl"></i>
            <?php else : ?>
                <i class="fas fa-user-times text-xl"></i>
            <?php endif; ?>
        </div>
        <p><?= MarkdownExtra::defaultTransform($q->question)?></p>
    </div>
<?php endforeach; ?>