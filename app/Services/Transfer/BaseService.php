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

    const VALIDATION_RULES = [
      'user_name' => 'required|string|max:100|unique:custom_users,user_name|regex:/[\w\.]/', // Latin, digits and .
      'first_name' => 'required|string|max:100|regex:/[\x{0400}-\x{04FF}\-\s]/u', // Cyrillic, - and whitespace
      'last_name' => 'required|string|max:100|regex:/[\x{0400}-\x{04FF}\-\s]/u',
      'patronymic' => 'nullable|string|max:100|regex:/[\x{0400}-\x{04FF}\-\s]/u',
      'email' => 'required|email|unique:custom_users,email',
      'password' => 'required|string|between:8,100',
    ];

    const VALIDATION_MESSAGES = [
        'user_name' => ':attribute value :input must be <100, unique and contain latin, digits and . only',
        'first_name.regex' => ':attribute value :input must be <100 and contain cyrillic, - and whitespace only',
        'last_name.regex' => ':attribute value :input must be <100 and contain cyrillic, - and whitespace only',
        'patronymic' => ':attribute value :input must be <100 and contain cyrillic, - and whitespace only',
        'email' => ':attribute value :input must be unique and formatted as an email address',
        'password' => ':attribute value :input must be between 8 and 100',
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

    protected function modelToRow(CustomUser $user)
    {
        $row = $user->toArray();
        // could use hidden attributes in model, or even disable timestamps, but this looks closer to realistic scenario (apart from manual field => value)
        unset($row['id'], $row['created_at'], $row['updated_at']);
        $row['password'] = $user->password;

        return $row;
    }
}
