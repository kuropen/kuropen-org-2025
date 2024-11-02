<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoadDocumentLog extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'run_date' => 'datetime',
            'is_success' => 'boolean',
        ];
    }
}
