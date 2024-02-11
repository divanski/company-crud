<?php

namespace Database\Seeders;
use App\Models\Company;
use App\Models\Group;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Group::truncate();
        Company::truncate();
        Schema::enableForeignKeyConstraints();

        // Populate Group
        Group::create([
            'name' => 'Best client'
        ]);
        Group::create([
            'name' => 'Partners'
        ]);
        Group::create([
            'name' => 'Competition'
        ]);
        Group::create([
            'name' => 'Costumers'
        ]);

        // Populate Company
        Company::factory()->count(20)->create();

        // Get all the roles attaching up to 2 random roles to each user
        $groupCount= Group::all();

        // Populate the pivot table
        Company::all()->each(function ($company) use ($groupCount) {
            $company->groups()->attach(
                Group::all()->random(rand(1, 2))->pluck('id')->toArray()
            );
        });
    }
}
