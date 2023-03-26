<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class employees extends Authenticatable
{
    use HasFactory;

    protected $guard = 'employeesModel';

    protected $table = 'employees';
    
    protected $guard_name = 'web';

    protected $primaryKey  = 'employee_id';

    protected $fillable = [
        'companyId',
        'photos',
        'lastname',
        'firstname',
        'middlename',
        'extention',
        'gender',
        'position',
        'status',
        'age',
        'birthday',
        'nationality',
        'religion',
        'address',
        'phoneNumber',
        'emailAddress',
        'username',
        'password',
        'is_active',
        'is_utilized'
    ];
    protected $hidden = [
        'password',
        'token',
    ];

    public function employees(){
        return $this->hasOne(employees::class, 'foreman', 'employee_id');
    }
}
