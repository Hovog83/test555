<?php

namespace App\Models\common;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model{

    protected $table = 'pages';
	
	public static function rules()
	{
		return [
				'title' => 'required|max:50|min:2',
				'order' => 'required|integer',
				'html'  => 'required|min:10',
		];
	}
	public function sortTable($sort_array) {
        foreach ($sort_array as $key => $sort) {
        	$sort = self::find($sort);
        	$sort->order = $key;
        	$sort->save();
        }
    }
    public static function getPageBySlug($slug){
          return self::where('slug', '=', $slug)->first()->toArray();
    }
}