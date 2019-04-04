<?
session_start();
include "db.php";
// form data 가져오기
$user_id = $_REQUEST[user_id];  //변수 = name
$pwd = $_REQUEST[pwd];
// id & pw 일치 검사
$sql = "select * from user where user_id = '$user_id' and pwd = password('$pwd')";
$res = mysql_query($sql);
$num = mysql_num_rows($res);

if( $num == 0 ) {
	// 회원추가, 문자열 변수 '' 넣기
	$err = "아이디 또는 암호가 일치하지 않습니다.";
} 
else {
	$row = mysql_fetch_array($res);
	$_SESSION[user_id] = $row[user_id];
	$_SESSION[name] = $row[name];
	$_SESSION[school] = $row[school];
	$_SESSION[club] = $row[club];
}
?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Camcat_register</title>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://symis.cafe24.com/js/dis_ajax.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>

<body>
	<div data-role="page" id="page">
	<div data-role="header">
	</div>
		<div data-role="main" class="ui-content">
			<? if ( $num == 0 ) { ?>
			<script>
				$(document).ready(function() {
					alert("<?= $err ?>");	
				});
			  location.href="login.php";
			</script>	
			<? } else { ?>
				<script>
					location.href="post.php";
					//location객체는 현재페이지를 나타냄
				</script>
			<? } ?>
		</div>
	</div>
</body>
</html>
