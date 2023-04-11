<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class applied extends Model
{
    use HasFactory;

    protected $guard = 'appliedModel';

    protected $table = 'applied';
    
    protected $guard_name = 'web';

    protected $primaryKey  = 'applied_id';

    protected $fillable = [
        'operation_id',
        'applicants_id',
        'is_recruited',
        'is_recommend',
        'recruiter',
        'date_time_applied',
    ];

}
