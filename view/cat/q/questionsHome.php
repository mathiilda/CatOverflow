<div class="w-8/12 lg:w-12/12 xl:w-10/12 2xl:w-8/12 mt-20 mb-20 mr-auto ml-auto bg-gray-100 rounded shadow p-8">

    <!-- HEADER -->
    <div class="flex flex-row justify-between border-b-2 border-gray-200 pb-6 mb-8">
        <div>
            <h2 class="text-2xl">Questions</h2>
            <p>Click on the title of the question to see answers and comments.</p>
        </div>
        <div class="mt-auto mb-auto mr-0 ml-0">
            <a href="questions/add" class="bg-blue-300 p-2 mr-2 rounded shadow"><i class="fas fa-plus"></i> Add question</a>
            <a href="questions?sort=asc&type=date" class="bg-blue-300 p-2 mr-2 rounded shadow"><i class="fas fa-arrow-up"></i> Date</a>
            <a href="questions?sort=desc&type=date" class="bg-blue-300 p-2 mr-2 rounded shadow"><i class="fas fa-arrow-down"></i> Date</a>
            <a href="questions?sort=asc&type=points" class="bg-blue-300 p-2 mr-2 rounded shadow"><i class="fas fa-arrow-up"></i> Rank</a>
            <a href="questions?sort=desc&type=points" class="bg-blue-300 p-2 mr-2 rounded shadow"><i class="fas fa-arrow-down"></i> Rank</a>
        </div>
    </div>
    
    <!-- RESPONSE ON CREATION/DELETION OF QUESTION -->
    <?php if ($data["edit"]) : ?>
        <div class="bg-green-200 p-2 text-center rounded shadow mb-8">
            <p>Question <span class="font-semibold">created</span> successfully! 👏</p>
        </div>
    <?php elseif ($data["delete"]) : ?>
        <div class="bg-green-200 p-2 text-center rounded shadow mb-8">
            <p>Question <span class="font-semibold">deleted</span> successfully! 👏</p>
        </div>
    <?php endif; ?>

    <!-- QUESTIONS -->
    <?php foreach ($questions as $q) : ?>
        <!-- CONTROLLS -->
        <div class="rounded shadow p-8 flex flex-row w-full mb-8">
            <div class="flex flex-col w-2/24 mr-8 justify-between text-center text-2xl h-36">
                <i class="fas fa-arrow-up bg-blue-300 p-2 rounded shadow mb-4 hover:bg-blue-400"></i>
                <i class="fas fa-arrow-down bg-blue-300 p-2 rounded shadow mb-4 hover:bg-blue-400"></i>
                <?php if ($q->accepted == 1) : ?>
                    <i class="fas fa-check text-green-500 "></i>
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
                <p><?= htmlentities($q->question) ?></p>
                <a class="float-right mt-4 border-b-2 border-blue-300" href="profile?user=<?= htmlentities($q->author) ?>">Author: <?= htmlentities($q->author) ?></a>
            </div>
        </div>
    <?php endforeach; ?>
</div>