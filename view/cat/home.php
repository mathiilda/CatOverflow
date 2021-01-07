<?php use \Michelf\MarkdownExtra; ?>
<?php $count = 1; ?>

<div class="w-11/12 lg:w-7/12 mt-10 mb-10 mr-auto ml-auto bg-gray-100 rounded shadow flex flex-col lg:flex-row justify-between p-4 sm:p-8">
    <!-- QUESTIONS -->
    <div class="w-full lg:w-4/12 flex flex-col flex-wrap sm:flex-row lg:flex-col">
        <div class="shadow rounded p-4 mb-8 w-full md:w-1/2 lg:w-full">
            <h2 class="mb-3 border-b-2 border-blue-200 text-lg">Most popular tags:</h2>
            <div class="flex flex-col">
                <?php foreach ($tags as $kt => $t) : ?>
                    <a class="mb-2" href="tags?tag=<?= htmlentities($kt) ?>">
                        <i class="fas text-gray-800 fa-hashtag"></i> <?= htmlentities($kt) . ": " . htmlentities($t); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="shadow rounded p-4 w-full md:w-1/2 lg:w-full mb-8">
            <h2 class="mb-3 border-b-2 border-blue-200 text-lg">Most active users:</h2>
            <div class="flex flex-col">
                <?php foreach ($users as $u) : ?>
                    <div class="mb-3">
                        <a class="mb-2" href="profile?user=<?= htmlentities($u->username) ?>">
                            <?= $count . ". " . htmlentities($u->username) ?>
                        </a>
                        <p>🐱 <?= htmlentities($u->points)?></p>
                    </div>
                    <?php $count += 1; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="w-full lg:ml-10">
        <h2 class="text-2xl mb-6">Latest questions:</h2>
        <?php foreach ($questions as $q) : ?>
            <!-- CONTROLLS -->
            <div class="rounded shadow p-8 flex flex-col sm:flex-row w-full mb-8">
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
                            <p><?= gmdate("Y-m-d", htmlentities($q->date)) ?></p>
                        </div>
                    </div>
                    <?= MarkdownExtra::defaultTransform($q->question) ?>
                    <a class="float-right mt-4 border-b-2 border-blue-300" href="profile?user=<?= htmlentities($q->author) ?>">Asked by: <?= htmlentities($q->author) ?></a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
