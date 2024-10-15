<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MisskeyBatchToken extends Model
{
    use SoftDeletes;
    protected $fillable = ['token', 'is_admin', 'permission'];
}
