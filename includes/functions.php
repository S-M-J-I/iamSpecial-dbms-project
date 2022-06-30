<?php
include_once "crypt.php";
include_once "db.php";


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


function getImageByID($id)
{
    global $connection;
    $query = "SELECT avatar FROM users";
    $res = mysqli_query($connection, $query) or die("Query Failed" . mysqli_error($connection));

    if ($res) {
        return mysqli_fetch_assoc($res)["avatar"];
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

function getRoleNameByID($id)
{
    global $connection;
    $query = "SELECT role FROM user_type WHERE type_id='$id'";
    $res = mysqli_query($connection, $query) or die("Query Failed" . mysqli_error($connection));

    if ($res) {
        return mysqli_fetch_assoc($res)["role"];
    }
}

// TODO: SET PROFILE PICTURE DURING SIGUP SESSION
// * SIGNUP USER
function signUp()
{
    global $connection, $mail;
    // * check if button was clicked or not
    if (isset($_POST["submit"])) {

        // * get all the form data
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $username = $_POST["username"];
        $role = $_POST["role"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $password = $_POST["password"];
        $repeatPassword = $_POST["repeat_password"];

        // * check and remove SQL injections
        $first_name = mysqli_real_escape_string($connection, $first_name);
        $last_name = mysqli_real_escape_string($connection, $last_name);
        $username = mysqli_real_escape_string($connection, $username);
        $email = mysqli_real_escape_string($connection, $email);
        $phone = mysqli_real_escape_string($connection, $phone);
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
        $sql = "INSERT INTO users(`first_name`, `last_name`, `username`, `password`, `email`, `phone`, `role`) VALUES (?,?,?,?,?,?,?)";
        $query = $connection->prepare($sql);
        $query->bind_param("ssssssi", $first_name, $last_name, $username, $password, $email, $phone, $role);
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

            $mail->Subject = "Welcome to iamspecial.com!";
            $mail->isHTML(true);
            $mail->Body = "
            <h1 style='text-align: center;'>Welcome, $first_name $last_name!</h1>
            <hr />
            <p style='text-align: justify;'>We are very pleased that you have joined iamspecial.com as a <strong>" . getRoleNameByID($role) . "</strong>! First of all, we would urge you to login and verify yourself!</p>
            <p style='text-align: justify;'>We hope that iamspecial.com will provide you with the right amount of information, help, and resources to help your special loved one.</p>
            ";
            $mail->addAddress($email);
            $mail->send();

            loginUser($username, $repeatPassword);
        }
    }
}

// * LOGIN USER
function loginUser($username, $password)
{
    global $connection;
    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);
    $password = hashPassword($password);

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $res = mysqli_query($connection, $query) or die("Query Failed" . mysqli_error($connection));

    if ($res) {
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $_SESSION['id'] = $row['id'];
                $_SESSION['email'] = $row['email'];
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


// * HELPER TO PRINT RESULTS AS DROPDOWNLISTS
function getCardsVersion($res)
{
    while ($row = mysqli_fetch_assoc($res)) {
        echo "
        <div class='col-lg-6 col-xxl-4 mb-5'>
            <div class='card bg-light border-0 h-100'>
                <a style='text-decoration: none;color: black;' href='blogs.php?category={$row['cat_id']}'>
                    <div class='card-body text-center p-4 p-lg-5 pt-0 pt-lg-0'>
                        <br>
                        <img width='300px' src='./images/blog-categories/{$row['thumbnail']}' />
                        <br>
                        <hr>
                        <br>
                        <h2 class='fs-4 fw-bold'>{$row['name']}</h2>
                        <p class='mb-0'>{$row['description']}</p>
                    </div>
                </a>
            </div>
        </div>
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
    $sql = "SELECT * FROM users WHERE id IN (SELECT receiver FROM chats WHERE sender='$id' OR receiver IN (SELECT sender FROM chats WHERE receiver='$id'))";
    $res = mysqli_query($connection, $sql) or die("Failed " . mysqli_error($connection));

    return $res;
}

function findOneUserWhoUserIsChattingWith($id)
{
    global $connection;
    $sql = "SELECT * FROM users WHERE id IN (SELECT receiver FROM chats WHERE sender='$id') LIMIT 1";
    $res = mysqli_query($connection, $sql) or die("Failed " . mysqli_error($connection));

    return mysqli_fetch_assoc($res);
}


// * GET CATEGORY NAMES
function getAllCategoriesAsList()
{
    global $connection;
    $query = "SELECT * FROM blog_categories ORDER BY name";
    $res = mysqli_query($connection, $query) or die("Failed" . mysqli_error($connection));

    if ($res) {
        getCardsVersion($res);
    }
}

function getCategoryByID($id)
{
    global $connection;
    $sql = "SELECT * FROM blog_categories WHERE cat_id='$id'";
    $res = mysqli_query($connection, $sql) or die("Failed " . mysqli_error($connection));

    if ($res) {
        return mysqli_fetch_assoc($res);
    }
}

// * GET ALL DONATIONS
function getDonations()
{
    global $connection;
    $sql = "SELECT * FROM fundraisers WHERE approved='T'";
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



// * get a blog by id
function getBlog($id)
{
    global $connection;
    $sql = "SELECT * FROM blogs WHERE id='$id'";
    $res = mysqli_query($connection, $sql) or die("Failed " . mysqli_error($connection));

    if ($res) {
        return mysqli_fetch_assoc($res);
    }
}


// * get a forum post by id
function getForumPost($id)
{
    global $connection;
    $sql = "SELECT * FROM forums WHERE id='$id'";
    $res = mysqli_query($connection, $sql) or die("Failed " . mysqli_error($connection));

    if ($res) {
        return mysqli_fetch_assoc($res);
    }
}



// * get blogs by category id
function getBlogsByCategory($id)
{
    global $connection;
    $sql = "SELECT * FROM blogs WHERE category='$id' AND draft='F'";
    $res = mysqli_query($connection, $sql) or die("Failed " . mysqli_error($connection));

    if ($res) {
        return $res;
    }
}


function getAllCommentsByPostID($id)
{
    global $connection;
    $sql = "SELECT * FROM comments WHERE commented_to='$id' ORDER BY comment_id DESC";
    $query = mysqli_query($connection, $sql) or die("Failed " . mysqli_error($connection));

    if ($query) {
        return $query;
    }
}

function getAllCommentsByForumPostID($id)
{
    global $connection;
    $sql = "SELECT * FROM forum_comments WHERE commented_to='$id' ORDER BY id DESC";
    $query = mysqli_query($connection, $sql) or die("Failed " . mysqli_error($connection));

    if ($query) {
        return $query;
    }
}

function getPostsLikeThese($str, $id)
{
    global $connection;
    $sql = "SELECT * FROM blogs WHERE tags LIKE '%$str%' AND id!='$id' LIMIT 6";
    $res = mysqli_query($connection, $sql) or die("Failed " . mysqli_error($connection));

    if ($res) {
        return $res;
    }
}


function getForumPostsLikeThese($str, $id)
{
    global $connection;
    $sql = "SELECT * FROM forums WHERE tags LIKE '%$str%' AND id!='$id' LIMIT 6";
    $res = mysqli_query($connection, $sql) or die("Failed " . mysqli_error($connection));

    if ($res) {
        return $res;
    }
}


function getAllForumCategoriesAsOptions()
{
    global $connection;
    $sql = "SELECT * FROM forum_categories";
    $query = mysqli_query($connection, $sql) or die("Failed " . mysqli_error($connection));

    if ($query) {
        while ($row = mysqli_fetch_assoc($query)) {
            echo "
            <option value='{$row['forum_id']}'>{$row['name']}</option>
            ";
        }
    }
}


function getAllForumCategoriesAsCards()
{
    global $connection;
    $sql = "SELECT * FROM forum_categories";
    $query = mysqli_query($connection, $sql) or die("Failed " . mysqli_error($connection));

    if ($query) {
        while ($row = mysqli_fetch_assoc($query)) {
            echo "
            <div class='col-lg-6 col-xxl-4 mb-5'>
                <div class='card bg-light border-0 h-100'>
                    <a style='text-decoration: none;color: black;' href='forums.php?category={$row['forum_id']}'>
                        <div class='card-body text-center p-4 p-lg-5 pt-0 pt-lg-0'>
                            <div style='background-color: #dd4f5d;' class='feature bg-gradient text-white rounded-3 mb-4 mt-n4'><i class='fa-solid fa-heart-circle-plus'></i></i></div>
                            <h2 class='fs-4 fw-bold'>{$row['name']}</h2>
                        </div>
                    </a>
                </div>
            </div>
            ";
        }
    }
}


function getAllSelectiveForumCategoriesAsCards()
{
    global $connection;
    $sql = "SELECT * FROM forum_categories LIMIT 3";
    $query = mysqli_query($connection, $sql) or die("Failed " . mysqli_error($connection));

    if ($query) {
        while ($row = mysqli_fetch_assoc($query)) {
            echo "
            <div class='col-lg-6 col-xxl-4 mb-5'>
                <div class='card bg-light border-0 h-100'>
                    <a style='text-decoration: none;color: black;' href='forums.php?category={$row['forum_id']}'>
                        <div class='card-body text-center p-4 p-lg-5 pt-0 pt-lg-0'>
                            <div style='background-color: #dd4f5d;' class='feature bg-gradient text-white rounded-3 mb-4 mt-n4'><i class='fa-solid fa-heart-circle-plus'></i></div>
                            <h2 class='fs-4 fw-bold'>{$row['name']}</h2>
                        </div>
                    </a>
                </div>
            </div>
            ";
        }
    }
}


function getForumPostsByID($id)
{
    global $connection;
    $sql = "SELECT * FROM forums WHERE category='$id'";
    $query = mysqli_query($connection, $sql) or die("Failed " . mysqli_error($connection));

    if ($query) {
        return $query;
    }
}

function getPopularForumTopics()
{
    global $connection;
    $sql = "SELECT * FROM forums ORDER BY upvotes DESC, comments DESC LIMIT 2";
    $query = mysqli_query($connection, $sql) or die("Failed " . mysqli_error($connection));

    if ($query) {
        return $query;
    }
}



function getForumTags($row)
{
    $tags = explode(",", $row["tags"]);
    $build = "";
    foreach ($tags as $key => $value) {
        $build .= "<a class='text-black mr-2' href='forums.php?search='$value'>#$value</a>";
    }
    return $build;
}



function bookAppointment()
{
    global $connection, $mail;
    $booker = $_SESSION["id"];
    $booked_to = $_GET["with"];
    $booker_type = "User";
    $date = $_POST["date"];
    $time = $_POST["time"];
    $agenda = $_POST["agenda"];

    $sql = "INSERT INTO bookings(`booker`, `booked_to`, `booker_type`, `date`, `time`, `agenda`) VALUES(?,?,?,?,?,?)";
    $query = $connection->prepare($sql);
    $query->bind_param("iissss", $booker, $booked_to, $booker_type, $date, $time, $agenda);
    $res = $query->execute() or die("Failed " . mysqli_error($connection));

    if ($res) {

        $user1 = getUserByID($booker);
        $user2 = getUserByID($booked_to);

        // ? send mail to booker
        $mail->Subject = "Your appointment has been booked";
        $mail->Body = "
        <p>Dear {$user1['first_name']},</p>
        <p>Your appointment with <strong>Dr. {$user2['first_name']} {$user2['last_name']}</strong> has been confirmed! Please review the following details:</p>
        <table style='width: 577px; border:0.1px solid black;'>
        <tbody>
        <tr style='border:0.1px solid black;'>
        <td style='width: 135px; text-align: center;border:0.1px solid black;'><strong>Name</strong></td>
        <td style='width: 175px; text-align: center; border:0.1px solid black;'><strong>&nbsp;Agenda&nbsp;</strong></td>
        <td style='width: 182.569px; text-align: center; border:0.1px solid black;'><strong>Date</strong></td>
        <td style='width: 143.431px; text-align: center; border:0.1px solid black;'><strong>Time</strong></td>
        <td style='width: 143.431px; text-align: center; border:0.1px solid black;'><strong>Location</strong></td>
        </tr>
        <tr>
        <td style='width: 200px;border:0.1px solid black;'>{$user1['first_name']} {$user1['last_name']}</td>
        <td style='width: 200px;border:0.1px solid black;'>$agenda</td>
        <td style='width: 200px;border:0.1px solid black;'> " . date('F j, Y', strtotime($date)) . " </td>
        <td style='width: 200px;border:0.1px solid black;'> " . date('g:i:a', strtotime($time)) . " </td>
        <td style='width: 200px;border:0.1px solid black;'> {$user2['area']}, {$user2['city']}, {$user2['state']} </td>
        </tr>
        </tbody>
        </table>
        ";
        $mail->addAddress($user1["email"]);
        $mail->send();


        // ? send mail to booked_to
        $mail->Subject = "Your appointment has been booked";
        $mail->Body = "
        <p>Dear Dr.{$user2['first_name']},</p>
        <p>Your appointment with <strong>{$user1['first_name']} {$user1['last_name']}</strong> has been confirmed! Please review the following details:</p>
        <table style='width: 577px; border:0.1px solid black;'>
        <tbody>
        <tr style='border:0.1px solid black;'>
        <td style='width: 135px; text-align: center;border:0.1px solid black;'><strong>Name</strong></td>
        <td style='width: 175px; text-align: center; border:0.1px solid black;'><strong>&nbsp;Agenda&nbsp;</strong></td>
        <td style='width: 182.569px; text-align: center; border:0.1px solid black;'><strong>Date</strong></td>
        <td style='width: 143.431px; text-align: center; border:0.1px solid black;'><strong>Time</strong></td>
        <td style='width: 143.431px; text-align: center; border:0.1px solid black;'><strong>Location</strong></td>
        </tr>
        <tr>
        <td style='width: 200px;border:0.1px solid black;'>{$user2['first_name']} {$user2['last_name']}</td>
        <td style='width: 200px;border:0.1px solid black;'>$agenda</td>
        <td style='width: 200px;border:0.1px solid black;'> " . date('F j, Y', strtotime($date)) . " </td>
        <td style='width: 200px;border:0.1px solid black;'> " . date('g:i:a', strtotime($time)) . " </td>
        <td style='width: 200px;border:0.1px solid black;'> {$user2['area']}, {$user2['city']}, {$user2['state']} </td>
        </tr>
        </tbody>
        </table>
        ";
        $mail->addAddress($user2["email"]);
        $mail->send();

        echo "<br><h4 style='color: green; text-align: center;'>Requested!</h4><br>";
    }
}
