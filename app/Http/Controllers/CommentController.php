<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{
   
public function create($id)
    {
        $feedbackWithComments = Feedback::with('comments')->find($id);
        return view('comment.create',compact('feedbackWithComments'));
    }
public function feedbackview($id)
    {
        $feedbackWithComments = Feedback::with('comments')->find($id);
        return view('admin.comment.view',compact('feedbackWithComments'));
    }
    public function enablecomment(Request $request)
    {
        
        $comment = Comment::find($request->CommentId);

        
        if ($comment) {
          
            $comment->active = $request->state; 
            $comment->save();
            return response()->json(['message' => 'Comment updated successfully']);
        } else {
            return response()->json(['error' => 'Comment not found'], 404);
        }
    }

public function Comment(Request $request)
    {
      
      Comment::create([
            'comment' => $request->comment,
            'feedback_id' => $request->feedback_id,
            'user_id' => Auth::id(),
        ]);
       return response()->json(['message' => 'Feedback submitted successfully!']);

    }
}
