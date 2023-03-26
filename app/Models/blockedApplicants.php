<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class blockedApplicants extends Model
{
    use HasFactory;

    protected $guard = 'blockedApplicants';

    protected $table = 'blockedapplicants';
    
    protected $guard_name = 'web';

    protected $primaryKey  = 'blocked_id';

    protected $fillable = [
        'applicant_id',
        'reason',
        'date_time_blocked',
        'updated_at',
        'created_at',
    ];
   
}
