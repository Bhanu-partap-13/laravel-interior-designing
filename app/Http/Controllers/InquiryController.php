<?php

namespace App\Http\Controllers;

use App\Http\Requests\InquiryRequest;
use App\Mail\InquiryMail;
use App\Models\Inquiry;
use App\Models\Project;
use Illuminate\Support\Facades\Mail;

class InquiryController extends Controller
{
    public function store(InquiryRequest $request)
    {
        $data = $request->validated();

        $project = Project::with('designer.user')->findOrFail($data['project_id']);

        if (!$project->is_published) {
            abort(404);
        }

        $inquiry = Inquiry::create([
            'project_id' => $project->id,
            'visitor_name' => $data['visitor_name'],
            'visitor_email' => $data['visitor_email'],
            'message' => $data['message'],
            'status' => 'pending',
        ]);

        $inquiry->load('project');

        $recipient = optional(optional($project->designer)->user)->email
            ?: config('mail.from.address');

        if ($recipient) {
            Mail::to($recipient)->send(new InquiryMail($inquiry));
        }

        return back()->with('status', 'Inquiry sent. The designer will respond soon.');
    }
}
