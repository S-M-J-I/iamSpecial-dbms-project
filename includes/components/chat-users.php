<?php

$chats = findWhoUserIsChattingWith($_SESSION["id"]);
$output = "";

if (mysqli_num_rows($chats) > 0) {
    $output = "";
    while ($row = mysqli_fetch_assoc($chats)) {
        $output .= "
            <li>
            <a style='text-decoration: none;' href='chat.php?chatWith={$row['id']}'>
            " . toggleActive($row["id"]) . "
                <img src='images/avatars/" . $row["avatar"] . "?1234324' alt='avatar'>
                <div class='about'>
                    <div class='name'>{$row['first_name']} {$row['last_name']}</div>
                </div>
            </li>
            </a>
            ";
    }
} else {
    $output = "No users to chat with!";
}

echo $output;
