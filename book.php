<!DOCTYPE html>
<html lang="en">

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
        include("inc/header.php");
        $book_id = $_GET["book_id"];
        $book = get_book($book_id);
        ?>

        <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet" />

        <div id="wrapper">

            <div class="p-16 mx-auto">
                <div class="flex justify-center">
                    <div class="w-64 mt-1">
                        <img class="object-cover w-full" src="uploads/books/covers/<?php echo $book["book_cover"] ?>" alt="">
                    </div>
                    <div class="ml-4 flex flex-col justify-between">
                        <div>
                            <p class="text-base text-indigo-600 text-2xl"><?php echo $book["book_name"] ?></p>
                            <h4 class="text-sm text-gray-500"><?php echo $book["book_desc"] ?></h4>
                            <div class="">
                                <h5 class="text-sm text-gray-400 mt-2">Author: <?php echo $book["book_author"] ?></h5>
                                <h5 class="text-sm text-gray-400">Uploader: <?php echo $book["username"] ?></h5>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <a href="inc/controller/book_controller.php?download_book=<?php echo $book["book_file"] ?>" id="btn-download" class="px-4 py-2 bg-indigo-600 text-sm font-black text-white mt-4 cursor-pointer">
                                Download
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center flex-col justify-center overflow-hidden fixed inset-0 z-30" style="display: none;">
                <div class="absolute inset-0 bg-gradient-to-tr opacity-90 dark:from-gray-700 dark:via-gray-900 dark:to-gray-700 from-white via-gray-100 to-white"></div>
            </div>
        </div>
    </div>
</body>

</html>