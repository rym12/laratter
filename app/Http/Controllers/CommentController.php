<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;
use App\Models\Comment;
use Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $tweetId)
    {
        $request->validate([
        'content' => 'required',
        ]);

        $request->validate([
            'content' => 'required|max:255',
        ]);

        $comment = new Comment();
        $comment->tweet_id = $tweetId;
        $comment->content = $request->input('content');
        $comment->save();

        return redirect()->route('tweet.index', $tweetId)->with('success', 'コメントが投稿されました');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         // ツイートの情報を取得
    $tweet = Tweet::findOrFail($id);

    // ツイートに紐づくコメントを取得
    $comments = $tweet->comments;

    return view('tweet.comment', compact('tweet', 'comments'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function send(Request $request, $id)
    {
        $tweet = Tweet::find($id);
        return response()->view('tweet.send', compact('tweet'));
    }
}
