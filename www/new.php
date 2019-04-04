<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Camcat</title>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://symis.cafe24.com/js/dis_ajax.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>

<body>
<div data-role="page">
	<div data-role="header">
		<h1>고양이 추가</h1>
		<a href='#' data-rel="back" class="ui-btn ui-icon-back ui-corner-all ui-btn-icon-notext">back</a>
	</div>
	<div data-role="main" class="ui-content">
	</div>
	<div style="margin: 10px">
		<form name="main" method="post" enctype="multipart/form-data" action="new_proc.php">
			<label for="c_avatar">사진</label>
			<input type='file' name="c_avatar" id="c_avatar" accept="image/jpeg">
			
			<label for="c_name">고양이 애칭</label>
			<input type='text' name="c_name" id="c_name" required>
			
			<label for="c_age">나이</label>
			<select name="school" id="school" required>
				<option value="" disabled selected>학교선택</option>
			  	<option value="삼육대학교">삼육대학교</option>
			</select>
			<textarea name="c_age" id="c_age" required></textarea>
			
			<label for="c_sex">성별</label>
			<select name="c_sex" id="c_sex" required>
				<input type="checkbox" name="c_sex" value="male">암컷<br>
				<input type="checkbox" name="c_sex" value="female">수컷<br>
				<input type="checkbox" name="c_sex" value="" checked>모르겠당<br>
			</select>
			
			<label for="spec">종</label><br>
			<select name="spec" id="spec">
				<option value="" disabled selected>종선택</option>
			  	<option value="코리안쇼컷">코리안쇼컷</option>
				<option value="뱅갈">뱅갈</option>
				<option value="노르웨이숲">노르웨이숲</option>
				<option value="러시안블루">러시안블루</option>
			</select>
			<label for="medi">의료정보</label>
			<select name="medi1" id="medi1" required>
				<input type="checkbox" name="medi1" value="ntr">중성화여부<br>
				<input type="checkbox" name="c_sex" value="female">수컷<br>
				<input type="checkbox" name="c_sex" value="" checked>모르겠당<br>
			</select>
			
			<label for="char">특징</label>
			<input type="text" name="char" id="char">
														
			<input type="submit" value="냥이 등록">
		</form>
<!--		<a href="p02.php" class="ui-btn ui-btn-corner-all">회원가입</a>-->
	</div> 
</div>	
</body>
</html>
