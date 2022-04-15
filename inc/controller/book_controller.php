<?php

if (isset($_POST['add_book'])) {
    if (isset($_POST['book_name'])) {
        $booknameVar = $_POST['book_name'];
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
        if (in_array($_FILES['book_file']['type'], $allowed)) {
            //Move File
            if (move_uploaded_file($_FILES['book_file']['tmp_name'], "files/{$_FILES['book_file']['name']}")) {
                $bookfileVar = "{$_FILES['book_file']['name']}";
            }
        } else {
            echo "Wrong File Type";
        }
    }

    if (isset($_POST['uploadername'])) {
        $uploadernameVar = $_POST['uploadername'];
    }

    //Insert Values
    $sql = "INSERT INTO books (book_name, book_desc, book_author, book_file, uploader_id) 
    VALUES ('$booknameVar', '$bookdescVar', '$bookauthorVar', '$bookfileVar', '$uploadernameVar')";

    //To check whether data is inserted properly or not
    if ($conn->query($sql) === TRUE) {
        echo '<script type="text/javascript">';
        echo 'alert("New record created successfully. Click OK to go to Book Display Section.");';
        echo 'window.location.href = "displaydata.php";';
        echo '</script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
