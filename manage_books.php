<!DOCTYPE html>
<html lang="en">
<?php if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (
    !isset($_SESSION['user'])
) {
    $_SESSION['redirect'] = 'admin/index.php';
    header("Location: http://" . $_SERVER['HTTP_HOST'] . '/Web');
} ?>
<?php include("inc/head.php") ?>

<body class="bg-white text-base dark:bg-gray-800 dark:text-gray-100 pt-20">
    <div id="app" data-v-app="">

        <?php
        if (isset($_SESSION["success_message"])) {
            echo '<script type="text/javascript">toastr.success("' . $_SESSION["success_message"] . '")</script>';
            unset($_SESSION["success_message"]);
        }
        if (isset($_SESSION["error_message"])) {
            echo '<script type="text/javascript">toastr.error("' . $_SESSION["error_message"] . '")</script>';
            unset($_SESSION["error_message"]);
        }

        ?>

        <?php
        include("inc/header.php"); ?>

        <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet" />
        <?php
        $courses = get_books(); ?>
        <section class="px-0 md:px-6 py-6">
            <div class="md:rounded border-gray-100 dark:bg-gray-900/70 bg-white border dark:border-gray-800 mb-6">
                <header class="border-gray-100 flex items-stretch border-b dark:border-gray-800">
                    <div class="flex items-center py-3 flex-grow font-bold px-4">
                        <details class="w-full">
                            <summary>Manage book</summary>

                            <div>
                                <div class="border-b border-gray-200 dark:border-gray-700">
                                    <ul class="flex flex-wrap -mb-px nav nav-tabs">
                                        <li class="mr-2 nav-item">
                                            <a href="#add" data-toggle="tab" class="nav-link inline-block py-4 px-4 text-sm font-medium text-center text-gray-500 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300 active">Add</a>
                                        </li>
                                        <li class="mr-2 nav-item">
                                            <a href="#update" data-toggle="tab" class="nav-link inline-block py-4 px-4 text-sm font-medium text-center text-gray-500 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300">Update</a>
                                        </li>
                                        <li class="mr-2 nav-item">
                                            <a href="#delete" data-toggle="tab" class="nav-link inline-block py-4 px-4 text-sm font-medium text-center text-gray-500 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300">Delete</a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="tab-content">
                                    <div class="tab-pane active" id="add">
                                        <div class="mt-4">
                                            <h3 class="text-black text-2xl font-bold">Add book</h3>
                                            <div class="mt-4">
                                                <form method="post" enctype="multipart/form-data" action="inc/controller/book_controller.php">
                                                    <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="inline-full-name">
                                                        Book name
                                                    </label>
                                                    <input type="text" name="book_name" id="book_name" class="form-input-control mt-1" placeholder="Enter username">
                                                    <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4 mt-3" for="inline-full-name">
                                                        Description
                                                    </label>
                                                    <input type="text" name="book_desc" id="book_desc" class="form-input-control mt-1" placeholder="Enter description">
                                                    <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4 mt-3" for="inline-full-name">
                                                        Author
                                                    </label>
                                                    <input type="tel" name="book_author" id="book_author" class="form-input-control mt-1" placeholder="Enter author">
                                                    <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4 mt-3" for="inline-full-name">
                                                        Language
                                                    </label>
                                                    <input type="tel" name="book_lang" id="book_lang" class="form-input-control mt-1" placeholder="Enter lang">
                                                    <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4 mt-3" for="inline-full-name">
                                                        Book file
                                                    </label>
                                                    <span class="text-xs text-gray-500 italic">Cannot be blank</span>
                                                    <input type="file" name="book_file" id="book_file" class="form-input-control mt-1" placeholder="Enter lang">
                                                    <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4 mt-3" for="inline-full-name">
                                                        Book cover
                                                    </label>
                                                    <span class="text-xs text-gray-500 italic">Leave blank if you don't have cover</span>
                                                    <input type="file" name="book_cover" id="book_cover" class="form-input-control mt-1">
                                                    <button type="submit" name="add_book" class="px-4 py-2 mt-4 rounded-full bg-indigo-600 font-bold text-sm text-white">
                                                        Add book
                                                    </button>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="tab-pane" id="update">
                                        <div class="mt-4">
                                            <h3 class="text-black text-2xl font-bold">Update book</h3>
                                            <div class="mt-4">
                                                <form method="post" enctype="multipart/form-data" action="inc/controller/book_controller.php">

                                                    <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="inline-full-name">
                                                        Book name
                                                    </label>
                                                    <input type="text" name="book_name" id="book_name" class="form-input-control mt-1" placeholder="Enter username">
                                                    <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4 mt-3" for="inline-full-name">
                                                        Description
                                                    </label>
                                                    <input type="text" name="book_desc" id="book_desc" class="form-input-control mt-1" placeholder="Enter description">
                                                    <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4 mt-3" for="inline-full-name">
                                                        Author
                                                    </label>
                                                    <input type="tel" name="book_author" id="book_author" class="form-input-control mt-1" placeholder="Enter author">
                                                    <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4 mt-3" for="inline-full-name">
                                                        Language
                                                    </label>
                                                    <input type="tel" name="book_lang" id="book_lang" class="form-input-control mt-1" placeholder="Enter lang">
                                                    <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4 mt-3" for="inline-full-name">
                                                        Book file
                                                    </label>
                                                    <span class="text-xs text-gray-500 italic">Leave blank if you don't want to change</span>
                                                    <input type="file" name="book_file" id="book_file" class="form-input-control mt-1">
                                                    <button type="submit" name="update_account" class="px-4 py-2 mt-4 rounded-full bg-indigo-600 font-bold text-sm text-white">
                                                        Update book
                                                    </button>
                                                </form>
                                            </div>


                                        </div>
                                    </div>

                                    <div class="tab-pane" id="delete">
                                    </div>
                                </div>

                            </div>





                        </details>
                    </div>
                </header>



                <div class="flex flex-col flex-grow mt-4">
                    <div class="flex items-center justify-between px-4">
                        <p class="text-2xl font-bold">Manage books</p>
                    </div>
                    <div class="my-2">
                        <div class="py-2 align-middle px-4">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="divide-y divide-gray-200 min-w-full">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Uploader</th>
                                            <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">

                                        <?php
                                        $i = 1;
                                        $books = get_books();

                                        foreach ($books as $book) {
                                        ?>

                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="text-sm font-medium text-gray-900"> <?php echo $book['book_name'] ?> </div>
                                                    </div>
                                                </td>

                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="text-sm font-medium text-gray-900"> <?php echo $book['book_desc'] ?> </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo $book["book_author"] ?></td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo $book["username"] ?></td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex justify-end">
                                                    <a href="index.php?edit_book=<?php echo $book['id'] ?>" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                    <form action="inc/controller/book_controller.php" method="POST">
                                                        <input type="hidden" name="book_id" value="<?php echo $book['id'] ?>">
                                                        <button name="del_book_id" class="text-red-600 hover:text-red-900 ml-2">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>

                                        <?php }

                                        ?>

                                        <!-- More people... -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </section>

        <div class="flex items-center flex-col justify-center overflow-hidden fixed inset-0 z-30" style="display: none;">
            <div class="absolute inset-0 bg-gradient-to-tr opacity-90 dark:from-gray-700 dark:via-gray-900 dark:to-gray-700 from-white via-gray-100 to-white"></div>
        </div>
    </div>

</body>

</html>