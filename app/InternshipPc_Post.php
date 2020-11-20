<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InternshipPc_Post extends Model
{
    protected $fillable = [
        'co_details','overview','duration','recruitment','position','modeofinterview','workinghours','ctc','bond','company_id','placement_drive_id','stipend','is_posted','is_completed',
    ];

}
