<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class completed extends Model
{
    use HasFactory;

    protected $guard = 'completed';

    protected $table = 'completed';
    
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
