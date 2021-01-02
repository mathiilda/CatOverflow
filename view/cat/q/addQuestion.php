<div class="w-10/12 mt-20 mb-20 mr-auto ml-auto bg-gray-100 p-8 rounded shadow md:w-4/12">
    <div class="flex-col justify-center w-10/12 mr-auto ml-auto overflow-auto">
        <h2 class="text-xl mb-8"><i class="fas fa-plus"></i> Add question</h2>
        <form action="crud" method="POST">
            <div>
                <label for="">Title:</label><br>
                <input required name="title" class="border-solid border-blue-300 border-b-2 bg-gray-100 w-full" type="text"><br><br>
            </div>
            <label for="">Tags:</label><br>
            <div class="flex flex-row justify-between">
                <div>
                    <input class="mt-4" type="checkbox" name="tags[]" value="Vet">
                    <label for="vet">Vet</label><br>

                    <input class="mt-4" type="checkbox" name="tags[]" value="Toys">
                    <label for="toys">Toys</label><br>
                </div>
                <div>
                <input class="mt-4" type="checkbox" name="tags[]" value="Food">
                    <label for="food">Food</label><br>

                    <input class="mt-4" type="checkbox" name="tags[]" value="Health">
                    <label for="health">Health</label><br>
                </div>
                <div>
                    <input class="mt-4" type="checkbox" name="tags[]" value="Breeding">
                    <label for="breeding">Breeding</label><br>

                    <input class="mt-4" type="checkbox" name="tags[]" value="Other">
                    <label for="other">Other</label><br>
                </div>
            </div><br>
            <div>
                <label for="">Question:</label><br>
                <textarea name="question" rows="1" class="border-solid border-blue-300 border-b-2 bg-gray-100 w-full" required></textarea><br><br>
            </div><br>
            <input name="action" class="w-full md:w-4/12 bg-blue-300 p-2 rounded shadow float-right hover:bg-blue-400" type="submit" value="Add">
        </form>
    </div>
</div>