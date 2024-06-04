<?php

namespace App\Console\Commands;

use App\Mail\TicketReminderNotification;
use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendTicketReminderNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'app:send-ticket-reminder-notification';
    protected $signature = 'notify:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send ticket notifications to users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::with('tickets')->get();
        // dd(count($users));
        foreach ($users as $user) {
            foreach ($user->tickets as $ticket) {
                $expiryDate = Carbon::parse($ticket->expiry);
                $today = Carbon::now();

                if ($expiryDate->isTomorrow()) {
                    // Send 3 emails on the day before the expiry
                    $messageContent = "Your ticket expires tomorrow. Please take necessary actions.";
                    $this->sendMultipleEmails($user, $ticket, $messageContent);
                } else if ($expiryDate->isFuture() && $expiryDate->diffInDays($today) <= 1) {
                    // Send one email per day until the expiry date
                    $messageContent = "Your ticket will expire on " . $ticket->expiry . ". Please take necessary actions.";
                    Mail::to($user->email)->send(new TicketReminderNotification($user, $ticket, $messageContent));
                }
            }
        }
    }

    protected function sendMultipleEmails($user, $ticket, $messageContent)
    {
        $morning = Carbon::now()->startOfDay()->addHours(9);
        $afternoon = Carbon::now()->startOfDay()->addHours(15);
        $night = Carbon::now()->startOfDay()->addHours(21);

        Mail::to($user->email)->later($morning, new TicketReminderNotification($user, $ticket, $messageContent));
        Mail::to($user->email)->later($afternoon, new TicketReminderNotification($user, $ticket, $messageContent));
        Mail::to($user->email)->later($night, new TicketReminderNotification($user, $ticket, $messageContent));
    }
}
