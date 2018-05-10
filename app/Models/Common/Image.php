<?php

namespace App\Models\common;

use Illuminate\Database\Eloquent\Model;

class Image extends Model{

    protected $table = 'service_images';
	
	public function setTable($tableName)
	{
		$this->table = $tableName;
        
	}
	public function sortImages($images) {
        foreach ($images as $key => $img) {
        	$imgSor = self::find($img);
        	$imgSor->order = $key;
        	$imgSor->save();
        }
    }

    public function setMainImages($id,$services) {
    	$imgMain =  self::where('service_id',"=",$services)->where('mine',"=",1)->first();
    	if(!empty($imgMain)){
    		$imgMain->mine = 0;
    		$imgMain->save();
    	}
        $imgMainNew = self::find($id);
    	$imgMainNew->mine = 1;
    	$imgMainNew->save();
    }
}