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

        $sql = "UPDATE users SET username='$username', email='$email'";

        // TODO: FIX AVATAR ISSUE HERE

        if ($_POST["password"] != "") {
            $password = $_POST["password"];
            $password = mysqli_real_escape_string($connection, $password);
            $password = hashPassword($password);
            $sql .= ", password='$password'";
        }

        if (isset($_FILES["avatar"]["name"])) {
            $temp = explode(".", $_FILES["avatar"]["name"]);
            $avatar = $_SESSION["id"] . '.' . end($temp);
            $temp_avatar = $_FILES['avatar']['tmp_name'];
            $sql .= ", avatar='$avatar'";
        }

        $id = $_SESSION["id"];
        $sql .= " WHERE id=$id";

        $query = $sql;
        if (isset($_FILES["avatar"]["name"])) {
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
        return "<a href='view_admin.php?target=make&id={$id}'>Make Admin</a>";
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

            $sql = "INSERT INTO blog_categories(`name`) VALUES(?)";
            $query = $connection->prepare($sql);
            $query->bind_param("s", $name);
            $res = $query->execute() or die("Failed" . mysqli_error($connection));

            if ($res) {
                header("Location: categories.php");
            }
        } else {
            header("Location: 401.php");
        }
    }
}

function edit_category()
{
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
                <td>{$row['name']}</td>
                <td><a style='color: red;' href=categories.php?id={$row['cat_id']}>Delete</a></td>
            </tr>
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
