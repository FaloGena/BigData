<?php

namespace App\Http\Controllers\Transfer;

use App\Http\Requests\ImportRequest;

class PhpController extends BaseController
{
    public function __construct()
    {
        $this->service = new \App\Services\Transfer\PhpService();
    }

    /**
     * @inheritDoc
     */
    public function import(ImportRequest $request)
    {
        return parent::import($request);
    }

    /**
     * @inheritDoc
     */
    public function export()
    {
        return parent::export();
    }
}
