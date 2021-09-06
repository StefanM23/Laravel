<?php

namespace App\Http\Controllers;

use App\Product;
use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $comment = Comment::all();

        if($request->ajax()){
            return response()->json($comment->toArray());
        }
        return view('comment', [
            'comment' => $comment->toArray(),
        ]);
    }

    public function update(Request $request, $id)
    {
        Comment::find($id)->update([
            'accepted' => true,
        ]);
        if ($request->ajax()) {
            return response()->json([], 204);
        }

        return redirect()->route('comment.index');
    }
    public function destroy(Request $request, $id)
    {
       
        Comment::find($id)->delete();

        if ($request->ajax()) {
            return response()->json([], 204);
        }

        return redirect()->route('comment.index');
    }
}
