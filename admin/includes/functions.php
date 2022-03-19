<?php
include "../includes/crypt.php";


// * GET THE ROLE USING THE ROLE_ID
function getRoleByID($id)
{
    global $connection;
    $query = "SELECT role FROM user_type";
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
