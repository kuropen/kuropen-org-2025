<?php

namespace App\Console\Commands;

use App\Models\InquiryType;
use Illuminate\Console\Command;

class InquiryMarkInvitationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inquiry:mark-invitation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mark Invitation Inquiry Type';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $invitationTypes = InquiryType::where('name', 'LIKE', '%招待コード%')
            ->where('invitation', false)
            ->get();

        if ($invitationTypes->isEmpty()) {
            $this->info('No operation needed.');
            return;
        }

        $invitationTypes->each(function ($type) {
            $type->invitation = true;
            $type->save();
        });
        $this->info('Successfully marked invitation inquiry types.');
    }
}
