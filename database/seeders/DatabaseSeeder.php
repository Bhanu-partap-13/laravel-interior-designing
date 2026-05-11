<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Designer;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Living Room',
                'slug' => 'living-room',
                'description' => 'Gathering spaces designed for calm routines and layered light.',
            ],
            [
                'name' => 'Kitchen',
                'slug' => 'kitchen',
                'description' => 'Chef-friendly layouts, natural materials, and warm textures.',
            ],
            [
                'name' => 'Bedroom',
                'slug' => 'bedroom',
                'description' => 'Private retreats with soft palettes and tailored storage.',
            ],
            [
                'name' => 'Office',
                'slug' => 'office',
                'description' => 'Focused workspaces with acoustic control and flexible zones.',
            ],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(['slug' => $category['slug']], $category);
        }

        $primaryUser = User::factory()->create([
            'name' => 'Ariadne Studio',
            'email' => 'designer@example.com',
            'password' => Hash::make('password'),
            'role' => 'designer',
        ]);

        $secondaryUser = User::factory()->create([
            'name' => 'Lumen Atelier',
            'email' => 'lumen@example.com',
            'password' => Hash::make('password'),
            'role' => 'designer',
        ]);

        $primaryDesigner = Designer::create([
            'user_id' => $primaryUser->id,
            'slug' => Str::slug($primaryUser->name),
            'bio' => 'Residential interiors shaped by natural light and crafted materials.',
            'specialization' => 'Residential',
            'city' => 'Kyoto, JP',
            'phone' => '+81 90 1234 5678',
            'portfolio_url' => 'https://interiorcanvas.test/ariadne',
            'years_experience' => 9,
            'is_verified' => true,
        ]);

        $secondaryDesigner = Designer::create([
            'user_id' => $secondaryUser->id,
            'slug' => Str::slug($secondaryUser->name),
            'bio' => 'Minimal studios focused on calm material palettes and light flow.',
            'specialization' => 'Minimal',
            'city' => 'Copenhagen, DK',
            'phone' => '+45 12 34 56 78',
            'portfolio_url' => 'https://interiorcanvas.test/lumen',
            'years_experience' => 12,
            'is_verified' => true,
        ]);

        $livingRoom = Category::where('slug', 'living-room')->first();
        $kitchen = Category::where('slug', 'kitchen')->first();
        $bedroom = Category::where('slug', 'bedroom')->first();
        $office = Category::where('slug', 'office')->first();

        Project::create([
            'designer_id' => $primaryDesigner->id,
            'category_id' => $livingRoom->id,
            'title' => 'Sunlit loft for a writer',
            'slug' => 'sunlit-loft-for-a-writer',
            'description' => 'Muted textures, paper lantern light, and bespoke shelving.',
            'budget_range' => 'Mid',
            'duration_days' => 56,
            'style_tags' => ['minimal', 'warm'],
            'is_published' => true,
        ]);

        Project::create([
            'designer_id' => $primaryDesigner->id,
            'category_id' => $bedroom->id,
            'title' => 'Soft minimal townhouse',
            'slug' => 'soft-minimal-townhouse',
            'description' => 'Soft layers of linen, oak, and matte plaster.',
            'budget_range' => 'Mid',
            'duration_days' => 70,
            'style_tags' => ['soft', 'minimal'],
            'is_published' => true,
        ]);

        Project::create([
            'designer_id' => $secondaryDesigner->id,
            'category_id' => $kitchen->id,
            'title' => 'Coastal kitchen reset',
            'slug' => 'coastal-kitchen-reset',
            'description' => 'Salt washed oak and stone surfaces for communal cooking.',
            'budget_range' => 'High',
            'duration_days' => 84,
            'style_tags' => ['coastal', 'warm'],
            'is_published' => true,
        ]);

        Project::create([
            'designer_id' => $secondaryDesigner->id,
            'category_id' => $office->id,
            'title' => 'Studio with garden light',
            'slug' => 'studio-with-garden-light',
            'description' => 'Gallery lighting and adaptable work zones for hybrid teams.',
            'budget_range' => 'Mid',
            'duration_days' => 42,
            'style_tags' => ['studio', 'light'],
            'is_published' => true,
        ]);
    }
}
