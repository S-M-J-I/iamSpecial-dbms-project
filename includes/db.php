<?php
$db['db_host'] = "sql6.freemysqlhosting.net";
$db['db_user'] = "sql6503144";
$db['db_pass'] = "qErrULbMKs";
$db['db_name'] = "dbms-qErrULbMKs";

foreach ($db as $key => $value) {
    define(strtoupper($key), $value);
}

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die("Connection Failed");
