<?php

namespace App\Http\Controllers\Transfer;

use App\Http\Requests\ImportRequest;

class SpatieController extends BaseController
{
    public function __construct()
    {
        $this->service = new \App\Services\Transfer\SpatieService();
    }

    public function import(ImportRequest $request)
    {
        return parent::import($request);
    }

    public function export()
    {
        return parent::export();
    }
}
