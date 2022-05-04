<?php
$record_ppage = 3;

function display_books()
{
    include("inc/connect.php");

    $rows = [];
    //fetch from database
    $sql = "SELECT b.*, u.username, u.email from books b inner join users u on b.uploader_id=u.id";
    $result = $con->query($sql);
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    return $rows;
}

function get_books()
{
    global $record_ppage;
    include("inc/connect.php");

    if (isset($_GET["search_kw"])) {
        return search_advance($_GET["search_kw"]);
    }

    $query = "SELECT count(*) FROM books";

    $result = $con->query($query);
    $row = $result->fetch_row();
    $num = $row[0];

    $paging = calculate_paging($num);
    //fetch from database
    $sql = "SELECT b.*, u.username, u.email from books b inner join users u on b.uploader_id=u.id LIMIT $paging[p_start], $record_ppage";
    $result = $con->query($sql);
    return array("result" => $result, "paging" => $paging);
}

function get_book($id)
{
    include("inc/connect.php");

    $query = "SELECT b.*, u.username, u.email FROM books b inner join users u on b.uploader_id=u.id where b.id='$id'";

    $result = $con->query($query);
    $row = $result->fetch_assoc();

    return $row;
}


function unique_file_name($ext)
{
    $file_name = date("Y-m-d") . '-' . uniqid() . '.' . $ext;
    return $file_name;
}

function search_advance($keyword)
{
    include('connect.php');
    global $record_ppage;
    $keyword = trim($keyword);

    $pro_kw = "";
    $keys = explode('"', $keyword);
    if (count($keys) > 1) {
        for ($i = 0; $i < count($keys) - 1; $i++) {
            $key = trim($keys[$i]);
            if (!empty($key)) {
                if ($i == count($keys) - 2) {
                    if (empty(end($keys))) {
                        $pro_kw = $pro_kw . "$key";
                    } else {
                        $pro_kw = $pro_kw . "$key%' or book_name like '%" . trim(end($keys));
                    }
                } else {
                    $pro_kw = $pro_kw . "$key%' or book_name like '%";
                }
            }
        }
    } else {
        $pro_kw = $pro_kw = $pro_kw . "$keyword";
    }

    $pro_kw = str_replace('"', "", $pro_kw);

    $query = "SELECT count(*) FROM books where book_name like '%$pro_kw%'";

    $result = $con->query($query);
    $row = $result->fetch_row();
    $num = $row[0];
    $paging = calculate_paging($num);

    $query = "select b.*, u.username, u.email from books b inner join users u on b.uploader_id=u.id where book_name like '%$pro_kw%' limit $paging[p_start], $record_ppage";

    $result = $con->query($query) or die("Query failed: " . $conn->error);

    return array("result" => $result, "paging" => $paging);
}

function search_ajax($keyword)
{

    extract(search_advance($keyword));
    $books_html = [];

    if ($result->num_rows > 0) {
        while ($book = $result->fetch_assoc()) {
            $books_html[] = <<<_RES
            <div class="w-56">
            <a href="topic.php?topic_id=$book[id]">
                <img class="h-64 object-cover w-full" src="uploads/books/covers/$book[book_cover]" alt="">
                <p class="text-base text-indigo-600 mt-1">$book[book_name]</p>
                <h4 class="text-sm text-gray-500">$book[book_desc]</h4>
                <div class="flex justify-between">
                    <h5 class="text-sm text-gray-400 mt-2">Author: $book[book_author]</h5>
                    <h5 class="text-sm text-gray-400 mt-2">$book[username]</h5>
                </div>
            </a>
        </div>
_RES;
        }
    } else {
        echo "Not found";
    }

    $paging_html = [];
    if ($paging['p_prev'] > 0) { //previous
        $paging_html[] = <<<_RES
        <a href='index.php?search_kw=$keyword&page=$paging[p_prev]'>Next</a>&nbsp&nbsp&nbsp
_RES;
    }
    if ($paging['p_next'] > 0) { //next
        $paging_html[] = <<<_RES
        <a href='index.php?search_kw=$keyword&page=$paging[p_next]'>Next</a>
_RES;
    }

    header('Content-Type: application/json');
    echo json_encode(array('books_html' => $books_html, "paging_html" => $paging_html));
    exit;
}


function auth()
{
    include_once($_SERVER['DOCUMENT_ROOT'] . '/Web/inc/connect.php');
    if (empty($_SESSION['user']) && !empty($_COOKIE['remember'])) {
        list($selector, $authenticator) = explode(':', $_COOKIE['remember']);

        $row = $con->query(
            "SELECT * FROM auth_tokens WHERE selector = '$selector'",
        )->fetch_assos();

        if (hash_equals($row['validator'], hash('sha256', base64_decode($authenticator)))) {
            $_SESSION['userid'] = $row['userid'];
            // Then regenerate login token as above
        }
    }
}

function compute_paging($search_kw)
{

    include_once($_SERVER['DOCUMENT_ROOT'] . '/Web/inc/connect.php');
    global $record_ppage;
    $query = "SELECT count(*) FROM books WHERE book_name LIKE '%$search_kw%'";

    $result = $con->query($query);
    $row = $result->fetch_row();
    $p_total = ceil($row[0] / $record_ppage);
    $page = (isset($_REQUEST["page"])) ? $_REQUEST["page"] : 1;
    $start = ($page - 1) * $record_ppage;
    $p_next = ($page > 1) ? $page - 1 : 0;
    $p_pre = ($page < $p_total) ? $page + 1 : 0;

    return array(
        "p_total" => $p_total, "p_no" => $page,
        "p_start" => $start, "p_prev" => $p_next,
        "p_next" => $p_pre, "total" => $row[0]
    );
} //compute_paging()

function calculate_paging($num)
{
    global $record_ppage;
    $p_total = ceil($num / $record_ppage);
    $page = (isset($_REQUEST["page"])) ? $_REQUEST["page"] : 1;
    $start = ($page - 1) * $record_ppage;
    $p_next = ($page > 1) ? $page - 1 : 0;
    $p_pre = ($page < $p_total) ? $page + 1 : 0;

    return array(
        "p_total" => $p_total, "p_no" => $page,
        "p_start" => $start, "p_prev" => $p_next,
        "p_next" => $p_pre, "total" => $num
    );
}

function search($keyword)
{
    include_once($_SERVER['DOCUMENT_ROOT'] . '/Web/inc/connect.php');
    global $record_ppage;
    $search_kw = str_replace(" ", "%' OR title LIKE '%", trim($keyword));
    $paging = compute_paging($search_kw);
    $query = "SELECT * FROM books WHERE book_name LIKE '%$search_kw%'" . " LIMIT $paging[p_start], $record_ppage";

    $result = $con->query($query)
        or die("DB accessed failed: " . $con->error);
    while ($book = $result->fetch_assoc()) {
        echo <<<_RES
        <div class="w-56">
        <a href="topic.php?topic_id=$book[id]">
            <img class="h-64 object-cover w-full" src="uploads/books/covers/$book[book_cover]" alt="">
            <p class="text-base text-indigo-600 mt-1">$book[book_name]</p>
            <h4 class="text-sm text-gray-500">$book[book_desc]</h4>
            <div class="flex justify-between">
                <h5 class="text-sm text-gray-400 mt-2">Author: $book[book_author]</h5>
                <h5 class="text-sm text-gray-400 mt-2">$book[username]</h5>
            </div>
        </a>
    </div>
_RES;
    }
    if ($result->num_rows == 0)
        echo "Not found";
    return $paging;
} //search()

function page_nav_links($paging, $search_kw)
{
    echo "Page $paging[p_no]/$paging[p_total]:&nbsp&nbsp&nbsp";

    if (is_null($search_kw)) {
        if ($paging['p_prev'] > 0) { //previous
            echo "<a href='index.php?page=" . $paging['p_prev'] . "'>Previous</a>&nbsp&nbsp&nbsp";
        }
        if ($paging['p_next'] > 0) { //next
            echo "<a href='index.php?page=" . $paging['p_next'] . "'>Next</a>";
        }
    } else {

        if ($paging['p_prev'] > 0) { //previous
            echo "<a href='index.php?search_kw=$search_kw" .
                "&page=" . $paging['p_prev'] . "'>Previous</a>&nbsp&nbsp&nbsp";
        }
        if ($paging['p_next'] > 0) { //next
            echo "<a href='index.php?search_kw=$search_kw " .
                "&page=" . $paging['p_next'] . "'>Next</a>";
        }
    }
} //page_nav_links()

function isAuth()
{

    include('connect.php');
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['user'])) return true;

    if (
        !isset($_SESSION['user']) && !isset($_COOKIE["remember"])
    ) {
        return false;
    }

    list($selector, $authenticator) = explode(':', $_COOKIE['remember']);


    $row = $con->query(
        "SELECT * FROM auth_tokens WHERE selector = '$selector'"
    )->fetch_assoc();

    if (hash_equals($row['validator'], hash('sha256', base64_decode($authenticator)))) {
        $userid = $row['userid'];
        $_SESSION['user'] = $row['userid'];

        $selector = base64_encode(random_bytes(9));
        $authenticator = random_bytes(33);

        setcookie(
            'remember',
            $selector . ':' . base64_encode($authenticator),
            time() + 864000,
            '/',
        );

        $hash = hash('sha256', $authenticator);

        $con->query("UPDATE auth_tokens SET selector='$selector', validator='$hash' where userid='$userid'");


        // Then regenerate login token as above
        return true;
    }
}
