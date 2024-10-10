<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InquiryType extends Model
{
    use HasFactory;

    public static function getAvailableRecords()
    {
        return InquiryType::where('valid', true)->get();
    }

    public static function getAvailableNames()
    {
        $records = static::getAvailableRecords();
        return $records->map(function ($record) {
            return $record->name;
        });
    }

    public static function getAvailableIds()
    {
        $records = static::getAvailableRecords();
        return $records->map(function ($record) {
            return $record->id;
        });
    }
}
