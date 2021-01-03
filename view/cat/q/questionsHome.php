<?php use \Michelf\MarkdownExtra; ?>

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

    <?php include("qContainer.php") ?>
    
</div>