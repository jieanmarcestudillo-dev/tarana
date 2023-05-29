<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cancelOperation extends Model
{
    use HasFactory;

    protected $guard = 'cancelOperation';

    protected $table = 'cancelOperation';
    
    protected $guard_name = 'web';

    protected $primaryKey  = 'cancelOperation_id';

    protected $fillable = [
        'operation_id',
        'reason',
        'updated_at',
        'created_at',
    ];
}
