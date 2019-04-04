<?
session_start();     
header('expires:0');
include "db.php";
include "u_confirm.php";
// 보드 글 조회
$sql = "select * from cat order by reg_time desc LIMIT 0, 6";
$res = mysql_query($sql);
$num = mysql_num_rows($res);

// 학교 고양이 수
$res2 = mysql_query("select count(if(c_school = '$_SESSION[school]', c_school, NULL)) as cnt from cat");
$row = mysql_fetch_array($res2);
$count = $row['cnt'];

// 학교 단체
$res3 = mysql_query("select * from club where cl_school = '$_SESSION[school]'");
$club = mysql_fetch_array($res3);

$cl_name = $_REQUEST[cl_name];
?>
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
<div data-role="page" id="main_page" data-enhanced="true">
	<div data-role="header" id="fixhead">
		<img src="icon/camcat_w.png" class="logo2">
		<a href="#mypanel" id="menu_btn" class="ui-btn-right"><img src="icon/menu_w.png" class="menu_btn"/></a>
	</div>
	<div data-role="panel" id="mypanel" data-display="overlay" data-position="right">
		<a href="#my-header" data-rel="close" data-position-fixed="true" class="ui-btn-left"><img src="icon/cancel.png" class="cancel_btn"/></a>
		<div class="menu_a">
			<div class="menu1">
				<h2><?=$_SESSION[name]?></h2>
				<p><?=$_SESSION[school]?>&nbsp;<?=$_SESSION[club]?></p>
			</div>	
			<div class="menu2">
				<ul data-role="listview">
					<li>알림</li>
					<li>마켓</li>
					<li>켓시판</li>
				</ul>
			</div>
		</div>
		<div class="menu_b">
			<div class="menu3">
				<ul data-role="listview">
					<li>공지사항</li>
					<li>친구에게 추천하기</li>
					<li>문의하기</li>
					<li data-icon="false"><a href="logout.php" class="panel-btn">로그아웃</a></li>
				</ul>
			</div>
		</div>	
    <!-- panel content goes here -->
	</div><!-- /panel -->
	<div data-role="main" class="ui-content main">
		<div class="c_school">
			<h1><?=$_SESSION[school]?></h1>
			<h2><?=$count?>&nbsp;마리의 고양이들 :)</h2>
		</div>
		<div class="catlist scrolling-wrapper">
			<? if( $num == 0 ) { ?>
				<li>등록된 글이 없습니다.</li>
			<? } else { ?>
				<? for( $i = 0; $i < $num; $i++ ) {
					$row = mysql_fetch_array($res);
				?>
				<? if( $_SESSION[school] == $row[c_school]  ) { ?>
					<a href="cat.php?cid=<?=$row[cid]?>">
						<div class="catlist_box">
							<img src="<?=$row[c_ava]?>"/>
							<h2><?=$row[c_name]?></h2>
						</div>	
					</a>		
				<? } ?>
				<? } ?>
			<? } ?>
			<div class="list_box_last">
				<div class="catlist_box add">
						<a href="c_new.php"><img src="icon/add.png" class="add_btn"/><h2>냥이 등록</h2></a>
				</div>
			</div>		
		</div>
		<a href="map.php?=<?=$_SESSION[school]?>" class="ui-btn ui-btn-corner-all" id="map_btn"><?=$_SESSION[school]?>&nbsp;냥이맵</a>
	</div>
	<a href="club.php?cl_name=<?=$club[cl_name]?>" class="club-link">				
		<div class="club">
			<div class="club_info">
				<h2><?= $club[cl_school]?></h2>
				<h1><?= $club[cl_name]?></h1>
				<p><?= $club[cl_info]?></p>
			</div>	
			<div class="club_img">
				<img src="<?= $club[cl_img]?>" style="width: 100%;"/>
			</div>	
		</div>
	</a>	
</div>
</body>	
</html>
<script>
	$(window).scroll(function() {
	  var $el = $('#fixhead');

	  if($(this).scrollTop() >= 1) $el.addClass('shown');
	  else $el.removeClass('shown');
});
</script>