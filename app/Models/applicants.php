<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class applicants extends Authenticatable
{
    use HasFactory;

    protected $guard = 'applicantsModel';

    protected $table = 'applicants';

    protected $guard_name = 'web';

    protected $primaryKey  = 'applicant_id';

    protected $fillable = [
        'photos',
        'lastname',
        'firstname',
        'middlename',
        'extention',
        'Gender',
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
        'personal_id1',
        'personal_id2',
        'is_pro',
        'is_active',
        'is_utilized',
        'is_blocked'
    ];
    protected $hidden = [
        'token',
    ];

    public function operations(){
        return $this->belongsToMany(operation::class, 'applied', 'operation_id', 'applicants_id')->withPivot('is_recruited', 'is_recommend');
    }
}
