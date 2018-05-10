<?php

namespace App\Models\common;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model{

    protected $table = 'subcategories';
	
	public static function rules()
	{
		return [
				'name'   => 'required|max:50|min:2',
				'icone'  => 'required|max:30',
				'cat_id'  => 'required|integer',
				'order'  => 'required|integer',
				'status' => 'required',
		];
	}

	public static function getSubcategoryByCatIdForService($id){
		$scat = [];
        $subcategory = self::where('status', '=', "ACTIVE")->where('cat_id', '=', $id)->select('id', 'name')->get();
         foreach ($subcategory->toArray() as $key => $value) {
                $scat[$value["id"]] = $value["name"];
        }
        return $scat;
	}
	public function sortTable($sort_array) {
        foreach ($sort_array as $key => $sort) {
        	$sort = self::find($sort);
        	$sort->order = $key;
        	$sort->save();
        }
    }
}