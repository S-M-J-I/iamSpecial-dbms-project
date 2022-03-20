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
        $password = $_POST["password"];

        $username = mysqli_real_escape_string($connection, $username);
        $password = mysqli_real_escape_string($connection, $password);

        $password = hashPassword($password);

        $sql = "UPDATE users SET username=?, password=? WHERE id=?";
        $query = $connection->prepare($sql);
        $query->bind_param("ssi", $username, $password, $_SESSION["id"]);

        $res = $query->execute() or die("Failed" . mysqli_error($connection));
        if ($res) {
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
    $query = "SELECT * FROM users";
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
}

function edit_category()
{
}

function getAllCategories()
{
}

function delete_category()
{
}
