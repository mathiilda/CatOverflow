<div class="w-7/12 mt-10 mb-10 mr-auto ml-auto bg-gray-100 rounded shadow md:w-7/12 p-8">
    <h2 class="mb-2 text-2xl">Users</h2>
    <p class="mb-6">You can find all users here. Simply press on their username or their profile-picture to visit their profile.</p>
    <div class="flex flex-row flex-wrap justify-start">
        <?php foreach ($data["users"] as $u) : ?>
            <div class="flex flex-row border-b-2 border-gray-200 pb-6 mb-6 shadow p-4 2xl:w-1/4 lg:w-1/3 md:w-1/2 w-full">
                <a href="profile?user=<?= $u->username ?>">
                    <img class="rounded-full" src="<?= "https://www.gravatar.com/avatar/" . md5(strtolower(trim($u->email)))?>" alt="gravatar">
                </a>
                <div class="ml-4">
                    <a href="profile?user=<?= $u->username ?>">
                        <h2 class="text-xl font-medium border-b-2 border-blue-300 mb-2"><?= $u->username ?></h2>
                    </a>
                    <p>🐱 <?= $u->points ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>