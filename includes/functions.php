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
            echo "<h4 style='color: red;'>Passwords do not match</h4>";
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

                    if (isset($_SESSION['valid'])) {
                        unset($_SESSION['valid']);
                    }

                    header("Location: ./admin");
                }
            } else {
                $_SESSION['valid'] = false;
                header("Location: login.php");
            }
        }
    }
}
