<?php


namespace App\Services\Transfer;


use App\Models\CustomUser;
use Illuminate\Database\Eloquent\Collection;

abstract class BaseService
{
    const FIELDS = [
        'user_name',
        'first_name',
        'last_name',
        'patronymic',
        'email',
        'password',
    ];

    /**
     * @param $file
     * @return array
     */
    abstract public function import($file);


    /**
     * @param Collection<CustomUser> $customUsers
     * @param string $fileName
     * @return mixed
     */
    abstract public function export($customUsers, string $fileName);


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
