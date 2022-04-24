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

        // Remember me
        if ($_POST["remember_me"]) {
            $selector = base64_encode(random_bytes(9));
            $authenticator = random_bytes(33);

            setcookie(
                'remember',
                $selector . ':' . base64_encode($authenticator),
                time() + 864000,
                '/',
                'localhost.com',
                true, // TLS-only
                true  // http-only
            );

            $hash = hash('sha256', $authenticator);
            $expire = date('Y-m-d\TH:i:s', time() + 864000);

            $con->query("INSERT INTO auth_tokens (selector, validator, userid, expires) VALUES ('$selector', '$hash', $user[id], '$expire')");
        }


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

if (isset($_POST['login_ajax'])) {
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

        // Remember me
        if (isset($_POST["remember_me"]) && $_POST["remember_me"]) {
            $selector = base64_encode(random_bytes(9));
            $authenticator = random_bytes(33);

            setcookie(
                'remember',
                $selector . ':' . base64_encode($authenticator),
                time() + 864000,
                '/',
                'localhost.com',
                true, // TLS-only
                true  // http-only
            );

            $hash = hash('sha256', $authenticator);
            $expire = date('Y-m-d\TH:i:s', time() + 864000);

            $con->query("INSERT INTO auth_tokens (selector, validator, userid, expires) VALUES ('$selector', '$hash', $user[id], '$expire')");
        }


        $con = null;
        $_SESSION['user'] = $user['id'];
        header('Content-Type: application/json');
        echo json_encode(array("success" => true, "message" => "Login success"));
        exit;
    } else {
        $con = null;
        header('Content-Type: application/json');
        echo json_encode(array("success" => false, "message" => "Incorrect email or password"));
        exit;
    }

    $con = null;
}

if (isset($_POST['logout_ajax'])) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION = array();
    header('Content-Type: application/json');
    echo json_encode(array("success" => true, "message" => "Logout successfully!"));
    exit;
}
