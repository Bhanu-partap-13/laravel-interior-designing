<?php

namespace App\Http\Controllers;

use App\Models\ClientProfile;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientDashboardController extends Controller
{
    public function index(Request $request)
    {
        $user   = $request->user();
        $client = $user->clientProfile;

        $featuredProjects = Project::with(['designer.user', 'category'])
            ->where('is_published', true)
            ->latest()
            ->take(3)
            ->get();

        // Real stats for the client
        $totalDesigners  = \App\Models\Designer::count();
        $totalProjects   = Project::where('is_published', true)->count();

        return view('dashboard.client', compact('client', 'featuredProjects', 'totalDesigners', 'totalProjects'));
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'design_type'      => ['nullable', 'string', 'max:120'],
            'budget_range'     => ['nullable', 'string', 'max:60'],
            'location'         => ['nullable', 'string', 'max:120'],
            'timeline'         => ['nullable', 'string', 'max:120'],
            'property_size'    => ['nullable', 'string', 'max:120'],
            'style_preference' => ['nullable', 'string', 'max:120'],
            'notes'            => ['nullable', 'string', 'max:2000'],
            'profile_photo'    => ['nullable', 'image', 'max:4096'],
        ]);

        $user   = $request->user();
        $client = $user->clientProfile;

        if ($request->hasFile('profile_photo')) {
            // Delete old photo if exists
            if ($client && $client->profile_photo && Storage::disk('public')->exists($client->profile_photo)) {
                Storage::disk('public')->delete($client->profile_photo);
            }
            $data['profile_photo'] = $request->file('profile_photo')->store('profiles', 'public');
        }

        if (!$client) {
            ClientProfile::create(array_merge($data, ['user_id' => $user->id]));
        } else {
            $client->update($data);
        }

        return redirect()->route('client.dashboard')
            ->with('status', 'Profile updated successfully.');
    }
}
