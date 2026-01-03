<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Models\Request as ServiceRequest;
use App\Models\User;
use App\Notifications\NewFeedbackNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class FeedbackController extends Controller implements HasMiddleware
{
     public static function middleware(): array
    {
        return[
            new Middleware('permission:view feedbacks', only: ['index']),
        ];
    }
    public function index()
    {
        $feedbacks = feedback::with('user')
            ->where('company_id', auth()->user()->company_id)
            ->latest()->paginate(5);

        return view('panel.reviews-and-ratings.index', [
            'feedbacks' => $feedbacks,
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'request_id' => 'required|exists:requests,id',
            'comment' => 'required|string|max:500',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $serviceRequest = ServiceRequest::findOrFail($request->request_id);

        Feedback::create([
            'request_id' => $serviceRequest->id,
            'user_id' => Auth::id(),
            'company_id' => $serviceRequest->company_id, 
            'comment' => $request->comment,
            'rating' => $request->rating,
        ]);
        
        $companyUsers = User::where('company_id', $serviceRequest->company_id)->get();

        foreach ($companyUsers as $companyUser) {
                    $companyUser->notify(new NewFeedbackNotification($serviceRequest, auth()->user()));
                }
        return redirect()->route('my-requests.index')->with('success', 'Service Request created successfully!');
        return redirect()->back()->with('success', 'Feedback submitted successfully!');
    }
    public function showFeedbacks($id)
    {
        $company = Company::findOrFail($id);
        
        $feedbacks = Feedback::where('company_id', $id)->latest()->get();

        return view('request-form.service.feedback', compact('company', 'feedbacks'));
    }

}
