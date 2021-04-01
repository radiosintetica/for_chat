<?
$xml = '
 
  <programme start="'.$time_start.'" stop="'.$time_end.'" channel="'.$name.'" id="'.$name3.'">
    <title lang="ru">'.$name8.'</title>
    <desc lang="ru">
       '.$name9.'
    </desc>
    <credits>
      <director>'.$name11.'</director>
'.$Actors.'
    </credits>
    <date>'.$name16.'</date>
    <country>'.$name15.'</country>
    <Company>'.$name12.'</Company>
    <episode-num system="xmltv_ns">'.$name10.'</episode-num>
    <video>
      <aspect>'.$name13.'</aspect>
    </video>
    <Gallery>
'.$Image.'
    </Gallery>
    <rating system="MPAA">';
	if( $name14 != '' ) {
$xml .= '<value>'.$name14.'</value>
      <icon src="'.$name14.'.png" />
	  ';
	 }
$xml .= '
    </rating>
  </programme>
';
?>