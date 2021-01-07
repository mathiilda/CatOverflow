<?php use \Michelf\MarkdownExtra; ?>

<!-- QUESTIONS -->
<?php foreach ($questions as $q) : ?>
    <!-- CONTROLLS -->
    <div class="rounded shadow p-8 flex flex-col sm:flex-row w-full mb-8">
        <div class="flex flex-row pb-12 sm:flex-col sm:pb-0 sm:justify-between justify-left w-2/24 mr-8 text-center text-xl h-1">
            <?php include("voteQuestions.php") ?>
        </div>
        
        <?php $t = explode(",", $q->tags); ?>
        <div class="w-full">
            <!-- HEADER -->
            <div class="border-b-2 border-gray-200 flex flex-col flex-wrap lg:flex-row justify-between w-full mb-4">
                <a class="mb-2 lg:mb-0" href="questions/single?id=<?= htmlentities($q->id) ?>">
                    <h2 class="text-xl"><?= htmlentities($q->title) ?></h2>
                </a>
                <div class="flex flex-row flex-wrap">
                    <?php if ($q->tags != null) : ?>
                        <?php foreach ($t as $subject) : ?>
                            <a class="mr-4" href="tags?tag=<?= htmlentities($subject) ?>">
                                <i class="fas text-gray-800 fa-hashtag"></i> <?= htmlentities($subject) ?>
                            </a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <?php if ($q->accepted == 1) : ?>
                        <p class="mr-4">
                            <i title="The question has an accepted answer." class="fas fa-check text-green-500"></i>
                        </p>
                    <?php else : ?>
                        <p class="mr-4">
                            <i title="The question doesn't have an accepted answer." class="fas text-gray-800 fa-check"></i>
                        </p>
                    <?php endif; ?>
                    <p class="mr-4">
                        <i class="fas text-gray-800 fa-comment"></i>
                        <?= $q->answered ?>
                    </p>
                    <p class="mr-4"><?= gmdate("Y-m-d", htmlentities($q->date)) ?></p>
                    <?php if ($_SESSION["user"] == $q->author) : ?>
                        <form action="questions/delete" method="POST">
                            <input type="hidden" name="id" value="<?= htmlentities($q->id) ?>">
                            <button type="submit">
                                <p><i title="Delete" class="fas text-gray-800 fa-trash"></i></p>
                            </button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
            <?= MarkdownExtra::defaultTransform($q->question) ?>
            <a class="float-right mt-4 border-b-2 border-blue-300" href="profile?user=<?= htmlentities($q->author) ?>">Asked by: <?= htmlentities($q->author) ?></a>
        </div>
    </div>
<?php endforeach; ?>