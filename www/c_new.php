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
		<h1>냥이등록</h1>
		<a href='#' data-rel="back" class="ui-btn ui-icon-back ui-corner-all ui-btn-icon-notext">back</a>
	</div>
	<div data-role="main" class="ui-content">
	</div>
	<div style="margin: 10px">
		<form name="main" method="post" enctype="multipart/form-data" action="c_new_proc.php">
			<label for="c_avatar">사진첨부</label>											<input type='file' name="c_avatar" id="c_avatar" accept="image/jpeg">
			
			<label for="c_name">애칭</label>
				<input type='text' name="c_name" id="c_name" required>
			
			<label for="c_age">나이</label>
				<input id="c_age" name="c_age" type="number" value="0"/>
				<input type="checkbox" name="c_age" value=""><p>모르겠당</p>
			
			<label for="c_sex">성별</label>
				<input type="checkbox" name="c_sex" value="♂" data-mini="true">수컷
				<input type="checkbox" name="c_sex" value="♀">암컷
				<input type="checkbox" name="c_sex" value="">모르겠당
			
			<label for="c_spac">종</label>
				<select name="c_spac" id="c_spac" required>
					<option value="" disabled selected>종 선택</option>
					<option value="코리안쇼컷">코리안쇼컷</option>
					<option value="뱅갈">뱅갈</option>
					<option value="노르웨이숲">노르웨이숲</option>
				</select>
			
			<label for="c_medi">의료정보</label>
				<input type="checkbox" name="ntr" value="ntr">중성화<br>
			
			<label for="c_char">특징</label>
				<input type='file' name="c_char_img" id="c_char_img" accept="image/jpeg">
				<input type='text' name="c_char" id="c_char" required>
			<input type="submit" value="냥이 등록">
		</form>
<!--		<a href="p02.php" class="ui-btn ui-btn-corner-all">회원가입</a>-->
	</div> 
</div>	
</body>
</html>
