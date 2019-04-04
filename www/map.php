<?
session_start(); 
include "db.php";
include "u_confirm.php";
$cid = $_REQUEST[cid];

$sql = "select * from cat where cid = $cid";
$res = mysql_query($sql);
$row = mysql_fetch_array($res);
// 좋아요
$sql = "select * from c_like where cid = $cid";
$res = mysql_query($sql);
$like2 = mysql_fetch_array($res);
// 좋아요 횟수 얻기 
$sql = "select count(*) as cnt from c_like where cid = $cid";
$res = mysql_query($sql);
$like = mysql_fetch_array($res);
// 관리단체
$res = mysql_query("select * from club where cl_school = '$row[c_school]'");
$club = mysql_fetch_array($res);
//map
$lat = $row[lat];
if(!$lat)$lat = 37.642695;
$lng = $row[lng];
if(!$lng)$lng = 127.107122;

$cl_name = $_REQUEST[cl_name];
?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title><?=$row[c_name]?></title>
<link rel="stylesheet" href="camcat.css"/>		
<link rel="stylesheet" href="//code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="//symis.cafe24.com/js/dis_ajax.js"></script>
<script src="//code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<script src="//dapi.kakao.com/v2/maps/sdk.js?appkey=ca8862bef7b12e84a86e41574848eec8&libraries=services,drawing"></script>
	
<script>
	$(document).ready(function(e) {
		$('#like').click(function(e) {
			$.ajax({
				method: 'GET',
				url: 'cat_like.php',
				data: { cid : <?= $cid ?>}
			}).done(function(msg){
					//location.reload();
				$('#lcnt').html(msg);
			});
			
		});
		
		var center =  new daum.maps.LatLng(37.642695, 127.107122); //지도의 중심좌표. 바울관
//		var center =  new daum.maps.LatLng(<#?=$row[lat]?>,<#?=$row[lng]?>); 
		buildMap(center);
		
		
	});
	
	// 지도 생성
	function buildMap(pos) {
	
		var options = { //지도를 생성할 때 필요한 기본 옵션
			center: pos, //지도의 중심좌표.
			level: 3 //지도의 레벨(확대, 축소 정도)
		};
		var container = document.getElementById('map');
		var map = new daum.maps.Map(container, options);

		// 마커를 표시할 위치입니다 
		var position =  pos;

		// 마커를 생성합니다
		var marker = new daum.maps.Marker({
			position: position,
			clickable: true // 마커를 클릭했을 때 지도의 클릭 이벤트가 발생하지 않도록 설정합니다
		});

		// 마커를 지도에 표시합니다.
		marker.setMap(map);

		/*
		// 인포윈도우 내용
		var iwContent = '<div style="padding:5px;">Hello World!</div>';
		// 인포윈도우를 생성합니다
		var infowindow = new daum.maps.InfoWindow({
			content : iwContent,
			removable : true
		});

		// 마커에 클릭이벤트를 등록합니다
		daum.maps.event.addListener(marker, 'click', function() {
			  // 마커 위에 인포윈도우를 표시합니다
			  infowindow.open(map, marker);  
		});
		*/

	}
	
</script>
</head>

<body>
	<div data-role="page" id="cat-page" data-enhanced="true">
	<div data-role="header" class="header">
		<a href='#' data-rel="back" class="back-btn"><img src="icon/left-arrow.png"/></a>	
	</div>
			
	<div class="likesec">
		<div class="like">				
			<? if( $like2[uid] == $_SESSION[user_id] ) { ?>
				<img id="like" src="https://image.flaticon.com/icons/svg/535/535183.svg"onclick="changeImage()">
			<? } else { ?>
				<img id="like" src="https://image.flaticon.com/icons/svg/535/535285.svg" onclick="changeImage()">
			<? } ?>
			<script>
				function changeImage() {
					if (document.getElementById("like").src == "https://image.flaticon.com/icons/svg/535/535285.svg") 
					{
						document.getElementById("like").src = "https://image.flaticon.com/icons/svg/535/535183.svg";
					}
					else 
					{
						document.getElementById("like").src = "https://image.flaticon.com/icons/svg/535/535285.svg";
					}
				}
			</script>
			<span id="lcnt"><?=$like[cnt]?></span>
		</div>
	</div>		
	<div data-role="main" class="ui-content cat">
		<div id="map" class="cat_map"></div>
		<div class="c-profile">
			<div class="c-ava">
			<? if( $row[c_ava] ) { ?>
				<img src="<?=$row[c_ava]?>"/>
			<? } ?>
			</div>	
			<div class="c-probox">	
				<div class="c-namebox">
					<h1><?=$row[c_name]?></h1>
					<h2><?=$row[c_sex]?></h2>
				</div>	
				<div class="c-namebox">
					<h3><?= $row[c_school] ?><?= $row[c_group] ?> - 동행길
				</div>
			</div>	
		</div>
	</div>
</body>
</html>

