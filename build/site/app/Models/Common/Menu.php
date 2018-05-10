<?php

namespace App\Models\common;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model{

    protected $table = 'menu';
	
	public static function rules()
	{
		return [
				'name'   => 'required|max:50|min:2',
		];
	}

	// public function sortTable($sort_array) {
 //        foreach ($sort_array as $key => $sort) {
 //        	$sort = self::find($sort);
 //        	$sort->order = $key;
 //        	$sort->save();
 //        }
 //    }
}