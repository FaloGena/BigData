<?php

namespace App\Exports;

use App\Models\CustomUser;
use App\Repositories\CustomUserRepository;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;

class CustomUserExport implements FromCollection, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return (new CustomUserRepository())->getForExport();
    }

    public function map($customUser) : array
    {
        $row = $customUser->toArray();
        // could use hidden attributes in model, or even disable timestamps, but this looks closer to realistic scenario (apart from manual field => value)
        unset($row['id'], $row['created_at'], $row['updated_at']);
        $row['password'] = $customUser->password;

        return $row;
    }
}
