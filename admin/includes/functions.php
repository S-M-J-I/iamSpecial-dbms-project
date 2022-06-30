<?php
include "../includes/crypt.php";


// * GET THE ROLE USING THE ROLE_ID
function getRoleByID($id)
{
    global $connection;
    $query = "SELECT role FROM user_type WHERE type_id=$id";
    $res = mysqli_query($connection, $query) or die("Failed" . mysqli_error($connection));

    if ($res) {
        return mysqli_fetch_assoc($res)["role"];
    }
}



// * THIS GET THE DETAILS OF A USER BY THEIR ID
function getUserDetailsByID($id)
{
    global $connection;
    $query = "SELECT * FROM users WHERE id=$id";
    $res = mysqli_query($connection, $query) or die("Failed " . mysqli_error($connection));

    if ($res) {
        return mysqli_fetch_assoc($res);
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

// * ADD TO VERIFICATION QUEUE
function addToVerificationQueue()
{
    global $connection;
    // TODO: save the NID pictures to DB for admin verification
    if (isset($_POST["verify"])) {
        $user_id = $_SESSION["id"];

        $temp = explode(".", $_FILES["id1"]["name"]);
        $id1 = $_SESSION["id"] . '-1.' . end($temp);
        $temp_id1 = $_FILES['id1']['tmp_name'];

        $temp = explode(".", $_FILES["id2"]["name"]);
        $id2 = $_SESSION["id"] . '-2.' . end($temp);
        $temp_id2 = $_FILES['id2']['tmp_name'];

        $nid_num = mysqli_real_escape_string($connection, $_POST["NID"]);

        // ? Save the pics as -1 and -2 in verifications folder
        move_uploaded_file($temp_id1, "../images/verifications/$id1");
        move_uploaded_file($temp_id2, "../images/verifications/$id2");

        $sql = "INSERT INTO verification VALUES ($user_id, '$id1', '$id2', $nid_num)";
        $res = mysqli_query($connection, $sql) or die("Failed" . mysqli_error($connection));

        if ($res) {
            header("Location: profile-verify.php");
        }
    }
}

// * DELETE A USER
function deleteUser()
{
    global $connection;
    if (isset($_POST["delete"])) {
        $id = $_SESSION["id"];
        $sql = "DELETE FROM users WHERE id=?";
        $query = $connection->prepare($sql);
        $query->bind_param("i", $id);
        $res = $query->execute() or die("Failed" . mysqli_error($connection));

        if ($res) {
            header("Location: ../login.php");
        }
    }
}



// * GET ALL PROFILE THAT NEEDS TO BE VERIFIED BASED ON NID PICS AND NID NUM
function getAllPendingVerifications($type)
{
    global $connection;
    if ($_SESSION["role"] == 1) {
        $query =
            "SELECT \n"

            . "	verification.user_id as id,\n"

            . "    CONCAT(users.first_name, ' ', users.last_name) full_name,\n"

            . "    users.avatar avatar,\n"

            . "    verification.id1 id1,\n"

            . "    verification.id2 id2,\n"

            . "    verification.NID NID,\n"

            . "    users.role role\n"

            . "FROM\n"

            . "	users\n"

            . "    JOIN\n"

            . "    verification\n"

            . "    ON users.id = verification.user_id\n"

            . "WHERE\n"

            . "	role = $type;";

        $res = mysqli_query($connection, $query) or die("Failed" . mysqli_error($connection));

        if ($res) {

            if (mysqli_num_rows($res) == 0) {
                echo "<h3>No " . getRoleByID($type) . "s to verify!</h3><br>";
            } else {
                while ($row = mysqli_fetch_assoc($res)) {
                    echo "
                    <tr>
                        <td>{$row['id']}</td>
                        <td>{$row['full_name']}</td>
                        <td><img width=100 class='img-responsive' src='../images/avatars/{$row['avatar']}' alt='user image' /></td>
                        <td><img width=100 class='img-responsive' src='../images/verifications/{$row['id1']}' alt='user image' /></td>
                        <td><img width=100 class='img-responsive' src='../images/verifications/{$row['id2']}' alt='user image' /></td>
                        <td>{$row['NID']}</td>
                        <td>" . getRoleByID($row["role"]) . "</td>
                        <td><a href='verification.php?id={$row['id']}&status=accept'>Accept</a></td>
                        <td><a href='verification.php?id={$row['id']}&status=reject'>Reject</a></td>
                    </tr>
                    ";
                }
            }
        }
    } else {
        header("Location: 404.php");
    }
}

// * ACCEPT VERIFICATION REQUEST
function acceptVerificationRequest($id)
{
    global $connection;
    if ($_SESSION["role"] != 1) {
        header("Location: 404.php");
        return;
    }

    $sql = "UPDATE users SET verified='T' WHERE id=?";
    $query = $connection->prepare($sql);
    $query->bind_param("i", $id);
    $res = $query->execute() or die("Failed" . mysqli_error($connection));

    $sql = "SELECT * FROM verification WHERE user_id=$id";
    $res = mysqli_query($connection, $sql) or die("Failed" . mysqli_error($connection));
    $user = mysqli_fetch_assoc($res);

    $sql = "DELETE FROM verification WHERE user_id=?";
    $query = $connection->prepare($sql);
    $query->bind_param("i", $id);
    $res = $query->execute() or die("Failed" . mysqli_error($connection));
    unlink("../images/verifications/{$user['id1']}");
    unlink("../images/verifications/{$user['id2']}");

    $sql = "SELECT role FROM users WHERE id=$id";
    $res = mysqli_query($connection, $sql) or die("Failed" . mysqli_error($connection));

    if ($res) {
        header("Location: verification.php?type=" . getRoleByID(mysqli_fetch_assoc($res)["role"]));
    }
}


// * DECLINE VERIFICATION REQUEST
function declineVerificationRequest($id)
{
    global $connection;
    if ($_SESSION["role"] != 1) {
        header("Location: 404.php");
        return;
    }

    $sql = "UPDATE users SET verified='F' WHERE id=?";
    $query = $connection->prepare($sql);
    $query->bind_param("i", $id);
    $res = $query->execute() or die("Failed" . mysqli_error($connection));

    $sql = "SELECT * FROM verification WHERE user_id=$id";
    $res = mysqli_query($connection, $sql) or die("Failed" . mysqli_error($connection));
    $user = mysqli_fetch_assoc($res);

    $sql = "DELETE FROM verification WHERE user_id=?";
    $query = $connection->prepare($sql);
    $query->bind_param("i", $id);
    $res = $query->execute() or die("Failed" . mysqli_error($connection));
    unlink("../images/verifications/{$user['id1']}");
    unlink("../images/verifications/{$user['id2']}");

    $sql = "SELECT role FROM users WHERE id=$id";
    $res = mysqli_query($connection, $sql) or die("Failed" . mysqli_error($connection));

    if ($res) {
        header("Location: verification.php?type=" . getRoleByID(mysqli_fetch_assoc($res)["role"]));
    }
}




// * CHECK IF USER VERIFICATION IS IN QUEUE OR NOT
function seeIfInVerificationQueue()
{
    global $connection;
    $user_id = $_SESSION["id"];
    $query = "SELECT * FROM verification WHERE user_id=$user_id";
    $res = mysqli_query($connection, $query) or die("Failed" . mysqli_error($connection));

    if ($res) {
        if (mysqli_num_rows($res) > 0) {
            return true;
        } else {
            return false;
        }
    }
}





// * THIS FUNCTION EDITS A USER
function editUser()
{
    global $connection;
    if (isset($_POST["edit"])) {
        $username = $_POST["username"];
        $username = mysqli_real_escape_string($connection, $username);
        $email = $_POST["email"];
        $email = mysqli_real_escape_string($connection, $email);
        $phone = mysqli_real_escape_string($connection, $_POST["phone"]);
        $speciality = mysqli_real_escape_string($connection, $_POST["speciality"]);

        $sql = "UPDATE users SET username='$username', email='$email', phone='$phone', speciality='$speciality'";

        // TODO: FIX AVATAR ISSUE HERE

        if ($_POST["password"] != "") {
            $password = $_POST["password"];
            $password = mysqli_real_escape_string($connection, $password);
            $password = hashPassword($password);
            $sql .= ", password='$password'";
        }

        if (isset($_FILES["avatar"]["name"]) && $_FILES["avatar"]["name"] != "") {
            $temp = explode(".", $_FILES["avatar"]["name"]);
            $avatar = $_SESSION["id"] . '.' . end($temp);
            $temp_avatar = $_FILES['avatar']['tmp_name'];
            $sql .= ", avatar='$avatar'";
        }

        if ($_POST["area"] != "") {
            $area = $_POST["area"];
            $area = mysqli_real_escape_string($connection, $area);
            $sql .= ", area='$area'";
        }

        if ($_POST["city"] != "") {
            $city = $_POST["city"];
            $city = mysqli_real_escape_string($connection, $city);
            $sql .= ", city='$city'";
        }

        if ($_POST["state"] != "") {
            $state = $_POST["state"];
            $state = mysqli_real_escape_string($connection, $state);
            $sql .= ", state='$state'";
        }

        $id = $_SESSION["id"];
        $sql .= " WHERE id=$id";

        $query = $sql;
        if (isset($_FILES["avatar"]["name"]) && $_FILES["avatar"]["name"] != "") {
            move_uploaded_file($temp_avatar, "../images/avatars/$avatar");
        }
        $res = mysqli_query($connection, $query) or die("Failed" . mysqli_error($connection));

        if ($res) {
            $_SESSION["username"] = $username;
            header("Location: profile.php");
        }
    }
}

// * helpler to toggle Admin
function toggleAdmin($role, $id)
{
    if ($role != 1) {
        return "<a onClick=\"javascript: return confirm('Are you sure you want to make this user an admin?');\" href='view_admin.php?target=make&id={$id}'>Make Admin</a>";
    } else {
        return "<p style='color: green;'><strong>ADMIN</strong></p>";
    }
}


// * VIEW ALL USERS
function getAllUsersInATable()
{
    global $connection;
    $query = "SELECT * FROM users ORDER BY role, username";
    $res = mysqli_query($connection, $query) or die("Failed" . mysqli_error($connection));

    if ($res) {
        while ($row = mysqli_fetch_assoc($res)) {
            echo "
            <tr>
                <td>{$row['id']}</td>
                <td>{$row['username']}</td>
                <td>{$row['first_name']}</td>
                <td>{$row['last_name']}</td>
                <td>{$row['email']}</td>
                <td><img width=100 class='img-responsive' src='../images/avatars/{$row['avatar']}' alt='user image' /></td>
                <td>" . getRoleByID($row["role"]) . "</td>
                <td>" . toggleAdmin($row["role"], $row["id"]) . "</td>
            </tr>
            ";
        }
    }
}


// * ADD AN ADMIN
function makeAdmin($id)
{
    if (!isset($_SESSION["role"]) && $_SESSION["role"] != 1) {
        return;
    }
    global $connection;
    $sql = "UPDATE users SET role=? WHERE id=?";
    $query = $connection->prepare($sql);
    $role = 1;
    $query->bind_param("ii", $role, $id);
    $res = $query->execute() or die("Failed" . mysqli_error($connection));

    if ($res) {
        header("Location: view_admin.php");
    }
}


// * CREATE A CATEGORY
function insert_category()
{
    global $connection;
    if (isset($_POST["add"])) {
        if ($_SESSION["role"] == 1) {
            $name = $_POST["name"];
            $name = mysqli_real_escape_string($connection, $name);

            $description = $_POST["description"];
            $description = mysqli_real_escape_string($connection, $description);

            $temp = explode(".", $_FILES["thumbnail"]["name"]);
            $thumbnail = $name . '.' . end($temp);
            $temp_thumbnail = $_FILES['thumbnail']['tmp_name'];

            move_uploaded_file($temp_thumbnail, "../images/blog-categories/$thumbnail");
            $sql = "INSERT INTO blog_categories(`name`, `description`, `thumbnail`) VALUES(?,?,?)";
            $query = $connection->prepare($sql);
            $query->bind_param("sss", $name, $description, $thumbnail);
            $res = $query->execute() or die("Failed" . mysqli_error($connection));

            if ($res) {
                header("Location: categories.php");
            }
        } else {
            header("Location: 401.php");
        }
    }
}


function insert_forum_category()
{
    global $connection;
    if (isset($_POST["add"])) {
        if ($_SESSION["role"] == 1) {
            $name = $_POST["name"];
            $name = mysqli_real_escape_string($connection, $name);

            $sql = "INSERT INTO forum_categories(`name`) VALUES(?)";
            $query = $connection->prepare($sql);
            $query->bind_param("s", $name);
            $res = $query->execute() or die("Failed" . mysqli_error($connection));

            if ($res) {
                header("Location: forum-categories.php");
            }
        } else {
            header("Location: 401.php");
        }
    }
}

function edit_category()
{
    global $connection;
    if (isset($_POST["edit"])) {
        $id = $_GET["id"];
        $name = $_POST["name"];
        $description = $_POST["description"];
        $temp = explode(".", $_FILES["thumbnail"]["name"]);
        $thumbnail = $name . '.' . end($temp);
        $temp_thumbnail = $_FILES['thumbnail']['tmp_name'];

        move_uploaded_file($temp_thumbnail, "../images/blog-categories/$thumbnail");
        $query = "UPDATE blog_categories SET name=?, description=?, thumbnail=? WHERE cat_id=?";
        $res = $connection->prepare($query);
        $res->bind_param("sssi", $name, $description, $thumbnail, $id);
        $res->execute() or die("Failed " . mysqli_error($connection));


        if ($res) {
            header("Location: categories.php");
        }
    }
}

function getAllCategories()
{
    global $connection;
    $query = "SELECT * FROM blog_categories";
    $res = mysqli_query($connection, $query) or die("Failed" . mysqli_error($connection));

    if ($res) {
        while ($row = mysqli_fetch_assoc($res)) {
            echo "
            <tr>
                <td>{$row['cat_id']}</td>
                <td><a href='../blogs.php?category={$row['cat_id']}' target='_blank'>{$row['name']}</a></td>
                <td><a href=categories.php?action=edit&id={$row['cat_id']}>Edit</a></td>
                <td><a style='color: red;' href=categories.php?id={$row['cat_id']}>Delete</a></td>
            </tr>
            ";
        }
    }
}

function getAllForumCategories()
{
    global $connection;
    $query = "SELECT * FROM forum_categories";
    $res = mysqli_query($connection, $query) or die("Failed" . mysqli_error($connection));

    if ($res) {
        while ($row = mysqli_fetch_assoc($res)) {
            echo "
            <tr>
                <td>{$row['forum_id']}</td>
                <td><a href='../forums.php?category={$row['forum_id']}' target='_blank'>{$row['name']}</a></td>
                <td><a style='color: red;' href=forum-categories.php?id={$row['forum_id']}>Delete</a></td>
            </tr>
            ";
        }
    }
}


function delete_forum_category()
{
    global $connection;
    if (isset($_GET["id"])) {
        $sql = "DELETE FROM forum_categories WHERE forum_id=?";
        $query = $connection->prepare($sql);
        $id = $_GET["id"];
        $query->bind_param("i", $id);
        $res = $query->execute() or die("Failed" . mysqli_error($connection));

        $sql = "DELETE FROM blogs WHERE category=?";
        $query = $connection->prepare($sql);
        $query->bind_param("i", $id);
        $res = $query->execute() or die("Failed" . mysqli_error($connection));

        if ($res) {
            header("Location: forum-categories.php");
        }
    }
}





function getAllCategoriesAsOptions()
{
    global $connection;
    $query = "SELECT * FROM blog_categories";
    $res = mysqli_query($connection, $query) or die("Failed" . mysqli_error($connection));

    if ($res) {
        while ($row = mysqli_fetch_assoc($res)) {
            echo "
            <option value='{$row['cat_id']}'>{$row['name']}</option>
            ";
        }
    }
}

function delete_category()
{
    global $connection;
    if (isset($_GET["id"])) {
        $sql = "DELETE FROM blog_categories WHERE cat_id=?";
        $query = $connection->prepare($sql);
        $id = $_GET["id"];
        $query->bind_param("i", $id);
        $res = $query->execute() or die("Failed" . mysqli_error($connection));

        $sql = "DELETE FROM blogs WHERE category=?";
        $query = $connection->prepare($sql);
        $query->bind_param("i", $id);
        $res = $query->execute() or die("Failed" . mysqli_error($connection));

        if ($res) {
            header("Location: categories.php");
        }
    }
}



// * ADD AN INSTITUTION
function getAllInstitutions()
{
    global $connection;
    $query = "SELECT * FROM institutions";
    $res = mysqli_query($connection, $query) or die("Failed" . mysqli_error($connection));

    if ($res) {
        while ($row = mysqli_fetch_assoc($res)) {
            echo "
            <tr>
                <td>{$row['ins_id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['about']}</td>
                <td>{$row['phone']}</td>
                <td>{$row['street']}, {$row['area']}, {$row['city']}, {$row['state']}</td>
                <td>{$row['type']}</td>
                <td><img width=200 class='img-responsive' src='../images/institutions/{$row['picture']}' alt='user image' /></td>
                <td><a style='color: red;' href=institutions.php?target=delete&id={$row['ins_id']}>Delete</a></td>
            </tr>
            ";
        }
    }
}

// * ADD AN INSTITUTE
function addInstitute()
{
    global $connection;
    if (isset($_POST["add"])) {
        $sql = "INSERT INTO institutions(`name`, `about`, `street`, `area`, `city`, `state`, `phone`, `type`, `picture`) VALUES(?,?,?,?,?,?,?,?,?)";

        $name = $_POST["name"];
        $about = $_POST["about"];
        $phone = $_POST["phone"];
        $street = $_POST["street"];
        $area = $_POST["area"];
        $city = $_POST["city"];
        $state = $_POST["state"];
        $type = $_POST["type"];

        $temp = explode(".", $_FILES["picture"]["name"]);
        $picture = $name . '.' . end($temp);
        $temp_picture = $_FILES['picture']['tmp_name'];

        move_uploaded_file($temp_picture, "../images/institutions/$picture");
        $query = $connection->prepare($sql);
        $query->bind_param("sssssssss", $name, $about, $street, $area, $city, $state, $phone, $type, $picture);
        $res = $query->execute() or die("Failed" . mysqli_error($connection));

        if ($res) {
            header("Location: institutions.php");
        }
    }
}


// * DELETE AN INSTITUTE
function deleteInstitute()
{
    global $connection;
    if ($_SESSION["role"] != 1) {
        header("Location: 404.php");
        return;
    }

    $id = $_GET["id"];
    $sql = "DELETE FROM institutions WHERE ins_id=?";
    $query = $connection->prepare($sql);
    $query->bind_param("i", $id);
    $res = $query->execute() or die("Failed" . mysqli_error($connection));

    if ($res) {
        header("Location: institutions.php");
    }
}


// ** PRINT CARDS ACCORDING TO THEIR COLOR
function printCards($content, $link, $color)
{
    echo "
    <div class='col-xl-3 col-md-6'>
        <div class='card bg-$color text-white mb-4'>
            <div class='card-body'><strong>{$content}</strong></div>
            <div class='card-footer d-flex align-items-center justify-content-between'>
                <a class='small text-white stretched-link' href='{$link}'>View Details</a>
                <div class='small text-white'><i class='fas fa-angle-right'></i></div>
            </div>
        </div>
    </div>
    ";
}


// * BOOK AN APPOINTMENT
function bookAppointment()
{
    global $connection, $mail;
    $booker = $_POST["booker"];
    $booked_to = $_POST["booked_to"];
    $booker_type = $_POST["booker_type"];
    $date = $_POST["date"];
    $time = $_POST["time"];
    $agenda = $_POST["agenda"];

    $sql = "INSERT INTO bookings(`booker`, `booked_to`, `booker_type`, `date`, `time`, `agenda`) VALUES(?,?,?,?,?,?)";
    $query = $connection->prepare($sql);
    $query->bind_param("iissss", $booker, $booked_to, $booker_type, $date, $time, $agenda);
    $res = $query->execute() or die("Failed " . mysqli_error($connection));

    if ($res) {

        $user1 = getUserDetailsByID($booker);
        $user2 = getUserDetailsByID($booked_to);

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

        header("Location: counselor-bookings.php");
    }
}

// * SEE ALL APPOINTMENTS FROM COUNSELOR VIEW
function getAllAppointmentsFromCounselorView()
{
    global $connection;
    $booked_to = $_SESSION["id"];
    $sql = "SELECT \n"

        . "	booking_id,\n"

        . "	booker,\n"

        . "    (SELECT CONCAT(first_name, \" \", last_name) FROM users WHERE id = booker) as full_name,\n"

        . "    (SELECT phone FROM users WHERE id = booker) phone,\n"

        . "    booker_type,\n"

        . "    date,\n"

        . "    time,\n"

        . "    agenda,\n"

        . "    is_finished\n"

        . "FROM\n"

        . "	bookings b\n"

        . "    INNER JOIN\n"

        . "    users u\n"

        . "    WHERE b.booked_to = '$booked_to'\n"

        . "    GROUP BY date, time ORDER BY date DESC";

    $res = mysqli_query($connection, $sql);

    if ($res) {
        while ($row = mysqli_fetch_assoc($res)) {
            echo "
            <tr>
                <td>{$row['full_name']}</td>
                <td>{$row['phone']}</td>
                <td>{$row['booker_type']}</td>
                <td>" . date('F j, Y', strtotime($row["date"])) . "</td>
                <td>" . date('g:i:a', strtotime($row["time"])) . "</td>
                <td style='text-align: justify; text-justify: inter-word;'>{$row['agenda']}</td>
                <td>" . toggleBookingStatus($row["booking_id"], $row["is_finished"]) . "</td>
            </tr>
            ";
        }
    }
}


// * SEE ALL APPOINTMENTS FROM COUNSELOR VIEW
function getAllRequestedAppointmentsFromCounselorView()
{
    global $connection;
    $booked_to = $_SESSION["id"];
    $sql = "SELECT \n"

        . "	booking_id,\n"

        . "	booker,\n"

        . "    (SELECT CONCAT(first_name, \" \", last_name) FROM users WHERE id = booker) as full_name,\n"

        . "    (SELECT phone FROM users WHERE id = booker) phone,\n"

        . "    booker_type,\n"

        . "    date,\n"

        . "    time,\n"

        . "    agenda,\n"

        . "    is_finished\n"

        . "FROM\n"

        . "	bookings b\n"

        . "    INNER JOIN\n"

        . "    users u\n"

        . "    WHERE b.booked_to = '$booked_to' AND is_requested='T'\n"

        . "    GROUP BY date, time ORDER BY date DESC";

    $res = mysqli_query($connection, $sql);

    if ($res) {
        while ($row = mysqli_fetch_assoc($res)) {
            echo "
            <tr>
                <td>{$row['full_name']}</td>
                <td>{$row['phone']}</td>
                <td>{$row['booker_type']}</td>
                <td>" . date('F j, Y', strtotime($row["date"])) . "</td>
                <td>" . date('g:i:a', strtotime($row["time"])) . "</td>
                <td style='text-align: justify; text-justify: inter-word;'>{$row['agenda']}</td>
                <td><a href='requested-bookings.php?edit={$row['booking_id']}'> Edit </a></td>
                <td><a href='requested-bookings.php?approved={$row['booking_id']}'> Approve </a></td>
            </tr>
            ";
        }
    }
}


function getBookingByID($id)
{
    global $connection;
    $sql = "SELECT * FROM bookings WHERE booking_id='$id'";
    $res = mysqli_query($connection, $sql) or die("Failed " . mysqli_error($connection));

    if ($res) {
        return mysqli_fetch_assoc($res);
    }
}

function approveBookingByID($id)
{
    global $connection;
    $sql = "UPDATE bookings SET is_requested='F' WHERE booking_id=?";
    $query = $connection->prepare($sql);
    $query->bind_param("i", $id);
    $res = $query->execute() or die("Failed " . mysqli_error($connection));

    if ($res) {
        header("Location: counselor-bookings.php");
    }
}

function editBookingByID($id)
{
    global $connection;
    $time = $_POST["time"];
    $sql = "UPDATE bookings SET time=? WHERE booking_id=?";
    $query = $connection->prepare($sql);
    $query->bind_param("si", $time, $id);
    $res = $query->execute() or die("Failed " . mysqli_error($connection));

    if ($res) {
        header("Location: requested-bookings.php");
    }
}


// * SEE ALL APPOINTMENTS FROM USER VIEW
function getAllAppointmentsFromUserView()
{
    global $connection;
    $booker = $_SESSION["id"];
    $sql = "SELECT \n"

        . "	booked_to,\n"

        . "    (SELECT CONCAT(first_name, \" \", last_name) FROM users WHERE id = booked_to) as full_name,\n"

        . "    (SELECT phone FROM users WHERE id = booker) phone,\n"

        . "    (SELECT area FROM users WHERE id=booked_to) area,\n"

        . "    (SELECT city FROM users WHERE id=booked_to) city,\n"

        . "    (SELECT state FROM users WHERE id=booked_to) state,\n"

        . "    (SELECT speciality FROM users WHERE id=booked_to) speciality,\n"

        . "    date,\n"

        . "    time,\n"

        . "    agenda,\n"

        . "    is_finished\n"

        . "FROM\n"

        . "	bookings b\n"

        . "    INNER JOIN\n"

        . "    users u\n"

        . "    WHERE b.booker = '$booker'\n"

        . "    GROUP BY date, time ORDER BY date DESC";

    $res = mysqli_query($connection, $sql);

    if ($res) {
        while ($row = mysqli_fetch_assoc($res)) {
            echo "
            <tr>
                <td>{$row['full_name']}</td>
                <td>{$row['phone']}</td>
                <td>{$row['area']}, {$row['city']}, {$row['state']}</td>
                <td>{$row['speciality']}</td>
                <td>" . date('F j, Y', strtotime($row["date"])) . "</td>
                <td>" . date('g:i:a', strtotime($row["time"])) . "</td>
                <td style='text-align: justify; text-justify: inter-word;'>{$row['agenda']}</td>
                <td>" . toggleDone($row["is_finished"]) . "</td>
            </tr>
            ";
        }
    }
}


// * toggle bookings done view 
function toggleDone($status)
{
    if ($status == "T") {
        return "<strong style='color: green;'>Done</strong>";
    } else {
        return "<strong style='color: red;'>Not done</strong>";
    }
}





// * MARK BOOKING AS DONE
function completeBooking($id)
{
    global $connection;
    $sql = "UPDATE bookings SET is_finished='T' WHERE booking_id=?";
    $query = $connection->prepare($sql);
    $query->bind_param("i", $id);

    $res = $query->execute() or die("Failed " . mysqli_error($connection));

    if ($res) {
        header("Location: counselor-bookings.php");
    }
}

// * TOGGLE BOOKINGS DONE
function toggleBookingStatus($id, $status)
{
    if ($_SESSION["role"] == 2) {
        if ($status == "F") {
            return "<a href='counselor-bookings.php?id=$id&status=T'><strong>Mark as done</strong></a>";
        } else {
            return "<strong style='color: green;'>Done</strong>";
        }
    }
}



// * ADD FUNDRAISER
function addFundraiser()
{
    global $connection, $mail;
    if (isset($_POST["add"])) {
        $title = $_POST["title"];
        $description = $_POST["description"];
        $total_target = $_POST["total_target"];
        $duration = $_POST["duration"];
        $approved = "F";

        $sql = "INSERT INTO fundraisers(title, description, total_target, duration, requested_by, approved) VALUES(?,?,?,?,?,?)";
        $query = $connection->prepare($sql);

        if ($_SESSION["role"] == 1) {
            $approved = "T";
        }

        $query->bind_param("ssssis", $title, $description, $total_target, $duration, $_SESSION["id"], $approved);
        $query->execute() or die("Failed");

        if ($_SESSION["role"] == 1) {

            $mail->Subject = "You added a Fundraiser";
            $mail->Body = "Dear {$_SESSION['first_name']},<br> You added a fundraiser named <strong>'$title'</strong>. If this was not you, please resolve this issue ASAP or contact our other admins!
            <h3>Summary</h3>
            Title: $title<br>
            Description: $description<br>
            Total Target: $total_target<br>
            Duration: $duration<br>
            ";

            $mail->addAddress($_SESSION["email"]);
            $mail->send();

            header("Location: ../donate.php");
        } else {
            echo "<br><h5 style='color: green;'>Requested submitted. Check mail for updates!</h5>";

            $mail->Subject = "Requested for a Fundraiser";
            $mail->Body = "Your request for the fundraiser <strong>'$title'</strong>, has been submitted to our team for approval. Please keep your eye out for updates!<br>
            <h5>Summary</h5>
            Title: $title<br>
            Description: $description<br>
            Total Target: $total_target<br>
            Duration: $duration<br>
            ";

            $mail->addAddress($_SESSION["email"]);
            $mail->send();
        }
    }
}


// * VIEW ALL FUNDRAISERS
function getAllFundraisersInATable()
{
    global $connection;
    $query = "SELECT * FROM fundraisers WHERE approved='F'";
    $res = mysqli_query($connection, $query) or die("Failed" . mysqli_error($connection));

    if ($res) {
        while ($row = mysqli_fetch_assoc($res)) {
            echo "
            <tr>
                <td>{$row['title']}</td>
                <td>{$row['description']}</td>
                <td>{$row['total_target']}</td>
                <td>{$row['duration']}</td>
                <td> " . seeRequestedBy($row) . " </td>
                <td><a href='approve-fundraiser.php?action=true&id={$row['id']}'>Approve</a></td>
            </tr>
            ";
        }
    }
}

function seeRequestedBy($row)
{
    if ($row['requested_by'] == "") {
        return "None";
    }

    $user = getUserDetailsByID($row["requested_by"]);
    return "<a href='profile.php?id={$row['requested_by']}'>" . $user["first_name"] . " " . $user["last_name"] . "</a>";
}


// * add a blog post
function addBlogPost()
{
    global $connection;
    if (isset($_POST["add"])) {
        $title = $_POST["title"];
        $content = $_POST["content"];
        $category = $_POST["category"];
        date_default_timezone_set('Bangladesh/Dhaka');
        $date = date('Y-m-d', time());
        $author = $_SESSION["id"];
        $tags = $_POST["tags"];

        $temp = explode(".", $_FILES["image"]["name"]);
        $image = $author . '-' . uniqid() . '.' . end($temp);
        $temp_image = $_FILES['image']['tmp_name'];

        move_uploaded_file($temp_image, "../images/blogs/$image");
        $sql = "INSERT INTO blogs(`title`, `content`, `category`, `image`, `date`, `author`, `tags`) VALUES(?,?,?,?,?,?,?)";
        $query = $connection->prepare($sql);
        $query->bind_param("ssissis", $title, $content, $category, $image, $date, $author, $tags);
        $res = $query->execute() or die("Failed " . mysqli_error($connection));

        if ($res) {
            header("Location: posts.php");
        } else {
            echo "<h6 style='color: red;'>Error in posting the blog!</h6>";
        }
    }
}


// * edit a blog post
function editBlogPost($id)
{
    global $connection;
    if (isset($_POST["edit"])) {
        $title = $_POST["title"];
        $category = $_POST["category"];
        $content = $_POST["content"];
        $author = $_SESSION["id"];
        $tags = $_POST["tags"];

        $temp = explode(".", $_FILES["image"]["name"]);
        $image = $author . '-' . $title . '.' . end($temp);
        $temp_image = $_FILES['image']['tmp_name'];

        move_uploaded_file($temp_image, "../images/blogs/$image");
        $sql = "UPDATE blogs SET  
        title=?, 
        category=?, 
        content=?, 
        image=?,
        tags=?
        WHERE id=?
    ";
        $query = $connection->prepare($sql);
        $query->bind_param("sssssi", $title, $category, $content, $image, $tags, $id);
        $res = $query->execute() or die("Failed " . mysqli_error($connection));

        if ($res) {
            header("Location: posts.php");
        } else {
            echo "<h6 style='color: red;'>Error in posting the blog!</h6>";
        }
    }
}


// * edit a blog post
function deleteBlogPost($id)
{
    global $connection;
    $blog_image = getPostByID($id)["image"];
    $sql = "DELETE FROM blogs WHERE id=?";
    $query = $connection->prepare($sql);
    $query->bind_param("i", $id);
    $query->execute() or die("Failed " . mysqli_error($connection));
    unlink("../images/blogs/$blog_image");
    header("Location: posts.php");
}


function getPostByID($id)
{
    global $connection;
    $sql = "SELECT * FROM blogs WHERE id='$id'";
    $res = mysqli_query($connection, $sql) or die("Failed " . mysqli_error($connection));

    if ($res) {
        return mysqli_fetch_assoc($res);
    }
}



function getAllBlogPosts($id)
{
    global $connection;
    $sql = "SELECT * FROM blogs WHERE author='$id' ORDER BY id DESC";
    $res = mysqli_query($connection, $sql) or die("Failed " . mysqli_error($connection));

    if ($res) {
        while ($row = mysqli_fetch_assoc($res)) {
            echo "
            <tr>
                <td><a href='../post.php?blog={$row['id']}'>{$row['title']}</a></td>
                <td>" . getCategoryByID($row['category'])["name"] . "</td>
                <td><img width='150' class='img-responsive' src='../images/blogs/{$row['image']}?123456321'/></td>
                <td>{$row['date']}</td>
                <td>{$row['tags']}</td>
                <td>" . toggleDraft($row) . "</td>
                <td><a class='btn btn-primary' href=posts.php?id={$row['id']}&action=edit>Edit</a></td>
                <td><a class='btn btn-danger' href=posts.php?id={$row['id']}&action=delete>Delete</a></td>
            </tr>
            ";
        }
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

function toggleDraft($row)
{
    if ($row['draft'] == 'T') {
        return "<a class='btn btn-success' href=posts.php?id={$row['id']}&action=approve>Approve</a>";
    } else {
        return "<strong style='color: green;'>Approved</strong>";
    }
}


function approvePost($id)
{
    global $connection;
    $sql = "UPDATE blogs SET draft='F' WHERE id=?";
    $query = $connection->prepare($sql);
    $query->bind_param("i", $id);
    $res = $query->execute() or die("Failed " . mysqli_error($connection));

    if ($res) {
        header("Location: posts.php");
    }
}
