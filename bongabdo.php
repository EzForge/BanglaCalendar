<?php 
date_default_timezone_set('UTC');

class bongabdo{

	public $timestamp = null;
	protected $instance = null;
	public $datestring = null;
	public $datearray = array();
	
	public function initial(){
		if($this->timestamp===null){
			$this->timestamp = date('Y-m-d G:h:s');
		}
		if($this->instance===null){
			$this->instance = new bongabdo();
		}		
		return $this->instance;	
	}
 
	public function bongabdo() {

		$engDate  = date( 'd', strtotime($this->timestamp) );
		$engMonth  = date( 'm', strtotime($this->timestamp) );
		$engYear = date( 'Y', strtotime($this->timestamp) );		
		$engHour = date( 'G', strtotime($this->timestamp) );
		
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
			if ($this->is_leapyear($engYear) && $lipyearindex == $engMonth) 
				$bangDate += 1;
			$bangMonth = $bn_months[$engMonth - 1];
		}
		else{
			$bangMonth = $bn_months[($engMonth)%12];		
		}

		$bangYear = $engYear - 593;
		if (($engMonth < 4) || (($engMonth == 4) && (($engDate < 14) || ($engDate == 14 && $engHour < $morning))))
			$bangYear -= 1;
 
		$this->datestring = $bangDate . ' ' . $bangMonth . ' ' . $bangYear;
		$this->datearray = array(
			'date'=> $bangDate,
			'month'=> $bangMonth,
			'year'=>  $bangYear
		);
 
		return $this->initial();
 	
	}
	
	public function calender(){ return "বঙ্গাব্দ"; }
	public function months_to_bn($content=''){
		$oldmonths = array( 'Boishakh', 'Joishtho', 'Ashar', 'Srabon', 'Bhadro', 'Ashin', 'Kartrik', 'Agrohayon', 'Poush', 'Magh', 'Falgun', 'Chaitro' );
		$newmonths = array("বৈশাখ", "জ্যৈষ্ঠ", "আষাঢ়", "শ্রাবণ", "ভাদ্র", "আশ্বিন", "কার্তিক", "অগ্রহায়ণ", "পৌষ", "মাঘ", "ফাল্গুন", "চৈত্র");
		$newcontent = str_replace($oldmonths, $newmonths, $content);
		return $newcontent;
	}
	public function day_to_bn($content=''){
		$olddays = array( 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday' );
		$newdays = array("রবিবার", "সোমবার", "মঙ্গলবার", "বুধবার", "বৃহষ্পতিবার", "শুক্রবার", "শনিবার"); 
		$newcontent = str_replace($olddays, $newdays, $content);
		return $newcontent;
	}

	public function season_to_bn($content=''){
		$oldseasons = array( 'Summer', 'Monsoon', 'Autumn', 'Late Autumn', 'Winter', 'Spring' );
		$newseasons = array("গ্রীষ্ম ", "বর্ষা", "শরৎ", "হেমন্ত", "শীত", "বসন্ত"); 
		$newcontent = str_replace($oldseasons, $newseasons, $content);
		return $newcontent;
	}

	 

	public function digits_to_bn($content=''){
		$olddigits = array( '0', '1', '2', '3', '4', '5', '6', '7', '8', '9' );
		$newdigits = array( '০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯' );
		$newcontent = str_replace($olddigits, $newdigits, $content);
		return $newcontent;
	}

	private function is_leapyear($year) {
		if ( $year % 400 == 0 || ($year % 100 != 0 && $year % 4 == 0) )
			return true;
		else
			return false;
	}	

 



}
