<?php

// * GET THE RANDSALT FROM DB
function getRandSalt()
{
    global $connection;
    $query = "SELECT randSalt FROM users";
    $result = mysqli_query($connection, $query) or die("Query Failed" . mysqli_error($connection));

    if ($result) {
        return mysqli_fetch_assoc($result)["randSalt"];
    }
}

function hashPassword($password)
{
    $salt = getRandSalt();
    return crypt($password, $salt);
}
