<?php

namespace App\Http\Controllers\Transfer;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImportRequest;
use App\Repositories\CustomUserRepository;

abstract class BaseController extends Controller
{

    const EXPORT_FILE_NAME = 'customUsers.csv';

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

        $this->service->import($file);


        return response()->json('done', 200);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function export()
    {
        $customUsers = (new CustomUserRepository())->getForExport();

        return $this->service->export($customUsers, self::EXPORT_FILE_NAME);
    }
}
