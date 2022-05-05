<!DOCTYPE html>
<html lang="en">
<?php if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (
    !isset($_SESSION['user'])
) {
    $_SESSION['redirect'] = 'index.php';
    header("Location: http://" . $_SERVER['HTTP_HOST'] . '/Web/login.php');
} ?>
<?php include("inc/head.php") ?>

<body class="bg-white text-base dark:bg-gray-800 dark:text-gray-100">
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
        $authors = display_authors(); ?>
        <section class="px-0 md:px-6 py-6">
            <div class="md:rounded border-gray-100 dark:bg-gray-900/70 bg-white border dark:border-gray-800 mb-6">
                <header class="border-gray-100 flex items-stretch border-b dark:border-gray-800">
                    <div class="flex items-center py-3 flex-grow font-bold px-4">
                        <details class="w-full">
                            <summary class="cursor-pointer">Manage author</summary>

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
                                            <h3 class="text-black text-2xl font-bold">Add author</h3>
                                            <div class="mt-4">
                                                <form id="form-add-author" method="post" enctype="multipart/form-data" action="inc/controller/author_controller.php">
                                                    <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="inline-full-name">
                                                        Author name
                                                    </label>
                                                    <input type="text" name="author_name" id="author_name" class="form-input-control mt-1" placeholder="Enter author name">
                                                    <span id="author-name-error" class="text-xs text-gray-500 italic text-red-600"></span>
                                                    <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4 mt-3" for="inline-full-name">
                                                        DOB
                                                    </label>
                                                    <span id="book-desc-error" class="text-xs text-gray-500 italic text-red-600"></span>
                                                    <input type="date" name="dob" id="dob" class="form-input-control mt-1" placeholder="Enter description">
                                                    <button type="submit" name="add_author" class="px-4 py-2 mt-4 rounded-full bg-indigo-600 font-bold text-sm text-white">
                                                        Add author
                                                    </button>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="tab-pane" id="update">
                                        <div class="mt-4">
                                            <h3 class="text-black text-2xl font-bold">Update author</h3>
                                            <div class="mt-4">
                                                <form id="form-update-author" method="post" enctype="multipart/form-data" action="inc/controller/author_controller.php">
                                                    <div class="form-group">

                                                        <label class="mt-2 text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4 w-1/6 flex-shrink-0" for="exampleFormControlSelect1">
                                                            Select author
                                                        </label>
                                                        <select class="form-input-control mt-1" name="book_id">

                                                            <?php foreach ($authors as $author) {
                                                            ?>
                                                                <option value="<?php echo $author['id'] ?>"><?php echo  $author['author_name']; ?></option>
                                                            <?php } ?>

                                                        </select>
                                                    </div>

                                                    <label class="block text-gray-500 font-bold md:text-left mb-1 mt-2 md:mb-0 pr-4" for="inline-full-name">
                                                        Author name
                                                    </label>
                                                    <input type="text" name="author_name" id="author_name" class="form-input-control mt-1" placeholder="Enter author name">
                                                    <span id="author-name-error" class="text-xs text-gray-500 italic text-red-600"></span>
                                                    <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4 mt-3" for="inline-full-name">
                                                        DOB
                                                    </label>
                                                    <span id="book-desc-error" class="text-xs text-gray-500 italic text-red-600"></span>
                                                    <input type="date" name="dob" id="dob" class="form-input-control mt-1" placeholder="Enter description">
                                                    <button type="submit" name="update_author" class="px-4 py-2 mt-4 rounded-full bg-indigo-600 font-bold text-sm text-white">
                                                        Update author
                                                    </button>
                                                </form>
                                            </div>


                                        </div>
                                    </div>

                                    <div class="tab-pane" id="delete">
                                        <div class="mt-4">
                                            <h3 class="text-black text-2xl font-bold">Delete author</h3>
                                            <div class="mt-4">

                                                <form action="inc/controller/author_controller.php" method="post" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label class="mt-2 text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4 w-1/6 flex-shrink-0" for="exampleFormControlSelect1">
                                                            Select author
                                                        </label>
                                                        <select class="form-input-control mt-1" name="author_id">
                                                            <?php foreach ($authors as $author) {
                                                            ?>
                                                                <option value="<?php echo $author['id'] ?>"><?php echo  $author['author_name']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>

                                                    <div class="text-right">
                                                        <button name="del_author" class="px-4 py-2 mt-4 rounded-full bg-indigo-600 font-bold text-sm text-white w-1/4">Delete author</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </details>
                    </div>
                </header>



                <div class="flex flex-col flex-grow mt-4">
                    <div class="flex items-center justify-between px-4">
                        <p class="text-2xl font-bold">Manage authors</p>
                    </div>
                    <div class="my-2">
                        <div class="py-2 align-middle px-4">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="divide-y divide-gray-200 min-w-full">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">DOB</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">

                                        <?php
                                        $i = 1;

                                        foreach ($authors as $author) {
                                        ?>

                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="text-sm font-medium text-gray-900"> <?php echo $author['author_name'] ?> </div>
                                                    </div>
                                                </td>

                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="text-sm font-medium text-gray-900"> <?php echo $author['dob'] ?> </div>
                                                    </div>
                                                </td>
                                                
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex justify-end">
                                                    <form action="inc/controller/author_controller.php" method="POST">
                                                        <input type="hidden" name="author_id" value="<?php echo $author['id'] ?>">
                                                        <button name="del_author" class="text-red-600 hover:text-red-900 ml-2">Delete</button>
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

<script>
    function validateForm(form, bookNameError, bookAuthorError, bookLanguageError, bookFileError) {
        form.addEventListener('submit', (e) => {
            let error = false;


            if (!form.elements["book_name"].value) {
                bookNameError.textContent = "Book name is required";
                error = true;
            }


            if (!form.elements["book_author"].value) {
                bookAuthorError.textContent = "Book author is required";
                error = true;
            }


            if (!form.elements["book_lang"].value) {
                bookLanguageError.textContent = "Book language is required";
                error = true;
            }


            if (!form.elements["book_file"].value) {
                bookFileError.textContent = "Book file is required";
                error = true;
            }

            if (error) {
                e.preventDefault();
                return;
            }

            form.submit();

        })
    }

    const form = document.getElementById("form-add-book");
    const bookNameError = document.getElementById("book-name-error");
    const bookAuthorError = document.getElementById("book-author-error");
    const bookLanguageError = document.getElementById("book-lang-error");
    const bookFileError = document.getElementById("book-file-error");

    validateForm(form, bookNameError, bookAuthorError, bookLanguageError, bookFileError)

    const formUpdate = document.getElementById("form-update-book");
    const bookNameUpdateError = document.getElementById("book-name-update-error");
    const bookAuthorUpdateError = document.getElementById("book-author-update-error");
    const bookLanguageUpdateError = document.getElementById("book-lang-update-error");
    const bookFileUpdateError = document.getElementById("book-file-update-error");

    validateForm(formUpdate, bookNameUpdateError, bookAuthorUpdateError, bookLanguageUpdateError, bookFileUpdateError)
</script>

</html>