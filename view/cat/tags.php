<?php use \Michelf\MarkdownExtra; ?>

<div class="w-8/12 mt-20 mb-20 mr-auto ml-auto bg-gray-100 rounded shadow md:w-2/3 flex flex-row">
    <div class="w-1/6 p-8 rounded-l-lg border-r-2 border-gray-200">
        <a href="?tag=toys" class="text-lg">
            <i class="fas fa-hashtag mr-2 pb-4"></i>Toys
        </a><br>
        <a href="?tag=food" class="text-lg">
            <i class="fas fa-hashtag mr-2 pb-4"></i>Food
        </a><br>
        <a href="?tag=health" class="text-lg">
            <i class="fas fa-hashtag mr-2 pb-4"></i>Health
        </a><br>
        <a href="?tag=breeding" class="text-lg">
            <i class="fas fa-hashtag mr-2 pb-4"></i>Breeding
        </a><br>
        <a href="?tag=kitten" class="text-lg">
            <i class="fas fa-hashtag mr-2 pb-4"></i>Kitten
        </a><br>
        <a href="?tag=other" class="text-lg">
            <i class="fas fa-hashtag mr-2 pb-4"></i>Other
        </a>
    </div>
    <div class="w-5/6 p-8">
        <h4 class="text-2xl mb-6">Tags</h4>
        <p>Click on one of the tags to see questions that has the same tag.</p>
        <div class="flex flex-row flex-wrap mt-4">
            <?php foreach ($data["questions"] as $q) : ?>
                <div class="rounded shadow p-8 flex flex-row w-full mb-8">
                    <?php $t = explode(",", $q->tags); ?>
                    <div class="w-full">
                        <!-- HEADER -->
                        <div class="border-b-2 border-gray-200 flex flex-row justify-between w-full mb-4">
                            <a href="questions/single?id=<?= htmlentities($q->id) ?>">
                                <h2 class="text-xl"><?= htmlentities($q->title) ?></h2>
                            </a>
                            <div class="flex flex-row">
                                <?php foreach ($t as $subject) : ?>
                                    <p class="mr-6"><i class="fas fa-hashtag"></i> <?= htmlentities($subject) ?></p>
                                <?php endforeach; ?>
                                <p class="mr-6"><?= gmdate("Y-m-d", htmlentities($q->date)) ?></p>
                                <?php if ($_SESSION["user"] == $q->author) : ?>
                                    <form action="questions/delete" method="POST">
                                        <input type="hidden" name="id" value="<?= htmlentities($q->id) ?>">
                                        <button type="submit">
                                            <p><i class="fas fa-trash"></i></p>
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                        <p><?= MarkdownExtra::defaultTransform($q->question) ?></p>
                        <a class="float-right mt-4 border-b-2 border-blue-300" href="profile?user=<?= htmlentities($q->author) ?>">Author: <?= htmlentities($q->author) ?></a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
</div>