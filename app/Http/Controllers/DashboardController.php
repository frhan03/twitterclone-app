<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Idea;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        //check if there is a search
        //if have, check the value in the DB



        $ideas = Idea::orderBy('created_at','DESC');

        if (request()->has('search')) {

            $ideas = $ideas->where('content','like','%'.request()->get('search',''). '%');
        }

        return view('dashboard',[
            'ideas'=> $ideas->paginate(5),
        ]);

    }
}
