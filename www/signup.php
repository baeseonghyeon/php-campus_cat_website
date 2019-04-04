<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Camcat</title>
<!--CSS stylesheet-->
<link rel="stylesheet" type="text/css" href="camcat.css">
	
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://symis.cafe24.com/js/dis_ajax.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>
<!--
<script>
	$('#school').click(function() { 
    	$(this).css("backgroundColor","#b6b6b6"); 
		$(this).css("color","white"); 
	});

</script>
-->
<body>
<div data-role="page" id="login_page" data-enhanced="true">
	<div data-role="header">
		<a href='#' data-rel="back" class="ui-btn"><img src="icon/left-arrow.png"/></a>
	</div>
	
	<div data-role="main" class="ui-content">
	</div>
	
	<div id="login_form">
		<form name="reg" method="post" action="signup_register.php">
			<h1>이메일로 회원가입</h1>
			<input type='email' name="user_id" id="user_id" required placeholder="이메일 주소 입력">
			<input type='password' name="pwd" id="pwd" required placeholder="비밀번호">
			<input type='password' name="pwd2" id="pwd2" required placeholder="비밀번호 확인">
			<input type='text' name="name" id="name" placeholder="이름 입력">
<!--			<input type='text' name="school" id="school">-->
			<select name="school" id="school" data-icon="false" required  onClick="jQuery(this).toggleClass('active')">
				<option value="" disabled selected>학교선택</option>
				<option value="삼육대학교">국민대학교</option>
				<option value="삼육대학교">광운대학교</option>
			  	<option value="삼육대학교">삼육대학교</option>
			</select>
			<input type="submit" value="회원가입">
		</form>
	</div> 
</div>	
</body>
</html>
