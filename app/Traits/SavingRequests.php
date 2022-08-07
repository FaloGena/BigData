<?php


namespace App\Traits;


use App\Models\Request;

trait SavingRequests
{
    public function startRequest($request)
    {
        $savedRequest = Request::create([
            'type' => $request->method(),
            'uri' => $request->path(),
        ]);

        return $savedRequest;
    }

    public function endRequest(\App\Models\Request $savedRequest, int $status = 200)
    {
        $savedRequest->time = now()->diffInMilliseconds($savedRequest->created_at);
        $savedRequest->status = $status;
        $savedRequest->save();
    }
}
