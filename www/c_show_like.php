<?
session_start();
include "db.php";

$cdix = $_REQUEST[cid];
$uid = $_SESSION[user_id];
// 좋아요 했는지 확인
$sql = "select * from c_like where uid = '$uid' and cidx = $cid";
$res = mysql_query($sql);
$num = mysql_num_rows($res);
if ( $num == 0 ) {
	$sql = "insert into c_like values('', $cid, '$uid')";
	$res = mysql_query($sql);
}	
// 전체 좋아요 개수 확인
$sql = "select count(*) as cnt from m_like where cidx = $cid";
$res = mysql_query($sql);
$sql = mysql_fetch_array($res);
echo $row[cnt];
?>
