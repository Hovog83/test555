<?php

namespace App\Http\Controllers\back;

use Illuminate\Http\Request;
use App\Models\Common\Categorie;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

class IndexController extends Controller{
    public function index(){
        return view('back.index.index');
    }
    public function getIndex()
    {
        return view('back.index.index');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
        return Datatables::of(Categorie::select('*'))->make(true);
    }

}
