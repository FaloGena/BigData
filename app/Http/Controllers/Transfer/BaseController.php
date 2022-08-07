<?php

namespace App\Http\Controllers\Transfer;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImportRequest;
use App\Models\CustomUser;

abstract class BaseController extends Controller
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
     * Service where logic for parsing\writing is stored
     *
     * @var
     */
    protected $service;

    abstract public function __construct();

    /**
     * @param ImportRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');

        $parsed = $this->service->parseCSV($file, self::FIELDS);

        dd($parsed);
        CustomUser::insert($parsed);

        return response()->json('done', 200);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function export()
    {
        $fileName = 'customUsers.csv';
        $customUsers = CustomUser::all();

        $headers = $this->service->getExportHeaders($fileName);

        $writeToCSV = function() use($customUsers) {
            $this->service->writeToCSV(self::FIELDS, $customUsers);
        };

        return response()->stream($writeToCSV, 200, $headers);
    }
}
