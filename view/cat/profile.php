<?php use \Michelf\MarkdownExtra; ?>

<div class="w-8/12 mt-20 mb-20 mr-auto ml-auto bg-gray-100 rounded shadow md:w-2/3 flex flex-row">
    <div class="w-1/3 p-8 rounded-l-lg border-r-2 border-gray-200">
        <div class="flex flex-row border-b-2 border-gray-200 pb-6 mb-4">
            <img class="rounded-full" src="<?= htmlentities($data["gravatar"]) ?>" alt="gravatar">
            <div class="ml-4">
                <h2 class="text-xl font-medium border-b-2 border-blue-300 mb-2"><?= htmlentities($data["currentUser"]) ?></h2>
                <p>🐱 <?= htmlentities($data["points"]) ?></p>
            </div>
        </div>
            <p class="mb-4">
                <a href="profile?user=<?= $data["currentUser"] ?>&view=q">❓ Asked questions</a>
            </p>
            <p class="mb-4">
                <a href="profile?user=<?= $data["currentUser"] ?>&view=l">🐱‍💻 Latest activity</a>
            </p>
        <?php if ($data["currentUser"] == $_SESSION["user"]) : ?>
            <p class="mb-4">
                <a href="profile/edit">🖊️ Edit account</a>
            </p>
            <p>
                <a href="profile/logOut">🐾 Log out</a>
            </p>
        <?php endif; ?>
    </div>
    <div class="w-2/3 p-8">
        <?php if ($data["edit"]) : ?>
            <div class="bg-green-200 p-2 text-center rounded shadow mb-4">
                <p>Account updated successfully! 👏</p>
            </div>
        <?php endif; ?>
        <?php if ($data["view"] == "q") : ?>
            <h4 class="text-2xl mb-6">Asked questions</h4>
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

        <?php else : ?>
            <h4 class="text-2xl mb-6">Latest activity</h4>
            <div class="shadow rounded p-2 mb-6">
                <div class="border-b-2 border-blue-300 mb-2 flex flex-row justify-between">
                    <h2 class="text-lg mb-2">Comment</h2>
                    <p>2021-01-01</p>
                </div>
                <p>Actual comment bla bla bla bla bla</p>
            </div>
        <?php endif; ?>
    </div>
</div>