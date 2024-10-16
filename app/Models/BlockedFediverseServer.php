<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockedFediverseServer extends Model
{
    use HasFactory;
    protected $fillable = ['hostname', 'blocked_at', 'repealed_at'];
}
