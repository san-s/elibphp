<div class="w-1/2 my-16 mx-auto shadow-lg rounded-lg p-8">
    <h3 class="text-black text-2xl font-bold">Add book</h3>
    <div class="mt-4">
        <form method="post" enctype="multipart/form-data" action="inc/controller/account_controller.php">

            <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="inline-full-name">
                Book name
            </label>
            <input type="text" name="book_name" id="book_name" class="form-control mt-1" placeholder="Enter username">
            <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4 mt-3" for="inline-full-name">
                Description
            </label>
            <input type="text" name="book_desc" id="book_desc" class="form-control mt-1" placeholder="Enter description">
            <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4 mt-3" for="inline-full-name">
                Author
            </label>
            <input type="tel" name="book_author" id="book_author" class="form-control mt-1" placeholder="Enter author">
            <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4 mt-3" for="inline-full-name">
                Language
            </label>
            <input type="tel" name="book_lang" id="book_lang" class="form-control mt-1" placeholder="Enter lang">
            <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4 mt-3" for="inline-full-name">
                Book file
            </label>
            <span class="text-xs text-gray-500 italic">Leave blank if you don't want to change</span>
            <input type="file" name="book_file" id="book_file" class="form-control mt-1">
            <button type="submit" name="update_account" class="px-4 py-2 mt-4 rounded-full bg-indigo-600 font-bold text-sm text-white">
                Update account
            </button>
        </form>
    </div>

</div>


