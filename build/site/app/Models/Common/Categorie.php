<?php

namespace App\Models\common;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model{

    protected $table = 'categorie';
	
	public static function rules()
	{
		return [
				'name'   => 'required|max:50|min:2',
				'icone'  => 'required|max:30',
				'order'  => 'required|integer',
				'status' => 'required',
		];
	}
	public function sortTable($sort_array) {
        foreach ($sort_array as $key => $sort) {
        	$sort = self::find($sort);
        	$sort->order = $key;
        	$sort->save();
        }
    }
    public function getCategorieByActiv(){
      return self::with('getSub')->orderBy('order')->where('status', '=', "ACTIVE")->get();
    }    
    public function getCategorieByService(){
      return self::with('getService')->orderBy('order')->where('status', '=', "ACTIVE")->get();
    }
    public function getSub(){
        return $this->hasMany('App\Models\Common\Subcategory', 'cat_id', 'id');
    }
    public function getService(){
        return $this->hasMany('App\Models\Common\Service', 'cat_id', 'id');
    }
}