<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\ClientProfile;
use App\Models\Designer;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function showForm()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $user = DB::transaction(function () use ($data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => $data['role'],
            ]);

            if ($data['role'] === 'designer') {
                Designer::create([
                    'user_id' => $user->id,
                    'slug' => $this->uniqueSlug($data['name']),
                    'specialization' => null,
                    'years_experience' => 0,
                    'is_verified' => false,
                ]);
            }

            if ($data['role'] === 'client') {
                ClientProfile::create([
                    'user_id' => $user->id,
                    'design_type' => $data['design_type'],
                    'budget_range' => $data['budget_range'],
                    'location' => $data['location'],
                    'timeline' => $data['timeline'],
                    'property_size' => $data['property_size'],
                    'style_preference' => $data['style_preference'],
                    'notes' => $data['notes'] ?? null,
                ]);
            }

            return $user;
        });

        return redirect()->route('auth.login')
            ->with('status', __('app.auth.register.success'));
    }

    private function uniqueSlug(string $name): string
    {
        $base = Str::slug($name);
        $slug = $base;
        $counter = 1;

        while (Designer::where('slug', $slug)->exists()) {
            $slug = $base.'-'.$counter;
            $counter++;
        }

        return $slug;
    }
}
