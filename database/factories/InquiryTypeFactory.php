<?php
/*
 * SPDX-FileCopyrightText: 2024 Kuropen <webmaster@kuropen.org>
 * SPDX-License-Identifier: LicenseRef-KUROPEN-ORG-PUBLIC-CODE
 */

namespace Database\Factories;

use App\Models\InquiryType;
use Illuminate\Database\Eloquent\Factories\Factory;

class InquiryTypeFactory extends Factory
{
    protected $model = InquiryType::class;

    public function definition(): array
    {
        return [
            'type' => fake()->title(),
            'description' => fake()->text(),
            'valid' => fake()->boolean(),
            'misskey_related' => fake()->boolean(),
            'created_at' => fake()->dateTime(),
            'updated_at' => fake()->dateTime(),
        ];
    }
}
