<?
session_start();
include "db.php";

$cid = $_REQUEST[cid];
$user_id = $_SESSION[user_id];
// 좋아요 했는지 확인
$sql = "select * from c_like where cid = '$cid' and uid = '$user_id'";
$res = mysql_query($sql);
$num = mysql_num_rows($res);
if ( $num == 0 ) {
	$sql = "insert into c_like values('', $cid, '$user_id')";
	$res = mysql_query($sql);
}	
// 전체 좋아요 개수 확인
$sql = "select count(*) as cnt from c_like where cid = $cid";
$res = mysql_query($sql);
$row = mysql_fetch_array($res);
echo $row[cnt];
?>
