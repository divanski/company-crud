<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Company;
use App\Models\Group;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testCreateCompany()
    {
        // Test creating a new company
        $response = $this->postJson('/companies', [
            'name' => 'Test Company',
            'owner_first_name' => 'Federico',
            'owner_last_name' => 'Gagliardi',
            'phone' => '+93776466525',
            'address'=> 'Via Colegio 54',
            'city' => 'Torino',
            'country'=> 'Italy'
        ]);

        $response->assertStatus(200); // Check if the company was created successfully
        $this->assertDatabaseHas('companies', ['name' => 'Test Company']); // Check if the company exists in the database
    }
}
