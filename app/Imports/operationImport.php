<?php

namespace App\Imports;

use App\Models\operations;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class operationImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {     
        $operationImport = new operations([
            'operationId' => $row['operation_id'],
            'photos' => '/storage/employees/defaultImage.png',
            'shipName' => $row['ship_name'], 
            'shipCarry' => $row['ship_carry'], 
            'operationStart' => date('Y/m/d H:i:s',strtotime($row['operation_start'])),
            'operationEnd' => date('Y/m/d H:i:s',strtotime($row['operation_end'])),
            'slot' => $row['slot'], 
            'foreman' => 0, 
            'is_completed' => 0,     
        ]);
        return $operationImport;
    }
}
