<?php
date_default_timezone_set('UTC');
 
 
function bongabdo($timestamp=null) {
	if($timestamp===null){
		$timestamp = date('Y-m-d G:h:s');
	}
	$engDate  = date( 'd', strtotime($timestamp) );
	$engMonth  = date( 'm', strtotime($timestamp) );
	$engYear = date( 'Y', strtotime($timestamp) );		
	$engHour = date( 'G', strtotime($timestamp) );
	
	$bn_months = array('Poush', 'Magh', 'Falgun', 'Chaitro', 'Boishakh', 'Joishtho', 'Ashar', 'Srabon', 'Bhadro', 'Ashin', 'Kartrik', 'Agrohayon');
	$bn_month_dates = array(30,30,30,30,31,31,31,31,31,30,30,30);
	$bn_month_middate = array(13,12,14,13,14,14,15,15,15,15,14,14);	
	$lipyearindex = 3;
	$morning = 6;

	$bangDate = $engDate - $bn_month_middate[$engMonth - 1];
	if ($engHour < $morning) 
		$bangDate -= 1;
	
	if (($engDate <= $bn_month_middate[$engMonth - 1]) || ($engDate == $bn_month_middate[$engMonth - 1] + 1 && $engHour < $morning) ) {
		$bangDate += $bn_month_dates[$engMonth - 1];
		if (is_leapyear($engYear) && $lipyearindex == $engMonth) 
			$bangDate += 1;
		$bangMonth = $bn_months[$engMonth - 1];
	}
	else{
		$bangMonth = $bn_months[($engMonth)%12];		
	}

	$bangYear = $engYear - 593;
	if (($engMonth < 4) || (($engMonth == 4) && (($engDate < 14) || ($engDate == 14 && $engHour < $morning))))
		$bangYear -= 1;
	
	return array($bangDate, $bangMonth, $bangYear);
}
function calender(){ return "বঙ্গাব্দ"; }
function months_to_bn($content=''){
	$oldmonths = array( 'Boishakh', 'Joishtho', 'Ashar', 'Srabon', 'Bhadro', 'Ashin', 'Kartrik', 'Agrohayon', 'Poush', 'Magh', 'Falgun', 'Chaitro' );
	$newmonths = array("বৈশাখ", "জ্যৈষ্ঠ", "আষাঢ়", "শ্রাবণ", "ভাদ্র", "আশ্বিন", "কার্তিক", "অগ্রহায়ণ", "পৌষ", "মাঘ", "ফাল্গুন", "চৈত্র");
	$newcontent = str_replace($oldmonths, $newmonths, $content);
	return $newcontent;
}
function day_to_bn($content=''){
	$olddays = array( 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday' );
	$newdays = array("রবিবার", "সোমবার", "মঙ্গলবার", "বুধবার", "বৃহষ্পতিবার", "শুক্রবার", "শনিবার"); 
	$newcontent = str_replace($olddays, $newdays, $content);
	return $newcontent;
}

function digits_to_bn($content=''){
	$olddigits = array( '0', '1', '2', '3', '4', '5', '6', '7', '8', '9' );
	$newdigits = array( '০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯' );
	$newcontent = str_replace($olddigits, $newdigits, $content);
	return $newcontent;
}

function is_leapyear($year) {
	if ( $year % 400 == 0 || ($year % 100 != 0 && $year % 4 == 0) )
		return true;
	else
		return false;
}
 
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Bangla Date Time Calendar</title>	
	</head>
<body>
<?php 


$date = bongabdo();
$b_date = digits_to_bn($date);
$bangla_date = months_to_bn($b_date);
$cal = calender();
echo $bangla_date[0] . ' ' . $bangla_date[1]. ' ' . $bangla_date[2] . ' ' . $cal;

?>
</body>
</html>
