<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/Web/inc/function.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/Web/inc/connect.php');


if (isset($_POST['add_author'])) {

    session_start();
    if (!isset($_SESSION['user'])) return;

    if (isset($_POST['author_name'])) {
        $authorNameVar = mysqli_real_escape_string($con, $_POST['author_name']);
    }
    if (isset($_POST['dob'])) {
        $authorDobVar = $_POST['dob'];
    }

    //Insert Values
    $sql = "INSERT INTO authors (author_name, dob) 
    VALUES ('$authorNameVar', '$authorDobVar')";

    //To check whether data is inserted properly or not
    if ($con->query($sql) === TRUE) {
        $_SESSION["success_message"] = "Add author successfully!";
        header("Location: http://" . $_SERVER['HTTP_HOST'] . '/Web/manage_authors.php');
    } else {
        $_SESSION["error_message"] = "Add author failed!";
        header("Location: http://" . $_SERVER['HTTP_HOST'] . '/Web/manage_authors.php');
    }

    $con->close();
}

if (isset($_POST['update_author'])) {

    session_start();
    if (!isset($_SESSION['user'])) return;

    $author_id = $_POST["author_id"];
    $author = get_author($author_id);
    if ($author == null) return;

    $authorNameVar = $author["author_name"];
    $authorDobVar = $author["dob"];

    if (isset($_POST['author_name'])) {
        $authorNameVar = mysqli_real_escape_string($con, $_POST['author_name']);
    }
    if (isset($_POST['dob'])) {
        $authorDobVar = $_POST['dob'];
    }

    //Update
    $sql = "UPDATE authors SET author_name='$authorNameVar', dob='$authorDobVar' WHERE id='$author_id'";

    //To check whether data is inserted properly or not
    if ($con->query($sql) === TRUE) {
        $_SESSION["success_message"] = "Update author successfully!";
        header("Location: http://" . $_SERVER['HTTP_HOST'] . '/Web/manage_authors.php');
    } else {
        $_SESSION["error_message"] = "Update author failed!";
        header("Location: http://" . $_SERVER['HTTP_HOST'] . '/Web/manage_authors.php');
    }

    $con->close();
}

if (isset($_POST['del_author'])) {
    session_start();
    $author_id = $_POST['author_id'];

    $sql = "DELETE FROM authors WHERE id='$author_id'";
    //To check whether data is inserted properly or not
    if ($con->query($sql) === TRUE) {
        $_SESSION["success_message"] = "Delete author successfully!";
        header("Location: http://" . $_SERVER['HTTP_HOST'] . '/Web/manage_authors.php');
    } else {
        $_SESSION["error_message"] = "Delete author failed!";
        header("Location: http://" . $_SERVER['HTTP_HOST'] . '/Web/manage_authors.php');
    }
}
