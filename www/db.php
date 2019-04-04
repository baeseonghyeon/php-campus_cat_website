<?
$db = mysql_connect('localhost','mis1802','mis180202');
if( !$db ) {
	echo "DB 접속 오류 <br>";
	exit(1);
}
if( !mysql_select_db("mis1802") ){
	echo "DB 선택 오류<br>";
	exit(1);
}

mysql_query('set names utf8');
?>