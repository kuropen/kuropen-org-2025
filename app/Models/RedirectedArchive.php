<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static $this where(string $string, string $slug)
 * @method firstOrFail(string|array $columns = ['*'])
 */
class RedirectedArchive extends Model
{
    use HasFactory;
}
