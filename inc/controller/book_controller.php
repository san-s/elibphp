<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/Web/inc/function.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/Web/inc/connect.php');


if (isset($_POST['add_book'])) {

    session_start();
    if (!isset($_SESSION['user'])) return;

    $user_id = $_SESSION['user'];

    if (isset($_POST['book_name'])) {
        $booknameVar = mysqli_real_escape_string($con, $_POST['book_name']);
    }
    if (isset($_POST['book_desc'])) {
        $bookdescVar = $_POST['book_desc'];
    }
    if (isset($_POST['book_author'])) {
        $bookauthorVar = $_POST['book_author'];
    }
    if (isset($_POST['book_lang'])) {
        $booklangVar = $_POST['book_lang'];
    }

    //File Upload
    if (isset($_FILES['book_file'])) {
        $allowed = array('application/pdf', 'application/doc', 'application/docx');
        $type = $_FILES['book_file']['type'];
        $file_ext = explode('.', $_FILES['book_file']['name']);
        $file_ext = strtolower(end($file_ext));
        if (in_array($type, $allowed)) {
            //Move File
            $file_name = unique_file_name($file_ext);
            if (move_uploaded_file($_FILES['book_file']['tmp_name'], '/opt/lampp/htdocs/Web/uploads/books/' . $file_name)) {
                $bookfileVar = $file_name;
            }
        } else {
            echo "Wrong File Type";
        }
    }

    //File Upload cover
    if (isset($_FILES['book_cover'])) {
        $allowed = array('image/png', 'image/jpg', 'image/jpeg');
        $type = $_FILES['book_cover']['type'];
        $file_ext = explode('.', $_FILES['book_cover']['name']);
        $file_ext = strtolower(end($file_ext));
        if (in_array($type, $allowed)) {
            //Move File
            $file_name = unique_file_name($file_ext);
            if (move_uploaded_file($_FILES['book_cover']['tmp_name'], '/opt/lampp/htdocs/Web/uploads/books/covers/' . $file_name)) {
                $bookCoverVar = $file_name;
            }
        } else {
            echo "Wrong File Type";
        }
    }

    //Insert Values
    $sql = "INSERT INTO books (book_name, book_desc, book_author, book_file, uploader_id, book_cover) 
    VALUES ('$booknameVar', '$bookdescVar', '$bookauthorVar', '$bookfileVar', '$user_id', '$bookCoverVar')";

    //To check whether data is inserted properly or not
    if ($con->query($sql) === TRUE) {
        echo '<script type="text/javascript">';
        echo 'alert("New record created successfully. Click OK to go to book display section.");';
        echo 'window.location.href = "books.php";';
        echo '</script>';
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }

    $con->close();
}


if (isset($_GET["q"])) {
    search_ajax($_GET["q"]);
}

if (isset($_GET["download_book"])) {
    $name = $_GET['download_book'];
    $file_path = $_SERVER['DOCUMENT_ROOT'] . '/Web/uploads/books/' . $name;

    header('Content-Description: File Transfer');
    header('Content-Type: application/force-download');
    header("Content-Disposition: attachment; filename=\"" . basename($name) . "\";");
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file_path));
    ob_clean();
    flush();
    readfile($file_path); //showing the path to the server where the file is to be download
    exit;
}
