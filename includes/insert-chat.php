<?php include "db.php";

session_start();
if (isset($_SESSION["id"])) {
    $senderID = mysqli_real_escape_string($connection, $_POST["sender"]);
    $receiverID = mysqli_real_escape_string($connection, $_POST["receiver"]);
    $message = mysqli_real_escape_string($connection, $_POST["message"]);
    $date_time = date('Y/m/d H:i:s');

    if (!empty($message)) {
        $sql = "INSERT INTO chats(`sender`, `receiver`, `message`, `date_time`) VALUES (?,?,?,?)";
        $query = $connection->prepare($sql);
        $query->bind_param("iiss", $senderID, $receiverID, $message, $date_time);
        $query->execute() or die("Failed " . mysqli_error($connection));
    }
} else {
    header("Location: 404.php");
}
