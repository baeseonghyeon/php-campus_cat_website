<?
session_start(); 
include "db.php";
include "u_confirm.php";
$cl_name = $_REQUEST[cl_name];

$sql = "select * from club where cl_name = '$cl_name'";
$res = mysql_query($sql);
$row = mysql_fetch_array($res);
// 조회수 증가
$hit = $row[hit]+1;
$sql = "update cat set hit = $hit
		where cid = $cid";
$res = mysql_query($sql);
// 좋아요
$sql = "select * from c_like where cid = $cid";
$res = mysql_query($sql);
$like2 = mysql_fetch_array($res);
// 좋아요 횟수 얻기 
$sql = "select count(*) as cnt from c_like where cid = $cid";
$res = mysql_query($sql);
$like = mysql_fetch_array($res);
// 소속 고양이 수
$res2 = mysql_query("select count(if(c_school = '$row[cl_school]', c_school, NULL)) as cnt from cat");
$row2 = mysql_fetch_array($res2);
$count = $row2['cnt'];
//// 소속 회원 수
$res3 = mysql_query("select count(if(club = '$row[cl_name]', club, NULL)) as cnt2 from user");
$row3 = mysql_fetch_array($res3);
$club_user = $row3['cnt2'];

//map
$lat = $row[lat];
if(!$lat)$lat = 37.642695;
$lng = $row[lng];
if(!$lng)$lng = 127.107122;
?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title><?=$row[cl_name]?></title>
<link rel="stylesheet" href="camcat.css"/>		
<link rel="stylesheet" href="//code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="//symis.cafe24.com/js/dis_ajax.js"></script>
<script src="//code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<script src="//dapi.kakao.com/v2/maps/sdk.js?appkey=ca8862bef7b12e84a86e41574848eec8&libraries=services,drawing"></script>	
<script>
	$(document).ready(function(e) {
		$('#bt_reg').click(function(e) {
			if( $('#comment').val() == '') {
				alert("댓글을 입력해 주세요");
				return;
			}
			$.ajax({
				method: 'GET',
				url: 'cmt_proc.php',
				data: $('#cmt').serialize()
			}).done(function(msg){
					location.reload();
			});
		});
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
		<div class="c-profile">
			<div class="c-probox">	
				<div class="c-namebox">
					<h2><?= $row[cl_school] ?></h2>
				</div>	
				<div class="c-namebox">
					<h1><?=$row[cl_name]?></h1>
				</div>
				<div class="c-namebox">
					<h3><?=$row[cl_info]?></h3>
				</div>
			</div>	
		</div>
	</div>
	<div class="club-photo">
		<? if( $row[cl_img] ) { ?>
		<img src="<?=$row[cl_img]?>">
		<? } ?>
	</div>
	<div data-role="navbar">
    <ul>
        <li><a href="#" class="ui-btn-active">단체 소개</a></li>
        <li><a href="#">단체 정보</a></li>
        <li><a href="#">후원하기</a></li>
    </ul>
	</div><!-- /navbar -->
		
	<div class="club-info" id="c-info">
		<h2>단체소개</h2>
		<h3><?=$row[cl_content]?></h3>
		<div class="catinfolist scrolling-wrapper">
			<? if( $row[c_age] ) { ?>
				<div class="catinfo_box">
					<img src="icon/c_age.png">
					<p><?=nl2br( $row[c_age] )?>세 (추정)</p>
				</div>		
			<? } ?>
			<? if( $row[c_sex] ) { ?>
				<div class="catinfo_box">
					<img src="icon/c_sex.png">
					<? if( $row[c_sex] == '♂' ) { ?>
					<p>수컷</p>
					<? }?>
					<? if( $row[c_sex] == '♀' ) { ?>
					<p>암컷</p>
					<? }?>
				</div>		
			<? } ?>
			<? if( $row[c_spac] ) { ?>
				<div class="catinfo_box">
					<img src="icon/c_spac.png">
					<p><?=nl2br( $row[c_spac] ) ?></p>
				</div>	
			<? } ?>
			<? if( $row[c_medi] ) { ?>
				<div class="catinfo_box">
					<img src="icon/c_medi.png">
					<p><?=nl2br( $row[c_medi] ) ?></p>
				</div>		
			<? } ?>
			<div class="empty"></div>
		</div>
		<div class="line"></div>
			<h2>활동 내역</h2>
		<div class="line"></div>
			<h2>전체 사진</h2>
	</div>
	<div class="c-info">
		<h2>단체 정보</h2>
		<div id="map"></div>
		<p><?=$row[cl_loca]?></p>
		<p><?=$count?>&nbsp;마리</p>
		<p><?=$club_user?>&nbsp;명</p>
		<p>마지막 위치 <?=$row[reg_time]?></p>
		<a href="#" class="ui-btn ui-btn-corner-all" id="map_btn2">발자취 모두보기</a>
	</div>
	<div class="c-info">
		<h2><?=$row[c_school]?>&nbsp;관리단체</h2>
		<div class="c-profile">
			<div class="club-ava">
			<? if( $club[cl_img] ) { ?>
				<img src="<?=$club[cl_img]?>"/>
			<? } ?>
			</div>	
			<div class="club-box">	
				<div class="club-box-box">
					<h1><?=$club[cl_name]?></h1>
				</div>	
				<div class="club-box-box">
					<h3><?= $club[cl_info]?></h3>
				</div>
			</div>	
		</div>
		<div class="club-btn-box">
<!--			<div class="club-btn-box-box">-->
				<a href="#" class="club-btn ui-btn ui-btn-corner-all">메시지 보내기</a>	
				<a href="#" class="club-btn ui-btn ui-btn-corner-all">페이지 방문</a>
<!--			</div>	-->
		</div>
		<div class="line"></div>
			<h2><?=$row[c_name]?>에게 후원하기</h2>
			<h3><?= $club[cl_info]?></h3>
	</div>	
		
	<div>
	<div class="c-info comment">
		<h2>댓글 <?= $num ?></h2>
		<?
			//댓글 가져오기
			$sql = "select * from c_cmt
				where cid = $cid
				order by regtime";
			$res = mysql_query($sql);
			$num = mysql_num_rows($res);
			for( $i = 0; $i < $num; $i++ ){ 
				$row2 = mysql_fetch_array($res);
			?>
		
			<div class="cmt">
				<p><b><?=$row2[uname]?></b></p>
				<p><?=nl2br($row2[comment])?></p>
				<p><?=$row2[regtime]?></p>
			</div>
		
		<? } ?>
	</div>	
		<form name="cmt" id="cmt">
			<input type="hidden" name="cid" value="<?=$cid?>">
			<textarea name="comment" id="comment" style="width:78%; height:100px; display:inline-block;"></textarea>
			<button id="bt_reg" class="ui-btn ui-btn-inline" style="vertical-align: top; margin-right: 0px; height: 100px; width:20%;">등록</button>		
		</form>
	</div>
</body>
</html>

