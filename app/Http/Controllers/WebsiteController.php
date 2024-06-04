<?php

namespace App\Http\Controllers;

use App\Mail\TicketPurchased;
use App\Models\Ticket;
use App\Models\User_has_ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class WebsiteController extends Controller
{
    public function index(){
        $tickets = Ticket::with('users')->get();

        if(auth()->user()){
            $userTickets = auth()->user()->tickets->pluck('id')->toArray();
            return view('website.index', compact('tickets', 'userTickets'));
        }

        return view('website.index', compact('tickets'));
    }

    public function tickets_buy(Request $request){
        if (Auth::check()) {
            // User is authenticated
            $ticketId = $request->input('ticket_id');

            $ticket = Ticket::find($ticketId);
            // dd($ticket->title);
            return response()->json([
                'authenticated' => true,
                'modalContent' => $ticket,
            ]);
        } else {
            // User is not authenticated
            return response()->json([
                'authenticated' => false,
            ]);
        }
    }

    public function my_tickets(){
        $tickets = auth()->user()->tickets;

        return view('website.my-tickets', compact('tickets'));
    }

    public function book_me(Request $request){

        $user = Auth::user();

        $ticketStore = User_has_ticket::create([
            'user_id' => $user->id,
            'ticket_id' => $request->ticket_id,
        ]);

        $expityDate = Carbon::parse($request->expiry);

        $details = [

            'title' => 'Ticket Purchased: ' . $request->title,

            'body' => 'Dear Sir/Madam! ' . $user->name . '<br>' . 'You ticket has been Booked! Your Due date is: ' . $expityDate . '<br>'. 'Ticket Details: ' . $request->description
        ];

        // Send the email
        Mail::to($user->email)->send(new TicketPurchased($details));

        return redirect()->route('my-tickets')->with('success', 'Ticket purchased successfully!');
        // php artisan notify:notify
        // php artisan queue:work
    }

    public function distroy_tickets($id){

        DB::table('user_has_tickets')->where('ticket_id', $id)->delete();

        return response()->json(['success' => true]);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->back();
    }
}
