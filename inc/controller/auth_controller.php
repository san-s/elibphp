<?php

session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/Web/inc/connect.php'); 


if (isset($_POST['login'])) {
    if (
        !isset($_POST['email']) ||
        !isset($_POST['password'])
    ) {
        return;
    }

    $pass = $_POST['password'];
    $email = $_POST['email'];

    $check = $con->query("select * from users where email='$email' limit 1");
    $user = $check->fetch_assoc();
    $hashed_password = $user['password'];

    if ($hashed_password == null) {
        $_SESSION["failed_message"] = "Incorrect email or password";
        $con = null;
        return;
    }

    if (password_verify($pass, $hashed_password)) {
        $_SESSION["success_message"] = "Login success";
        $con = null;
        $_SESSION['user'] = $user['id'];
        header("Location: http://" . $_SERVER['HTTP_HOST'] . '/Web\/' . $_SESSION['redirect'] ?? 'index.php');
        return;
    } else {
        $_SESSION["failed_message"] = "Incorrect email or password";
        $con = null;
        return;
    }

    $con = null;
}


if (isset($_POST['registration'])) {
    if (
        !isset($_POST['username']) ||
        !isset($_POST['email']) ||
        !isset($_POST['password']) 
    ) {
        return;
    }

    $name = $_POST['username'];
    $pass = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $check = $con->query("select 1 as result from users where email='$email' limit 1");
    $count = $check->fetch_assoc()['result'];

    if ($count > 0) {
        $_SESSION["failed_message"] = "User already existed";
        $con = null;
        return;
    }

    $hashed_password = password_hash($pass, PASSWORD_BCRYPT);
    $query = "insert into users (username, email, password, phone, role_id) values ('$name', '$email', '$hashed_password', '$phone', 1)";

    if ($con->query($query)) {
        $_SESSION["success_message"] = "Registration successfully!";
        header("Location: http://" . $_SERVER['HTTP_HOST'] . '/Web');
    } else {
        $_SESSION["failed_message"] = "Registration failed";
        echo "<script>window.open('index.php?sub_cat', '_self')</script>";
    }
    $con = null;
}


if (isset($_POST['logout'])) {
    session_start();
    $_SESSION = array();
    $_SESSION["success_message"] = "Logout successfully!";
    header("Location: http://" . $_SERVER['HTTP_HOST'] . '/Web/index.php');
}