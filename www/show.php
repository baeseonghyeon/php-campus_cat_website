<?
include "db.php";
$cidx = $_REQUEST[cidx];

$sql = "select * from board_bsh where idx = $idx";
$res = mysql_query($sql);
$row = mysql_fetch_array($res);
// 조회수 증가
$hit = $row[hit]+1;
$sql = "update board_bsh set hit = $hit
		where idx = $idx";
$res = mysql_query($sql);
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
				url: 'c_show_like.php',
				data: { cidx : <?= $cidx ?> }
			}).done(function(msg){
					location.reload();
			});
		});
	});
</script>
</head>

<body>
	<div data-role="page">
	<div data-role="header">
		<h1>show</h1>
		<a href='#' data-rel="back" class="ui-btn ui-icon-back ui-corner-all ui-btn-icon-notext">back</a>
	</div>
	<div data-role="main" class="ui-content">
	<h2><?=$row[title]?></h2>
	<p><?=$row[user_id]?> | <?=$row[reg_time]?> | <?=$row[hit]?> | <img id="like" src=""></p>
		<? if( $row[img] ) { ?>
			<div style="text-align:center">
			<img src="<?=$row[img]?>" width="95%">
			</div>
		<? } ?>
	<div style="padding:5px; margin: 5px;"
		<p><?=nl2br( $row[content] ) ?></p>
	</div>
	<div>
		<p>댓글 <?= $num ?>개</p>
		<?
			//댓글 가져오기
			$sql = "select * from comment_bsh
				where bidx = $idx
				order by reg_time";
			$res = mysql_query($sql);
			$num = mysql_num_rows($res);
			for( $i = 0; $i < $num; $i++ ){ 
				$row2 = mysql_fetch_array($res);
			?>
			<div style="border: 1px solid #09cC; border-radius: 10px; padding: 2px 5px; margin: 2px 5px;">
				<b><?=$row2[user_id]?></b> | <?=$row2[reg_time]?>
				<p><?=nl2br($row2[comment])?></p>
			</div>
		<? } ?>
		<form name="cmt" id="cmt">
			<input type="hidden" name="bidx" value="<?=$idx?>">
			<textarea name="comment" id="comment" style="width:78%; display:inline-block;"></textarea>
			<button id="bt_reg" class="ui-btn ui-btn-inline" style="vertical-align: top; margin-right: 0px; height: 52px; width:20%;">등록</button>		
		</form>
	</div>
</body>
</html>

