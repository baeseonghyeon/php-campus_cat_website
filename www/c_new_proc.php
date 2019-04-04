<?
session_start();
include "db.php";
include "img.php";
// id를 세션에서 가져오기
$user_id = $_SESSION[user_id];
$c_school = $_SESSION[school];
$c_club = $_SESSION[club];
// form data 가져오기
$c_name = $_REQUEST[c_name];
$c_age = $_REQUEST[c_age];
$c_sex = $_REQUEST[c_sex];
$c_spac = $_REQUEST[c_spac];
$c_medi = $_REQUEST[c_medi];
$c_char_img = $_REQUEST[c_char_img];
$c_char = $_REQUEST[c_char];
// 고양이 아바타 사진
$tmp_file = $_FILES[c_avatar][tmp_name]; //임시 디렉토리 구분 이름
$filename = $_FILES[c_avatar][name]; //원래파일 이름
$fileext = $_FILES[c_avatar][ext]; //확장자

$lat = 0;
$lng = 0;

// 고양이 프로필 첨부파일 확인
if( is_uploaded_file($tmp_file) ) {
	$up_path = "img";
	$upfile_path = getcwd()."/".$up_path;
	if( !is_dir($upfile_path) ) mkdir($upfile_path, 0777);
	$des_name = date("Y-m-d_H-i-s").".jpg";
	$des_file = $upfile_path."/".$des_name;
	$err = move_uploaded_file($tmp_file, $des_file);
	$exif = exif_read_data($des_file);  // 추가정보, ex)사진 exif 위치정보추출
	$lat = intval($exif[GPSLatitude][0])+
			intval($exif[GPSLatitude][1])/60+
			intval($exif[GPSLatitude][2])/3600;
	$lng = intval($exif[GPSLongitude][0])+
			intval($exif[GPSLongitude][1])/60+
			intval($exif[GPSLongitude][2])/3600;
	//img resize		
	$src = $des_name;
	$des = $src;
	img_resize($src, $des, $upfile_path, 320);
	
	$img_path = $up_path."/".$des_name;
}

// 고양이 특징 사진
$tmp_file2 = $_FILES[c_char_img][tmp_name]; //임시 디렉토리 구분 이름
$filename = $_FILES[c_char_img][name]; //원래파일 이름
$fileext = $_FILES[c_char_img][ext]; //확장자

$lat = 0;
$lng = 0;

// 고양이 특징 사진
if( is_uploaded_file($tmp_file2) ) {
	$up_path = "img";
	$upfile_path = getcwd()."/".$up_path;
	if( !is_dir($upfile_path) ) mkdir($upfile_path, 0777);
	$des_name = date("Y-m-d_H-i-s").".jpg";
	$des_file = $upfile_path."/".$des_name;
	$err = move_uploaded_file($tmp_file2, $des_file);
	$exif = exif_read_data($des_file);  // 추가정보, ex)사진 exif 위치정보추출
	$lat = intval($exif[GPSLatitude][0])+
			intval($exif[GPSLatitude][1])/60+
			intval($exif[GPSLatitude][2])/3600;
	$lng = intval($exif[GPSLongitude][0])+
			intval($exif[GPSLongitude][1])/60+
			intval($exif[GPSLongitude][2])/3600;
	//img resize		
	$src = $des_name;
	$des = $src;
	img_resize($src, $des, $upfile_path, 320);
	
	$c_char_img = $up_path."/".$des_name;
}

//DB 입력
$sql = "insert into cat values('','$user_id','$img_path','$c_name','$c_age','$c_sex','$c_spac','$c_medi','$c_char_img','$c_char',$lat,$lng, now(),0, '$c_school')";
//$sql = "insert into test_bsh values('$user_id', password('$pwd'), '$name', '$phone', '')";
$res = mysql_query($sql);
//고양이 id
$cid = $_REQUEST[cid];
?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Camcat_new</title>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://symis.cafe24.com/js/dis_ajax.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>

<body>
	<div data-role="page">
	<div data-role="header">
		<h1>글쓰기</h1>
	</div>
	<div data-role="main" class="ui-content">
	<? if( !$res ) { ?>
		<h1>글쓰기 오류</h1>
		<p>글 등록 중 오류가 발생하였습니다.</p>
		<a href="" data-rel="back" class="ui-btn">돌아가기</a>
	<? } else { ?>
		<!--페이지전환-->
		<script>
			location.replace('post.php');
		</script>	
	<? } ?>	
	</div>
</body>
</html>

