<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class backout extends Model
{
    use HasFactory;

    protected $guard = 'backOutModel';

    protected $table = 'backout';
    
    protected $guard_name = 'web';

    protected $primaryKey  = 'backOut_id';

    protected $fillable = [
        'operation_id',
        'applicant_id',
        'reason',
        'date_time_backOut',
    ];
}
