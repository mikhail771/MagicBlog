<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\Comment\StoreComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(StoreComment $request)
    {
        $comment = Comment::create([
            'text' => $request->get('message'),
            'post_id' => $request->get('post_id'),
            'user_id' => Auth::user()->id,
        ]);
        $comment->save();

        return redirect()->back()->with('status', 'Your comment will be added soon!');

    }
}
