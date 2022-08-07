<?php


namespace App\Repositories;


use App\Models\CustomUser;

class CustomUserRepository
{

    public function getForExport()
    {
        $collection = CustomUser::all();

        // In case there is only one record, we still want collection to be returned
        if ($collection instanceof CustomUser)
            $collection = collect($collection);

        return $collection;
    }
}
