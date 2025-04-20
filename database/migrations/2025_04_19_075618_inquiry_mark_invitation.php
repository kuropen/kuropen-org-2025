<?php

use App\Models\InquiryType;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void
    {
        $invitationTypes = InquiryType::where('name', 'LIKE', '%招待コード%')
            ->where('invitation', false)
            ->get();
        $invitationTypes->each(function ($type) {
            $type->invitation = true;
            $type->save();
        });
    }
};
