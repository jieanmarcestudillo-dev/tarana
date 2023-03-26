<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class completedOperation extends Model
{
    use HasFactory;

    protected $guard = 'completedOperation';

    protected $table = 'completedOperation';
    
    protected $guard_name = 'web';

    protected $primaryKey  = 'completed_id';

    protected $fillable = [
        'operation_id',
        'applicant_id',
        'recruiter_id',
        'certainCode',
        'date_time_complete',
        'updated_at',
        'created_at',
    ];
}
