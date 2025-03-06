<?php

namespace App\Imports;

use App\Models\Company;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CompanyImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row);
        return new Company([
            'name'=> $row['name'],
            'email'=> $row['email'],
            'phone'=> $row['phone'],
            'address'=> $row['address'],
            'logo'=> $row['logo'],
        ]);
    }
}
