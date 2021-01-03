<?php use \Michelf\MarkdownExtra; ?>

<!-- QUESTIONS -->
<?php foreach ($questions as $q) : ?>
        <!-- CONTROLLS -->
        <div class="rounded shadow p-8 flex flex-row w-full mb-8">
            <div class="flex flex-col w-2/24 mr-8 justify-between text-center text-2xl h-36">
                <i class="fas fa-arrow-up bg-blue-300 p-2 rounded shadow mb-4 hover:bg-blue-400"></i>
                <i class="fas fa-arrow-down bg-blue-300 p-2 rounded shadow mb-4 hover:bg-blue-400"></i>
                <?php if ($q->accepted == 1) : ?>
                    <i class="fas fa-check text-green-500"></i>
                <?php else : ?>
                    <i class="fas fa-check"></i>
                <?php endif; ?>
            </div>
            
            <?php $t = explode(",", $q->tags); ?>
            <div class="w-full">
                <!-- HEADER -->
                <div class="border-b-2 border-gray-200 flex flex-row justify-between w-full mb-4">
                    <a href="questions/single?id=<?= htmlentities($q->id) ?>">
                        <h2 class="text-xl"><?= htmlentities($q->title) ?></h2>
                    </a>
                    <div class="flex flex-row">
                        <?php foreach ($t as $subject) : ?>
                            <a class="mr-6" href="tags?tag=<?= htmlentities($subject) ?>">
                                <i class="fas fa-hashtag"></i> <?= htmlentities($subject) ?>
                            </a>
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