<?php

namespace App\Imports;

use App\Models\employees;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class employeesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $employeesImport = new employees([
            'companyId' => $row['company_id'],
            'photos' => '/storage/employees/defaultImage.png',
            'lastname' => $row['last_name'], 
            'firstname' => $row['first_name'], 
            'middlename' => $row['middle_name'], 
            'extention' => $row['extention'], 
            'gender' => $row['gender'], 
            'position' => $row['position'], 
            'status' => $row['status'], 
            'age'  => $row['age'], 
            'birthday'  => $row['birthday'] = date('Y-m-d', strtotime($row['birthday'])),
            'nationality'  => $row['nationality'], 
            'religion' => $row['religion'], 
            'address' => $row['address'], 
            'phoneNumber' => $row['phonenumber'], 
            'emailAddress' => $row['email_address'], 
            'username' =>   $row['last_name'].'123',
            'password' => Hash::make($row['last_name'].'123'), 
            'is_active' => 1, 
            'is_utilized'  => 0, 
        ]);

        return $employeesImport;
    }
}
