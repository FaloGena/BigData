<?php


namespace App\Services\Transfer;


use App\Models\CustomUser;
use Illuminate\Database\Eloquent\Collection;

abstract class BaseService
{
    /**
     * @param $file
     * @param array $fields
     * @return array
     */
    abstract public function parseCSV($file, array $fields);

    /**
     * @param array $fields
     * @param Collection<CustomUser> $customUsers
     * @return mixed
     */
    abstract public function writeToCSV(array $fields, $customUsers);


    /**
     * @param string $fileName
     * @return string[]
     */
    public function getExportHeaders(string $fileName = 'sample.csv')
    {
        return [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];
    }
}
