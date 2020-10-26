<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class MCase extends Model
{
    use Notifiable;

    protected $table = 'cases';
    protected $fillable = [
        'offender_id',
        'DetectedDate',
        'Type',
        'ItemNumber',
        'Unit',
        'Amount',
        'CaseDescription',
        'Evidence',
        'Status',
        'Location',
        'User_id',
        'Action',
    ];

    //----- relationship to mcase model ----------
    public function offender(){
        return $this->belongsTo('\App\Offender');
    }
}
