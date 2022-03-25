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
