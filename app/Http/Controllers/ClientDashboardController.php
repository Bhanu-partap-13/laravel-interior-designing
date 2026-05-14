<?php

namespace App\Http\Controllers;

use App\Models\ClientProfile;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ClientDashboardController extends Controller
{
    public function index(Request $request)
    {
        $client = $request->user()->clientProfile;
        $featuredProjects = Project::with(['designer.user', 'category'])
            ->where('is_published', true)
            ->latest()
            ->take(3)
            ->get();

        return view('dashboard.client', compact('client', 'featuredProjects'));
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'design_type' => ['nullable', 'string', 'max:120'],
            'budget_range' => ['nullable', 'string', 'max:60'],
            'location' => ['nullable', 'string', 'max:120'],
            'timeline' => ['nullable', 'string', 'max:120'],
            'property_size' => ['nullable', 'string', 'max:120'],
            'style_preference' => ['nullable', 'string', 'max:120'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);

        $user = $request->user();
        $client = $user->clientProfile;

        if (!$client) {
            ClientProfile::create(array_merge($data, ['user_id' => $user->id]));
        } else {
            $client->update($data);
        }

        return redirect()->route('client.dashboard')
            ->with('status', 'Profile updated.');
    }
}
