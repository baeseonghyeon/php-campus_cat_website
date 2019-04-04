<?
session_start();
include "db.php";

$uid = $_SESSION[user_id];
$uname = $_SESSION[name];
$cid = $_REQUEST[cid];
$comment = $_REQUEST[comment];

$sql = "insert into c_cmt values ('', $cid, '$uid', '$uname', now(), '$comment')";
$res = mysql_query($sql);
?>