<div class="w-10/12 mt-44 mr-auto ml-auto bg-gray-100 p-8 rounded shadow md:w-1/2">

    <!-- Error handling. -->
    <?php if ($data["failSignIn"]) : ?>
        <div class="bg-red-400 w-2/3 rounded shadow mr-auto ml-auto p-2 text-center">
            <p>Something went wrong! Try a different password or another username.</p>
        </div><br><br>
    <?php elseif ($data["fail"]) : ?>
        <div class="bg-red-400 w-2/3 rounded shadow mr-auto ml-auto p-2 text-center">
            <p>Oh no! Someone is already using that username. Try another one.</p>
        </div><br><br>
    <?php endif; ?>

    <!-- Different text based on new user or not. -->
    <?php if ($data["signIn"] == false) : ?>
        <h1 class="text-center text-xl mb-2">Welcome to CatOverflow! 🐱</h1>
        <p class="text-center w-2/3 mr-auto ml-auto">The website for anyone who wants to talk about cats. Sign up today to join our amazing cat-community!</p><br>
        <p class="text-center">Already a member?
            <a class="underline text-blue-400 font-bold" href="?signIn=true">Sign in!</a>
        </p><br><br>
    <?php else : ?>
        <h1 class="text-center text-xl mb-2">Welcome back to CatOverflow! 🐱</h1>
        <p class="text-center w-2/3 mr-auto ml-auto">Sign in down below.</p><br><br>
    <?php endif; ?>

    <!-- Sign in/up form -->
    <div class="flex-col justify-center w-10/12 mr-auto ml-auto overflow-auto">
        <form action="signUpIn" method="POST">
            <div>
                <label for="">Username:</label><br>
                <input name="user" class="border-solid border-blue-300 border-b-2 bg-gray-100 w-full" type="text" minlength="4" require><br><br>
            </div>
            <?php if ($data["signIn"] == false) : ?>
                <div>
                    <label for="">Email:</label><br>
                    <input name="email" class="border-solid border-blue-300 border-b-2 bg-gray-100 w-full" type="email" require><br><br>
                </div>
            <?php endif; ?>
            <div>
                <label for="">Password:</label><br>
                <input name="pass" class="border-solid border-blue-300 border-b-2 bg-gray-100 w-full" type="password" minlength="6" require><br><br>
            </div><br>

            <?php if ($data["signIn"] == false) : ?>
                <input name="action" class="w-full md:w-6/12 bg-blue-300 p-2 rounded shadow float-right hover:bg-blue-400" type="submit" value="Sign up">
            <?php else : ?>
                <input name="action" class="w-full md:w-6/12 bg-blue-300 p-2 rounded shadow float-right hover:bg-blue-400" type="submit" value="Sign in">
            <?php endif; ?>
        </form>
    </div>
</div>