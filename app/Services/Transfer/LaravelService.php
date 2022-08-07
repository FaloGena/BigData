<?php


namespace App\Services\Transfer;


use App\Exports\CustomUserExport;
use App\Imports\CustomUserImport;
use Maatwebsite\Excel\Facades\Excel;

class LaravelService extends BaseService
{

    /**
     * @inheritDoc
     */
    public function import($file)
    {
        // TODO: validation

        return Excel::import(new CustomUserImport, $file);
    }

    /**
     * @inheritDoc
     */
    public function export($customUsers, $fileName)
    {
        return Excel::download(new CustomUserExport, $fileName);
    }
}
