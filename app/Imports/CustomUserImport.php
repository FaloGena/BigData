<?php

namespace App\Imports;

use App\Models\CustomUser;
use App\Services\Transfer\BaseService;
use Illuminate\Support\Facades\Validator;
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

        $validator = Validator::make($row, BaseService::VALIDATION_RULES, BaseService::VALIDATION_MESSAGES);

        return new CustomUser($validator->validated());
    }
}
