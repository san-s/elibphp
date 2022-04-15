<?php

session_start();
include("../connect.php");


if (isset($_POST['login'])) {
    if (
        !isset($_POST['email']) ||
        !isset($_POST['password'])
    ) {
        return;
    }

    $pass = $_POST['password'];
    $email = $_POST['email'];

    $check = $con->prepare("select * from users where email=:email limit 1");
    $check->bindParam("email", $email);
    $check->execute();
    $user = $check->fetch();
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
        header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning\/' . $_SESSION['redirect'] ?? 'index.php');
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

    $check = $con->prepare("select 1 as result from users where email=:email limit 1");
    $check->bindParam("email", $email);
    $check->execute();
    $count = $check->fetch()['result'];

    if ($count > 0) {
        $_SESSION["failed_message"] = "User already existed";
        $con = null;
        return;
    }

    $query = $con->prepare("insert into users (username, email, password, phone, role_id) values (:username, :email, :password, :phone, 1)");
    $query->bindParam("username", $name);
    $query->bindParam("email", $email);
    $query->bindParam("phone", $phone);
    $hashed_password = password_hash($pass, PASSWORD_BCRYPT);
    $query->bindParam("password", $hashed_password);

    if ($query->execute()) {
        $_SESSION["success_message"] = "Registration successfully!";
        header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/login.php');
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
    header("Location: http://" . $_SERVER['HTTP_HOST'] . '/ELearning/index.php');
}
