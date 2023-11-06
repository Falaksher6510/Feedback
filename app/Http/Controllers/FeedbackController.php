<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Vote;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function create()
    {
        return view('feedback.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:255',
        ]);
        

        Feedback::create([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('feedback.create')->with('success', 'Feedback submitted successfully!');
    }

     public function index()
    {
        $feedbacks = Feedback::where('active' , '=' , 1)->get(); 

        
        return view('dashboard', compact('feedbacks')); 
    }

    public function adminindex()
    {
        $feedbacks = Feedback::all(); 

        
        return view('admin.dashboard', compact('feedbacks')); 
    }

    public function vote(Request $request)
    {
       
        $request->validate([
            'feedback_id' => 'required|exists:feedbacks,id',
        ]);

        
        Vote::create([
            'user_id' => Auth::id(),
            'feedback_id' => $request->feedback_id,
            
        ]);



        return response()->json(['message' => 'Feedback voted successfully']);
    }
    public function enablefeedback(Request $request)
    {
       
        $Feedback = Feedback::find($request->feedback_id);

        
        if ($Feedback) {
          
            $Feedback->active = $request->state; 
            $Feedback->save();
            return response()->json(['message' => 'Comment updated successfully']);
        } else {
            return response()->json(['error' => 'Comment not found'], 404);
        }
    }

    public function destroy($id ){

        $Feedback = Feedback::find($id);

        $Feedback->delete();

       return redirect('/admin/dashboard');





    }


}

