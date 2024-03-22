<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function show(Idea $idea){


        return view('ideas.show',compact('idea'));

    }

    public function store()
    {
        $validate = request()->validate([
            'content' => 'required|min:3|max:240',
        ]);

        //validation
        $validate['user_id'] = auth()->id();

        Idea::create($validate);

        return redirect()->route('dashboard')->with('success','Idea created successfully');

    }

    public function destroy(Idea $idea){

        if(auth()->id() !== $idea->user_id){

            abort(404);
        }

        $idea->delete();

        return redirect()->route('dashboard')->with('success','Idea deleted successfully');
    }

    public function edit(Idea $idea){

        if(auth()->id() !== $idea->user_id){

            abort(404);
        }

        $editing = true;
        return view('ideas.show',compact('idea','editing'));

    }

    public function update(Idea $idea){

        if(auth()->id() !== $idea->user_id){

            abort(404);
        }

        $validate = request()->validate([
            'content' => 'required|min:3|max:240',
        ]);

        $idea->update($validate);

        return redirect()->route('ideas.show',$idea->id)->with('success',"Idea updates successfully");

    }
}
