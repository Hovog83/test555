<?php

namespace App\Http\Controllers\back;

use App\Models\Common\Language;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class LanguageController extends Controller{
    
    public function index () {
        $language = Language::getLanguages(Language::STATUS_ACTIVE);
        return view('back.language.index')->with('language', $language);
    }

    public function edit (Request $request, $id = false) {
        if ($request->isMethod('post') ) {
            if ($request->ajax()) {
                if (!empty($request->language) && $request->code != '' && $request->id != '') {
                    if (Language::saveTranslation($request)) {
                        echo 1;
                        exit;
                    }
                }
                echo 0;
                exit;
            }
            if(!$id){
                $rules = [
                    'language' => 'required',
                ];
                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    return redirect()->back();
                }
                $language = Language::_save($request);
                if ($language) {
                    return redirect('admin/language/');
                }
                return redirect()->back();
            }
            $rules = [
                'id' => 'required|integer',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {

                return redirect()->back()->withErrors($validator->errors())->withInput();
            }
            $language = Language::_save($request);
            if ($language) {
                return redirect('admin/language/');
            }
            return redirect()->back();
        }

        if ($id) {
            $language = Language::find($id);

            $translation = Language::getTranslationByLang($language->code);

            return view('back.language.edit', [
                'language' => $language,
                'translation' => $translation
            ]);
        }

        $language = Language::getLangCodeCountry();

        return view('back.language.add', [
            'language' => $language
        ]);
    }

    public function delete ($id) {
        Language::_delete($id);


        return redirect('admin/language');
    }
}
