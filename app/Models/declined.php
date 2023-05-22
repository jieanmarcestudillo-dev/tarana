<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class declined extends Model
{
    use HasFactory;

    protected $guard = 'declinedModel';

    protected $table = 'declined';
    
    protected $guard_name = 'web';

    protected $primaryKey  = 'declined_id';

    protected $fillable = [
        'operation_id',
        'applicant_id',
        'recruiter_id',
        'reason',
        'date_time_declined',
        'is_archived',
    ];
}
