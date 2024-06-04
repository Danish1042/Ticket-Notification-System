<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_has_ticket extends Model
{
    use HasFactory;

    protected $table = 'user_has_tickets';
    protected $fillable = ['user_id', 'ticket_id'];
}
