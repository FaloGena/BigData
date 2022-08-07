<?php

namespace App\Imports;

use App\Models\CustomUser;
use App\Services\Transfer\BaseService;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CustomUserImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $fields = BaseService::FIELDS;

        foreach ($fields as $field) {
            $data[$field] = $row[$field];
        }

        return new CustomUser($data);
    }
}
