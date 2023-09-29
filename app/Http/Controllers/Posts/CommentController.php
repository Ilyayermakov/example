<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CommentController extends Controller
{
    public function createComment(Request $request)
    {
        $validated = $request->validate([
            'content' => ['required', 'string'],
            'file' => ['nullable', 'array'],
            'file.*' => ['nullable', 'mimes:jpeg,png,jpg,gif,pdf', 'max:5000'],
        ]);

        $post_id = $request->route('post_id');

        $comment = new Comment([
            'user_id' => auth()->user()->id,
            'post_id' => $post_id,
            'content' => $validated['content'],
        ]);

        $comment->save();

        if ($request->hasFile('file')) {
            $filePaths = [];
            foreach ($request->file('file') as $file) {
                $filePath = $file->store('user_' . auth()->user()->id, 'files');
                $filePaths[] = $filePath;
            }
            $comment->file = $filePaths;
            $comment->save();
        }

        logActivity("Новая запись в Комментариях от " . $comment->user_id . " на " . $comment->post_id);

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($post, $comment)
    {
        return 'Изменить комментарий {$comment} (пост {$id})';
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteComment(Request $request)
    {
        $commentId = $request->input('comment_id');
        $comment = Comment::find($commentId);

        if ($comment) {
            $files = json_decode($comment->file, true);
            if (is_array($files)) {
                foreach ($files as $filePath) {
                    $filePath = public_path('files/' . $filePath);
                    if (File::exists($filePath)) {
                        File::delete($filePath);
                    }
                }
            }

            $comment->delete();

            logActivity("Удаление комментария пользователя $comment->user_id из поста $comment->post_id , сам комментарий: $comment->content");

            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }
}
