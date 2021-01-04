<?php use \Michelf\MarkdownExtra; ?>

<div class="w-8/12 md:w-2/3 mt-20 mb-20 mr-auto ml-auto bg-gray-100 rounded shadow p-8 overflow-auto">

    <div class="w-full pb-8">
        <a href="../questions" class="p-2 mr-2 rounded shadow"><i class="fas fa-arrow-left"></i> Go back to overview</a>
    </div>



    <!-- ERROR-HANDLING -->
    <?php if ($data["fail"]) : ?>
        <div class="bg-red-400 p-2 text-center rounded shadow mb-8">
            <p>Oops! You're not the author of this question and does therefore not have access to this feature. 😿</p>
        </div>
    <?php elseif ($data["already"]) : ?>
        <div class="bg-red-400 p-2 text-center rounded shadow mb-8">
            <p>Oops! An answer has already been marked as the correct one.</p>
        </div>
    <?php elseif ($data["vote"]) : ?>
    <div class="bg-red-400 p-2 text-center rounded shadow mb-8">
        <p>Oops! You're the author of this answer/comment and can therefore not up/downvote it. </p>
    </div>
    <?php endif; ?>



    <!-- QUESTION -->
    <div class="flex flex-row">
        <div class="rounded shadow p-8 flex flex-row w-8/12 mb-8">
            <?php $t = explode(",", $data["res"]->tags); ?>
            <div class="w-full">
                <!-- HEADER -->
                <div class="border-b-2 border-gray-200 flex flex-row justify-between w-full mb-4">
                    <a href="questions/single?id=<?= htmlentities($data["res"]->id) ?>">
                        <h2 class="text-xl"><?= htmlentities($data["res"]->title) ?></h2>
                    </a>
                    <div class="flex flex-row">
                        <?php foreach ($t as $subject) : ?>
                            <a class="mr-6" href=""><i class="fas fa-hashtag"></i> <?= $subject ?></a>
                        <?php endforeach; ?>
                        <p><?= gmdate("Y-m-d", htmlentities($data["res"]->date)) ?></p>
                    </div>
                </div>
                <p><?= MarkdownExtra::defaultTransform($data["res"]->question) ?></p>
                <a class="float-right mt-4 border-b-2 border-blue-300" href="profile?user=<?= htmlentities($data["res"]->author) ?>">Author: <?= htmlentities($data["res"]->author) ?></a>
            </div>
        </div>

        <!-- FIELD TO ANSWER/COMMENT -->
        <div class="rounded shadow p-8 flex flex-row w-4/12 mb-8 justify-center">
            <form action="answer" method="POST">
                <h2 class="font-semibold">Do you have a smart answer/comment to <?= htmlentities($data["res"]->author) . "'s" ?> question? Write it down below!</h2>

                <textarea name="text" rows="5" class="border-solid border-blue-300 border-b-2 bg-gray-100 w-full" required></textarea>

                <input type="hidden" name="questionId" value="<?= htmlentities($data["res"]->id) ?>">
                
                <input name="type" class="w-full md:w-4/12 bg-blue-300 p-2 rounded shadow float-right hover:bg-blue-400 mt-2" type="submit" value="Comment">
                <input name="type" class="w-full md:w-4/12 bg-blue-300 p-2 rounded shadow float-right hover:bg-blue-400 mt-2 mr-6" type="submit" value="Answer">
            </form>
        </div>
    </div>



    <!-- COMMENTS -->
    <?php 
        foreach ($data["comments"] as $comment) {
            if ($comment->answerId == null) {
                include("incl/voteComments.php");
            }
        }
    ?>



    <!-- HEADER/CONTROLLS -->
    <div class="w-full border-b-2 border-gray-200 flex flex-row justify-between pb-4 pt-16">
        <h2 class="text-2xl mt-auto mb-auto">Answers:</h2>
        <div class="mt-auto mb-auto mr-0 ml-0">
            <a href="questions?sort=asc&type=date" class="bg-blue-300 p-2 mr-2 rounded shadow"><i class="fas fa-arrow-up"></i> Date</a>
            <a href="questions?sort=desc&type=date" class="bg-blue-300 p-2 mr-2 rounded shadow"><i class="fas fa-arrow-down"></i> Date</a>
            <a href="questions?sort=asc&type=points" class="bg-blue-300 p-2 mr-2 rounded shadow"><i class="fas fa-arrow-up"></i> Rank</a>
            <a href="questions?sort=desc&type=points" class="bg-blue-300 p-2 mr-2 rounded shadow"><i class="fas fa-arrow-down"></i> Rank</a>
        </div>
    </div>



    <!-- ANSWERS -->
    <?php foreach ($data["answers"] as $answer) : ?>
        <div class="flex flex-row">
            <div class="rounded shadow p-8 flex flex-row w-8/12 mb-8 mt-8">
                <?php include("incl/voteAnswers.php"); ?>
                <div class="w-full">
                    <p><?= MarkdownExtra::defaultTransform($answer->answer) ?></p>
                    <a class="float-right mt-4 border-b-2 border-blue-300" href="../profile?user=<?= htmlentities($answer->author) ?>">Author: <?= htmlentities($answer->author) ?></a>
                </div>
            </div>

            <!-- COMMMENT ANSWER FORM -->
            <div class="rounded shadow p-8 flex flex-row w-4/12 mb-8 justify-center mt-8">
                <form action="answer" method="POST">
                    <h2 class="font-semibold">Want to comment <?= $answer->author ?>'s answer? Write it down below!</h2>

                    <textarea name="text" rows="2" class="border-solid border-blue-300 border-b-2 bg-gray-100 w-full" required></textarea>

                    <input type="hidden" name="id" value="<?= htmlentities($answer->id) ?>">
                    <input type="hidden" name="questionId" value="<?= htmlentities($answer->questionId) ?>">

                    <input name="type" class="w-full md:w-4/12 bg-blue-300 p-2 rounded shadow float-right hover:bg-blue-400 mt-4" type="submit" value="Comment">
                </form>
            </div>
        </div>


        <!-- COMMENTS: ON ANSWERS -->
        <div class="w-full overflow-auto">
        <?php 
            foreach ($data["comments"] as $comment) {
                if ($comment->answerId == null) {
                    include("incl/voteComments.php");
                }
            }
        ?>
        </div>
    <?php endforeach; ?>
</div> 