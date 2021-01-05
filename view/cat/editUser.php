<div class="w-10/12 mt-10 mb-10 mr-auto ml-auto bg-gray-100 p-8 rounded shadow md:w-4/12">
    <div class="flex-col justify-center w-10/12 mr-auto ml-auto overflow-auto">
        <h2 class="text-xl mb-8">🖊️ Edit <?= $_SESSION["user"] . "'s" ?> account</h2>
        <form action="crud" method="POST">
            <div>
                <label for="">Email:</label><br>
                <input name="email" class="border-solid border-blue-300 border-b-2 bg-gray-100 w-full" type="email" value="<?= $_SESSION["email"]?>" require><br><br>
            </div>
            <div>
                <label for="">Password:</label><br>
                <input name="pass" class="border-solid border-blue-300 border-b-2 bg-gray-100 w-full" type="password"><br><br>
            </div><br>
            <input name="action" class="w-full md:w-4/12 bg-blue-300 p-2 rounded shadow float-right hover:bg-blue-400" type="submit" value="Edit">
        </form>
    </div>
</div>