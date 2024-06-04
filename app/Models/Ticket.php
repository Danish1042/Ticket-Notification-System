<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_has_tickets', 'ticket_id', 'user_id');
    }

    public function getStatus(){
        return $this->status == 1 ? 'Complete' : 'Pending';
    }
}
