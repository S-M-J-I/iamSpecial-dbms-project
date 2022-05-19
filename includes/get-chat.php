<?php include "db.php";
include "functions.php";

session_start();


if (isset($_SESSION["id"])) {
    $output = "";
    $senderID = mysqli_real_escape_string($connection, $_POST["sender"]);
    $receiverID = mysqli_real_escape_string($connection, $_POST["receiver"]);

    $sql = "SELECT * FROM chats WHERE (sender='$senderID' AND receiver='$receiverID') OR (sender='$receiverID' AND receiver='$senderID') ORDER BY chat_id DESC";
    $res = mysqli_query($connection, $sql) or die("Failed " . mysqli_error($connection));

    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $output = "";
            if ($row["sender"] == $senderID) {
                $output .= "
                <li class='clearfix'>
                    <div class='message-data text-right'>
                        <img src='images/avatars/" . getAvatarByID($senderID) . "?1234324' alt='avatar'>
                    </div>
                    <div class='message other-message float-right'>
                     <strong>{$row['message']}</strong> <br>
                     <p style='font-size: 12px;'>" . date_format(date_create($row["date_time"]), "F j, Y - h:i a") . "</p>
                     </div>
                </li>
                ";
            } else {
                $output .= "
                <li class='clearfix'>
                    <div class='message-data'>
                        <img src='images/avatars/" . getAvatarByID($receiverID) . "?1234324' alt='avatar'>
                    </div>
                    <div class='message my-message'><strong>{$row['message']}</strong> <br>
                    <p style='font-size: 12px;'>" . date_format(date_create($row["date_time"]), "F j, Y - h:i a") . "</p> </div>
                </li>
                ";
            }
            echo $output;
        }
    }
} else {
    header("Location: 404.php");
}
