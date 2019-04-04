<?
session_start();
include "db.php";
// form data 가져오기
$user_id = $_REQUEST[user_id];
$pwd = $_REQUEST[pwd];
$name = $_REQUEST[name];
$school = $_REQUEST[school];
// id 중복 검사
$sql = "select * from user where user_id = '$user_id'";
$res = mysql_query($sql);
$num = mysql_num_rows($res);
if( $num == 0 ) {
	// 회원추가, 문자열 변수 '' 넣기
	$sql = "insert into user values('$user_id', password('$pwd'), '$name', '$school', '')";
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$_SESSION[user_id] = $user_id;
	$_SESSION[name] = $name;
	$_SESSION[school] = $school;
	if(!$res) { // DB 입력 오류
		$err = "DB 입력 오류 입니다.";
		echo $sql."<br>";
	}
} 
else {
	$err = "이미 사용중인 아이디 입니다.";
}
?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Camcat_register</title>
<link rel="stylesheet" href="camcat.css"/>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://symis.cafe24.com/js/dis_ajax.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>

<body>
	<div data-role="page" id="page">
	<div data-role="header">
		<h1>회원가입</h1>
	</div>
	<div data-role="main" class="ui-content">
		<? if ( $err ) { ?>
			<h2>가입 오류</h2>
			<p><?= $err ?></p>
			<a href="p02.php" data-rel="back" class="ui-btn">돌아가기</a>
		<? } else { ?>
			<script>
				alert("<?= $name ?>님 가입을 환영한다옹.");
				location.replace('post.php');
			</script>	
<!--
			<h2>가입 완료</h2>
			<p></?= $name ?>님 가입을 환영한다옹.</p>
			<a href="login.php" class="ui-btn"></a>
-->
		<? } ?>
	</div>
</body>
</html>
