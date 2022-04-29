<?php include "db.php";

session_start();
if (isset($_SESSION["id"])) {
    $senderID = mysqli_real_escape_string($connection, $_POST["sender"]);
    $receiverID = mysqli_real_escape_string($connection, $_POST["receiver"]);
    $message = mysqli_real_escape_string($connection, $_POST["message"]);

    if (!empty($message)) {
        $sql = "INSERT INTO chats(`sender`, `receiver`, `message`) VALUES (?,?,?)";
        $query = $connection->prepare($sql);
        $query->bind_param("iis", $senderID, $receiverID, $message);
        $query->execute() or die("Failed " . mysqli_error($connection));
    }
} else {
    header("Location: 404.php");
}
