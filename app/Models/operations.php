<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class operations extends Model
{
    use HasFactory;

    protected $guard = 'operationModel';

    protected $table = 'operations';
    
    protected $guard_name = 'web';

    protected $primaryKey  = 'certainOperation_id';

    protected $fillable = [
        'operationId',
        'photos',
        'shipName',
        'shipCarry',
        'operationStart',
        'operationEnd',
        'totalWorkers',
        'slot',
        'foreman',
        'status',
        'is_completed',
    ];

    public function applicants(){
        return $this->belongsToMany(applicants::class, 'applied', 'operation_id', 'applicants_id')->withPivot('is_recruited', 'is_recommend');
    }

    public function employees(){
        return $this->belongsTo(employees::class, 'foreman', 'employee_id');
    }
    
}
