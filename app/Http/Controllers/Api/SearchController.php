<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Vacancy;
class SearchController extends Controller
{

    public function search(Request $request)
    {

        $error = ['error' => 'No results found, please try with different keywords.'];

        if($request->has('q')) {

            $posts = Vacancy::where('vacancy', 'like' ,'%'.$request->get('q').'%')->get();

            return $posts->count() ? $posts : $error;

        }

        return $error;
    }
}
