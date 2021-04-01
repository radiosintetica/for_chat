<?
require_once 'excel_reader2.php';
require_once 'excel.php';

if(is_uploaded_file($_FILES["file"]["tmp_name"])) {
	$DB_HOST = "u93883.mysql.masterhost.ru";
	$DB_USER = "u93883_1";
	$DB_PASSWORD = "unrudsmou6epw";
	$con = mysql_connect($DB_HOST, $DB_USER, $DB_PASSWORD);
	if (!$con) {
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db("u93883_1", $con);
	mysql_query ('SET NAMES cp1251');
	mysql_query ('SET CHARACTER SET cp1251');


	$query = "CREATE TABLE IF NOT EXISTS `atxmltv_tvprogs1` (
	`id` int(11) NOT NULL,
	`chanid` longtext,
	`disp_name` longtext,
	`prog_id` longtext,
	`prog_start` longtext,
	`prog_stop` longtext,
	`prog_title` longtext,
	`prog_desc` longtext,
	`prog_epis` longtext,
	`prog_director` longtext,
	`prog_comp` longtext,
	`prog_raspect` longtext,
	`prog_children` longtext,
	`prog_country` longtext,
	`prog_date` longtext,
	`prog_img` longtext,
	`prog_act` longtext,
	UNIQUE KEY `ID` ( `ID` ) 
	) ENGINE = MYISAM DEFAULT CHARSET = utf8;";
	mysql_query($query,$con) or die(mysql_error());	

	
	move_uploaded_file($_FILES["file"]["tmp_name"], $_FILES["file"]["name"]);
	$filename = $_FILES["file"]["name"];	 
	//print $filename;
	$startstr = strrpos( $filename, '.' );
	if( $startstr == false ) {
		unlink($_FILES["file"]["name"]);
		die;
	}
	$filename_ext = substr( $filename,  $startstr );
	if( $filename_ext != '.xls' && $filename_ext != '.XLS' ) {
	print $filename_ext;
		unlink($_FILES["file"]["name"]);
		die;
	}
	
	$excel_file = $filename;
	$data = new Spreadsheet_Excel_Reader($excel_file);
	$sheet_index = 0;
	$max_row = $data->rowcount($sheet_index);
	$max_col = $data->colcount($sheet_index);
	//echo "(".$max_row.")x(".$max_col.")<br />";
	flush();
	
	$name	= $data->val(1, 1, $sheet_index);
	$name2	= $data->val(1, 2, $sheet_index);

	$counter = 0;
	$global = 0;
	$first = 1;
	header("Content-type: application/xml");
	print '<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE tv SYSTEM "xmltv.dtd">
<tv generator-info-name="alextyu_gen">';
$names[] = '';

	for( $i=$first; $i<=$max_row; $i++ ) {
		$name	= $data->val($i, 1, $sheet_index);
		$name2	= $data->val($i, 2, $sheet_index);
		
		if( array_search($name, $names) ) {
			continue;
		}
		$names[] = $name;
		
		print '
	  <channel id="'.$name.'">
		<display-name lang="ru">'.$name2.'</display-name>
	  </channel>';
	}


	for( $i=$first; $i<=$max_row; $i++ ) {
		//break;
		flush();
		$name	= trim(iconv('UTF-8', 'Windows-1251', $data->val($i, 1, $sheet_index)));
		$name2	= trim(iconv('UTF-8', 'Windows-1251', $data->val($i, 2, $sheet_index)));
		$name3	= trim(iconv('UTF-8', 'Windows-1251', $data->val($i, 3, $sheet_index)));
		$name4	= trim(iconv('UTF-8', 'Windows-1251', $data->val($i, 4, $sheet_index)));
		$name5	= trim(iconv('UTF-8', 'Windows-1251', $data->val($i, 5, $sheet_index)));
		$name6	= trim(iconv('UTF-8', 'Windows-1251', $data->val($i, 6, $sheet_index)));
		$name7	= trim(iconv('UTF-8', 'Windows-1251', $data->val($i, 7, $sheet_index)));
		$name8	= trim(iconv('UTF-8', 'Windows-1251', $data->val($i, 8, $sheet_index)));
		$name9	= trim(iconv('UTF-8', 'Windows-1251', $data->val($i, 9, $sheet_index)));
		$name10	= trim(iconv('UTF-8', 'Windows-1251', $data->val($i, 10, $sheet_index)));
		$name11	= trim(iconv('UTF-8', 'Windows-1251', $data->val($i, 11, $sheet_index)));
		$name12	= trim(iconv('UTF-8', 'Windows-1251', $data->val($i, 12, $sheet_index)));
		$name13	= trim(iconv('UTF-8', 'Windows-1251', $data->val($i, 13, $sheet_index)));
		$name14	= trim(iconv('UTF-8', 'Windows-1251', $data->val($i, 14, $sheet_index)));
		$name15	= trim(iconv('UTF-8', 'Windows-1251', $data->val($i, 15, $sheet_index)));
		$name16	= trim(iconv('UTF-8', 'Windows-1251', $data->val($i, 16, $sheet_index)));
		$name17	= trim(iconv('UTF-8', 'Windows-1251', $data->val($i, 17, $sheet_index)));
		$name18	= trim(iconv('UTF-8', 'Windows-1251', $data->val($i, 18, $sheet_index)));
		
		$result = mysql_query("SELECT * FROM atxmltv_tvprogs1 ORDER BY id DESC LIMIT 0,1",$con);
		while ($row = mysql_fetch_assoc($result)) {
			$id = $row['id'];
		}
		$id++;
		
		
		$name5 = explode( '-', $name5 );
		//$name5[0] -= 12;
		if( strlen( $name5[0] ) < 2 ) {
			$name5[0] = '0'.$name5[0];
		}
		$name5 = $name5[0].$name5[1]."00";
		$name4 = explode( '/', $name4 );
		$time_start = $name4[2].$name4[0].$name4[1].$name5;
		

		
		
		$name5 = explode( '-', $name7 );
		//print $name5[0];
		//$name5[0] -= 12;
		if( strlen( $name5[0] ) < 2 ) {
			$name5[0] = '0'.$name5[0];
		}
		$name5 = $name5[0].$name5[1]."00";
		$name4 = explode( '/', $name6 );
		$time_end = $name4[2].$name4[0].$name4[1].$name5;
		//print $name17;
		
		$Image_arr = explode( ';', $name17 );
		$Image = '';
		foreach( $Image_arr as $img ) {
			$Image .= '<Image>'.trim($img).'</Image>'."\n";
		}
		//print $Image;
		
		$Actor_arr = explode( ';', $name18 );
		$Actors = '';
		foreach( $Actor_arr as $Act ) {
			$Actors .= '      <actor>'.trim($Act).'</actor>'."\n";
		}
		//print $Image;
		
		
		include 'xml.php';
		print iconv('Windows-1251', 'UTF-8', $xml);
		
		$query = sprintf("INSERT INTO `atxmltv_tvprogs1` (
			`id`,
			`chanid`,
			`disp_name`,
			`prog_id`,
			`prog_start`,
			`prog_stop`,
			`prog_title`,
			`prog_desc`,
			`prog_epis`,
			`prog_director`,
			`prog_comp`,
			`prog_raspect`,
			`prog_children`,
			`prog_country`,
			`prog_date`,
			`prog_img`,
			`prog_act`
		)
		VALUES (
			'%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'
		);",
		mysql_real_escape_string($id),
		mysql_real_escape_string($name),
		mysql_real_escape_string($name2),
		mysql_real_escape_string($name3),
		mysql_real_escape_string($time_start),
		mysql_real_escape_string($time_end),
		mysql_real_escape_string($name8),
		mysql_real_escape_string($name9),
		mysql_real_escape_string($name10),
		mysql_real_escape_string($name11),
		mysql_real_escape_string($name12),
		mysql_real_escape_string($name13),
		mysql_real_escape_string($name14),
		mysql_real_escape_string($name15),
		mysql_real_escape_string($name16),
		mysql_real_escape_string($name17),
		mysql_real_escape_string($name18));
		mysql_query($query,$con) or die(mysql_error());
	}
	print '</tv>';
	unlink($_FILES["file"]["name"]);
} else {
header("Content-Type: text/html; charset=UTF-8");

	print '
<form action="index.php" enctype="multipart/form-data" method="post">
   <p>Загрузите xls файл. В дате используется точка</p>
   <p><input type="file" name="file" accept="application/vnd.ms-excel"></p>
   <p><input type="submit" name="отправить"></p>
</form>
	';
}
?>