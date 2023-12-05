<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
        ]);

        Feedback::create([
            'user_id' => auth()->id(),
            'content' => $request->input('content'),
        ]);

        return redirect()->back();
    }
    public function showAllFeedback()
    {
    // 检查用户是否有权限查看所有反馈
    if (Gate::allows('viewAny', Feedback::class)) {
        $feedbackList = Feedback::all();
    } else {
        // 如果没有权限，只获取当前用户的反馈
        $feedbackList = Feedback::where('user_id', auth()->id())->get();
    }

    return view('feedback.feedback', ['feedback' => $feedbackList]);
}
public function showAllFeedbackForAdmin()
{
    $feedbackList = Feedback::with('user')->get();
        return view('feedback.all', ['feedback' => $feedbackList]);
}
}