<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:send-billing-reminders')]
#[Description('Send automatic reminders to tenants 3 days before due date')]
class SendBillingReminders extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $targetDate = now()->addDays(3)->toDateString();

        $bills = \App\Models\Bill::where('status', 'unpaid')
            ->whereDate('due_date', $targetDate)
            ->with('lease.user')
            ->get();

        foreach ($bills as $bill) {
            $user = $bill->lease->user;
            // Mocking the email/WA send
            \Illuminate\Support\Facades\Log::info("Reminder sent to {$user->email} for Bill ID {$bill->id} due on {$bill->due_date}");
        }

        $this->info(count($bills) . ' reminders sent.');
    }
}
