<?php

namespace App\Managers;


use App\Models\Setting;
use App\Models\AcademicYear;

class CommonDataManager
{


	public function linkTypeDropdown(){
		return ['header'=>'header','footer'=>'footer','body'=>'body'];
	}

	public function genderDropdown(){
		return [null=>'--छानुहोस--','Male'=>'पुरुष','Female'=>'महिला','Other'=>'अन्य'];
	}

	public function degreeStatusDropdown(){
		return [null=>'--select--','Running'=>'Running','Completed'=>'Completed'];
	}

	public function statusDropdown(){
		return [null=>'--select--',1=>'Active', 0 =>'Inactive'];
	}

	public function yesNoDropdown(){
		return [null=>'--चयन गर्नुहोस--',1=>'हो', 0 =>'होइन'];
	}


	public function publishStatusDropdown(){
		return [null=>'--चयन गर्नुहोस--',1 =>'प्रकाशन',0=>'ड्राफ्ट'];
	}

	public function galleryTypeDropdown(){
		return [
			null => '--Select--',
			'image' => 'Image',
			'video' => 'Video'
		];
	}

	public function socialSiteTypeDropdown(){
		return [
			null => '--Select--',
			'facebook-page' => 'Facebook Page',
			'twitter-handle' => 'Twitter Handle',
			'google-map' => 'Google Map',
		];
	}

}
