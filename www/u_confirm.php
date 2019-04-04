<?
session_start();     
if($_SESSION[user_id] == ''){
	header("location:./index.php");
//	echo "아이디 또는 암호가 일치하지 않습니다.";
}
?>		