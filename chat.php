<?php $title = "Chats" ?>
<?php include "includes/components/header.php" ?>
<?php include "includes/components/navbar.php" ?>
<?php

if (!isset($_SESSION["id"])) {
    header("Location: 404.php");
    return;
} else {
    if (isset($_GET["chatWith"])) {
        $chatWith = getUserByID($_GET["chatWith"]);
    } else {
        $chatWith = findOneUserWhoUserIsChattingWith($_SESSION["id"]);
        $chatWith = $chatWith["id"];
        header("Location: chat.php?chatWith=$chatWith");
    }
}

?>

<style>
    body {
        background-color: #f4f7f6;
        margin-top: 20px;
    }

    .card {
        background: #fff;
        transition: .5s;
        border: 0;
        margin-bottom: 30px;
        border-radius: .55rem;
        position: relative;
        width: 100%;
        box-shadow: 0 1px 2px 0 rgb(0 0 0 / 10%);
    }

    .chat-app .people-list {
        width: 280px;
        position: absolute;
        left: 0;
        top: 0;
        padding: 20px;
        z-index: 7
    }

    .chat-app .chat {
        margin-left: 280px;
        border-left: 1px solid #eaeaea
    }

    .people-list {
        -moz-transition: .5s;
        -o-transition: .5s;
        -webkit-transition: .5s;
        transition: .5s
    }

    .people-list .chat-list li {
        padding: 10px 15px;
        list-style: none;
        border-radius: 3px
    }

    .people-list .chat-list li:hover {
        background: #efefef;
        cursor: pointer
    }

    .people-list .chat-list li.active {
        background: #efefef
    }

    .people-list .chat-list li .name {
        font-size: 15px
    }

    .people-list .chat-list img {
        width: 45px;
        border-radius: 50%
    }

    .people-list img {
        float: left;
        border-radius: 50%
    }

    .people-list .about {
        float: left;
        padding-left: 8px
    }

    .people-list .status {
        color: #999;
        font-size: 13px
    }

    .chat .chat-header {
        padding: 15px 20px;
        border-bottom: 2px solid #f4f7f6
    }

    .chat .chat-header img {
        float: left;
        border-radius: 40px;
        width: 40px
    }

    .chat .chat-header .chat-about {
        float: left;
        padding-left: 10px
    }

    .chat .chat-history {
        padding: 20px;
        border-bottom: 2px solid #fff
    }

    .chat .chat-history ul {
        padding: 0
    }

    .chat .chat-history ul li {
        list-style: none;
        margin-bottom: 30px
    }

    .chat .chat-history ul li:last-child {
        margin-bottom: 0px
    }

    .chat .chat-history .message-data {
        margin-bottom: 15px
    }

    .chat .chat-history .message-data img {
        border-radius: 40px;
        width: 40px
    }

    .chat .chat-history .message-data-time {
        color: #434651;
        padding-left: 6px
    }

    .chat .chat-history .message {
        color: #444;
        padding: 18px 20px;
        line-height: 26px;
        font-size: 16px;
        border-radius: 7px;
        display: inline-block;
        position: relative
    }

    .chat .chat-history .message:after {
        bottom: 100%;
        left: 7%;
        border: solid transparent;
        content: " ";
        height: 0;
        width: 0;
        position: absolute;
        pointer-events: none;
        border-bottom-color: #fff;
        border-width: 10px;
        margin-left: -10px
    }

    .chat .chat-history .my-message {
        background: #efefef
    }

    .chat .chat-history .my-message:after {
        bottom: 100%;
        left: 30px;
        border: solid transparent;
        content: " ";
        height: 0;
        width: 0;
        position: absolute;
        pointer-events: none;
        border-bottom-color: #efefef;
        border-width: 10px;
        margin-left: -10px
    }

    .chat .chat-history .other-message {
        background: #e8f1f3;
        text-align: right
    }

    .chat .chat-history .other-message:after {
        border-bottom-color: #e8f1f3;
        left: 93%
    }

    .chat .chat-message {
        padding: 20px
    }

    .online,
    .offline,
    .me {
        margin-right: 2px;
        font-size: 8px;
        vertical-align: middle
    }

    .online {
        color: #86c541
    }

    .offline {
        color: #e47297
    }

    .me {
        color: #1d8ecd
    }

    .float-right {
        float: right
    }

    .clearfix:after {
        visibility: hidden;
        display: block;
        font-size: 0;
        content: " ";
        clear: both;
        height: 0
    }

    @media only screen and (max-width: 767px) {
        .chat-app .people-list {
            height: 465px;
            width: 100%;
            overflow-x: auto;
            background: #fff;
            left: -400px;
            display: none
        }

        .chat-app .people-list.open {
            left: 0
        }

        .chat-app .chat {
            margin: 0
        }

        .chat-app .chat .chat-header {
            border-radius: 0.55rem 0.55rem 0 0
        }

        .chat-app .chat-history {
            height: 300px;
            overflow-x: auto
        }
    }

    @media only screen and (min-width: 768px) and (max-width: 992px) {
        .chat-app .chat-list {
            height: 650px;
            overflow-x: auto
        }

        .chat-app .chat-history {
            height: 600px;
            overflow-x: auto
        }
    }

    @media only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation: landscape) and (-webkit-min-device-pixel-ratio: 1) {
        .chat-app .chat-list {
            height: 480px;
            overflow-x: auto
        }

        .chat-app .chat-history {
            height: calc(100vh - 350px);
            overflow-x: auto
        }
    }
</style>


<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />


<?php

function toggleActive($id)
{
    if (isset($_GET["chatWith"])) {
        if ($_GET["chatWith"] == $id) {
            return "<li class='clearfix active'>";
        } else {
            return "<li class='clearfix'>";
        }
    } else {
        return "<li class='clearfix'>";
    }
}

?>

<div class="container">
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card chat-app" style="height: auto;">
                <div id="plist" class="people-list">
                    <ul class="list-unstyled chat-list mt-2 mb-0">
                        <?php include_once "includes/components/chat-users.php" ?>
                    </ul>
                </div>
                <div class="chat">
                    <div class="chat-header clearfix">
                        <div class="row">
                            <div class="col-lg-6">
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                                    <img src="images/avatars/<?php echo $chatWith["avatar"] ?>?1234324" alt="avatar">
                                </a>
                                <div class="chat-about">
                                    <h6 class="m-b-0"><?php echo $chatWith["first_name"] . " " . $chatWith["last_name"] ?></h6>
                                </div>
                            </div>
                            <div class="col-lg-6 hidden-sm text-right">
                                <?php

                                if ($_SESSION["role"] == 2) {
                                    echo "
                                    <a href='./admin/counselor-bookings.php?confirmWith={$chatWith['id']}' class='btn btn-outline-success'><i class='fa fa-circle-check'></i> Confirm Appointment</a>
                                    ";
                                }

                                ?>
                            </div>
                        </div>
                    </div>
                    <div id="chat-history" class="chat-history" style="overflow-x: auto; overflow-y: scroll; height:70vh;">
                        <ul style="list-style-type: none;" class="m-b-0">

                        </ul>
                    </div>
                    <div class="chat-message clearfix">
                        <form action="" id="typing-area">
                            <div class="input-group mb-0">
                                <input name="sender" style="display: none;" type="text" value="<?php echo $_SESSION["id"]  ?>">
                                <input name="receiver" style="display: none;" type="text" value="<?php echo $chatWith["id"]  ?>">
                                <input id="message" name="message" type="text" class="form-control" placeholder="Enter text here...">
                                <div style="cursor: pointer;" id="send" class="input-group-prepend">
                                    <span class="input-group-text">Send <i class="fa fa-send"></i></span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="js/chat.js"></script>
<!-- <script src="js/chat-users.js"></script> -->
<?php include "includes/components/footer.php" ?>