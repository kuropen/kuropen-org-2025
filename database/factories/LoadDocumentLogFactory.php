<?php

namespace Database\Factories;

use App\Models\LoadDocumentLog;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class LoadDocumentLogFactory extends Factory
{
    protected $model = LoadDocumentLog::class;

    public function definition(): array
    {
        return [
            'run_date' => Carbon::now(),
            'is_success' => $this->faker->boolean(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
