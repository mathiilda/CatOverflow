<div class="w-8/12 md:w-2/3 mt-20 mb-20 mr-auto ml-auto bg-gray-100 rounded shadow p-8 overflow-auto">
    <?php if ($data["fail"]) : ?>
        <div class="bg-red-400 p-2 text-center rounded shadow mb-8">
            <p>Oops! You're not the author of this question and does therefore not have access to this feature. 😿</p>
        </div>
    <?php elseif ($data["already"]) : ?>
        <div class="bg-red-400 p-2 text-center rounded shadow mb-8">
            <p>Oops! An answer has already been marked as the correct one. </p>
        </div>
    <?php endif; ?>

    <div class=" flex flex-row">
        <div class="rounded shadow p-8 flex flex-row w-8/12 mb-8">
            <?php $t = explode(",", $data["res"]->tags); ?>
            <div class="w-full">
                <!-- HEADER -->
                <div class="border-b-2 border-gray-200 flex flex-row justify-between w-full mb-4">
                    <a href="questions/single?id=<?= $data["res"]->id ?>">
                        <h2 class="text-xl"><?= $data["res"]->title ?></h2>
                    </a>
                    <div class="flex flex-row">
                        <?php foreach ($t as $subject) : ?>
                            <p class="mr-6"><i class="fas fa-hashtag"></i> <?= $subject ?></p>
                        <?php endforeach; ?>
                        <p><?= gmdate("Y-m-d",$data["res"]->date) ?></p>
                    </div>
                </div>
                <p><?= $data["res"]->question ?></p>
                <a class="float-right mt-4 border-b-2 border-blue-300" href="profile?user=<?= $data["res"]->author ?>">Author: <?= $data["res"]->author ?></a>
            </div>
        </div>

        <div class="rounded shadow p-8 flex flex-row w-4/12 mb-8 justify-center">
            <form action="answer" method="POST">
                <h2 class="font-semibold">Do you have a smart answer to <?= $data["res"]->author . "'s" ?> question? Write it down below!</h2>

                <textarea name="text" rows="5" class="border-solid border-blue-300 border-b-2 bg-gray-100 w-full" required></textarea>

                <input type="hidden" name="id" value="<?= $data["res"]->id ?>">

                <input name="type" class="w-full md:w-4/12 bg-blue-300 p-2 rounded shadow float-right hover:bg-blue-400" type="submit" value="Answer">
            </form>
        </div>
    </div>

    <h2 class="text-2xl mb-8 border-b-2 border-gray-200">Answers:</h2>
    <?php foreach ($data["answers"] as $answer) : ?>
        <div class="rounded shadow p-8 flex flex-row w-full mb-8">
            <div class="flex flex-col w-2/24 mr-8 justify-between text-center text-2xl h-36">
                <i class="fas fa-arrow-up bg-blue-300 p-2 rounded shadow mb-4 hover:bg-blue-400"></i>
                <i class="fas fa-arrow-down bg-blue-300 p-2 rounded shadow mb-4 hover:bg-blue-400"></i>
                <?php if ($answer->accepted == 1) : ?>
                    <i class="fas fa-check text-green-500 "></i>
                <?php else : ?>
                    <form action="accept" method="POST">
                        <input type="hidden" name="id" value="<?= $answer->id ?>">
                        <input type="hidden" name="questionId" value="<?= $answer->questionId ?>">
                        <button type="submit">
                            <i class="fas fa-check"></i>
                        </button>
                    </form>
                <?php endif; ?>
            </div>
            <div class="w-full">
                <p><?= $answer->answer ?></p>
                <a class="float-right mt-4 border-b-2 border-blue-300" href="../profile?user=<?= $answer->author ?>">Author: <?= $answer->author ?></a>
            </div>
        </div>
    <?php endforeach; ?>
    
</div>