<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Camcat</title>
<link rel="stylesheet" href="camcat.css"/>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://symis.cafe24.com/js/dis_ajax.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>
<body>
<div data-role="page" id="login_page" data-enhanced="true">
	<div data-role="header">
		<a href='#' data-rel="back" class="ui-btn"><img src="icon/left-arrow.png"/></a>
	</div>
	<div data-role="main" class="ui-content">

	</div>
	<div id="login_form">
		<form name="login" method="post" action="login_proc.php">
			<h1>이메일로 로그인</h1>
			<input type='email' name="user_id" id="user_id" required placeholder="이메일 주소 입력">
			<input type='password' name="pwd" id="pwd" required placeholder="비밀번호 입력">
			<input type="submit" value="로그인">
		</form>
	</div>
</div>	
</body>
</html>
