<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['code', 'ticket_type_id'];

    public function ticket_types(){
        return $this->belongsToMany(TicketType::class);
    }
}
