<?php
include_once "crypt.php";



function printPosts()
{
    echo "
            <h2>
                <a href=''>Sample Title</a>
            </h2>
            <p class='lead'>
                by <a href=''>Author</a>
            </p>
            <p><span class='glyphicon glyphicon-time'></span> Posted on " . "DOB" . "</p>
            <hr>
            <img class='img-responsive' src='https://dummyimage.com/50x50/ced4da/6c757d.jpg' alt='' style='object-fit: cover;'>
            <hr>
            <p>Content Here .................</p>
            <hr>
        ";
}

// * GET LAST ENTERED ID FROM DB
function getLastEnteredID()
{
    global $connection;
    $query = "SELECT * FROM users ORDER BY id DESC LIMIT 1";
    $res = mysqli_query($connection, $query) or die("Query Failed" . mysqli_error($connection));

    if ($res) {
        return mysqli_fetch_assoc($res)["id"];
    }
}


// * FIND IF USER PROFILE IS VERIFIED OR NOT
function isVerified($id)
{
    global $connection;
    $query = "SELECT verified FROM users WHERE id=$id";
    $res = mysqli_query($connection, $query) or die("Failed" . mysqli_error($connection));

    if ($res) {
        $row = mysqli_fetch_assoc($res);
        if ($row["verified"] == 'T') {
            return true;
        } else {
            return false;
        }
    }
}


function getRoleByID($id)
{
    global $connection;
    $query = "SELECT role FROM users";
    $res = mysqli_query($connection, $query) or die("Query Failed" . mysqli_error($connection));

    if ($res) {
        return mysqli_fetch_assoc($res)["role"];
    }
}

// TODO: SET PROFILE PICTURE DURING SIGUP SESSION
// * SIGNUP USER
function signUp()
{
    global $connection;
    // * check if button was clicked or not
    if (isset($_POST["submit"])) {

        // * get all the form data
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $username = $_POST["username"];
        $role = $_POST["role"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $repeatPassword = $_POST["repeat_password"];

        // * check and remove SQL injections
        $first_name = mysqli_real_escape_string($connection, $first_name);
        $last_name = mysqli_real_escape_string($connection, $last_name);
        $username = mysqli_real_escape_string($connection, $username);
        $email = mysqli_real_escape_string($connection, $email);
        $password = mysqli_real_escape_string($connection, $password);
        $repeatPassword = mysqli_real_escape_string($connection, $repeatPassword);

        // * if passwords donot match, error
        if ($password != $repeatPassword) {
            echo "<p style='color: red;'>Invalid username or password</p>";
            return;
        }

        // * hash the password
        $password = hashPassword($password);

        // * insert the values using prepare statement
        $sql = "INSERT INTO users(`first_name`, `last_name`, `username`, `password`, `email`, `role`) VALUES (?,?,?,?,?,?)";
        $query = $connection->prepare($sql);
        $query->bind_param("sssssi", $first_name, $last_name, $username, $password, $email, $role);
        $res = $query->execute() or die("Failed" . mysqli_error($connection));

        // * if query is successfully executed
        if ($res) {
            // * redirect to the log in page

            $id = getLastEnteredID();
            $temp = explode(".", $_FILES["avatar"]["name"]);
            $avatar = $id . '.' . end($temp);
            $temp_avatar = $_FILES['avatar']['tmp_name'];

            move_uploaded_file($temp_avatar, "./images/avatars/$avatar");
            $query = $connection->prepare("UPDATE users SET avatar=? WHERE id=?");
            $query->bind_param("si", $avatar, $id);
            $res = $query->execute() or die("Query Failed" . mysqli_error($connection));

            header("Location: login.php");
        }
    }
}

// * LOGIN USER
function loginUser()
{
    global $connection;
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $username = mysqli_real_escape_string($connection, $username);
        $password = mysqli_real_escape_string($connection, $password);
        $password = hashPassword($password);

        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $res = mysqli_query($connection, $query) or die("Query Failed" . mysqli_error($connection));

        if ($res) {
            if (mysqli_num_rows($res) > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['first_name'] = $row['first_name'];
                    $_SESSION['last_name'] = $row['last_name'];
                    $_SESSION['role'] = $row['role'];
                    $_SESSION['avatar'] = $row['avatar'];

                    if (isset($_SESSION['valid'])) {
                        unset($_SESSION['valid']);
                    }

                    header("Location: ./admin");
                }
            } else {
                echo "<p style='color: red;'>Invalid username or password</p>";
            }
        }
    }
}


// * HELPER TO PRINT RESULTS AS DROPDOWNLISTS
function getDropDownVersion($res, $type)
{
    while ($row = mysqli_fetch_assoc($res)) {
        echo "
        <a class='dropdown-item' href='{$type}.php'>{$row['name']}</a>
        ";
    }
}

function getUserByID($id)
{
    global $connection;
    $query = "SELECT * FROM users WHERE id='$id'";
    $res = mysqli_query($connection, $query) or die("Failed " . mysqli_error($connection));
    if ($res) {
        return mysqli_fetch_assoc($res);
    }
}

function getAvatarByID($id)
{
    global $connection;
    $query = "SELECT avatar FROM users WHERE id='$id'";
    $res = mysqli_query($connection, $query) or die("Failed " . mysqli_error($connection));
    if ($res) {
        return mysqli_fetch_assoc($res)["avatar"];
    }
}

function findWhoUserIsChattingWith($id)
{
    global $connection;
    $sql = "SELECT * FROM users WHERE id IN (SELECT receiver FROM chats WHERE sender='$id')";
    $res = mysqli_query($connection, $sql) or die("Failed " . mysqli_error($connection));

    return $res;
}

function findOneUserWhoUserIsChattingWith($id)
{
    global $connection;
    $sql = "SELECT * FROM users WHERE id IN (SELECT receiver FROM chats WHERE sender='$id') LIMIT 1";
    $res = mysqli_query($connection, $sql) or die("Failed " . mysqli_error($connection));

    return mysqli_fetch_assoc($res)["id"];
}


// * GET CATEGORY NAMES
function getAllCategoriesAsList($type)
{
    global $connection;
    $query = "SELECT name FROM blog_categories";
    $res = mysqli_query($connection, $query) or die("Failed" . mysqli_error($connection));

    if ($res) {
        getDropDownVersion($res, $type);
    }
}

// * GET ALL DONATIONS
function getDonations()
{
    global $connection;
    $sql = "SELECT * FROM fundraisers";
    $res = mysqli_query($connection, $sql) or die("Failed");

    return $res;
}

// * GET ALL AMOUNT RAISED IN A DURATION
function getSumOfDonations($id)
{
    global $connection;
    $sql = "SELECT SUM(amount) total FROM orders WHERE fundraiser_id='$id'";
    $res = mysqli_query($connection, $sql) or die("Failed");

    if ($res) {
        return mysqli_fetch_assoc($res)["total"];
    }
}
