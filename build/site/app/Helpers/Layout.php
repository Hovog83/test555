<?php
namespace app\Helpers;

use Illuminate\Http\Request;
use App\Models\Common\MenuPages;
use App\Models\Common\Pages;
use Illuminate\Support\Facades\Auth;
use App\Models\Common\Service;

class Layout{

  public static function getMenuTop(){
  		$pages = new MenuPages;
  		return $pages->getMenu();
  }
 
  public static function getUserAuth(){
	 	$user = Auth::user();
	 		return $user;
  }
  public static function getServiceRondom($limit = 1){
  	return Service::all()->random($limit)->toArray();
  }

}