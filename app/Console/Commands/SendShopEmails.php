<?php

namespace App\Console\Commands;

use App\Mail\ExpireNotification;
use App\Models\Shop; // Assuming you have a Shop model
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendShopEmails extends Command
{
    protected $signature = 'shops:send-emails';
    protected $description = 'Send scheduled emails to shops';

    public function handle()
    {
        $shops = Shop::whereNotNull('email')->get();

        if ($shops->isEmpty()) {
            $this->info('No shops found with valid email addresses');
            return;
        }

        $data = [
            "subject" => "Shop Request",
            "message" => "Your expire date is in 3 days",
        ];

        try {
            foreach ($shops as $shop) {
                Mail::to($shop->email)->queue(new ExpireNotification($data));
                $this->line("Queued email for: {$shop->email}");
            }
            $this->info('Shop emails have been queued successfully!');
        } catch (\Exception $e) {
            $this->error('Error sending emails: ' . $e->getMessage());
        }
    }
}
