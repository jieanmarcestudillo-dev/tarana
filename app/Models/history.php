<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class history extends Model
{
    use HasFactory;

    protected $guard = 'historyModel';

    protected $table = 'history';
    
    protected $guard_name = 'web';

    protected $primaryKey  = 'history_id';

    protected $fillable = [
        'content',
        'updated_at',
        'created_at',
    ];
    protected $hidden = [
        'token',
    ];
}
