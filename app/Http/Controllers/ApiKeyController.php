<?php

namespace App\Http\Controllers;

use App\Models\ApiKey;
use App\Http\Requests\ApiKeys\CreateApiKeyRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ApiKeyController extends Controller
{
    public function list()
    {
        $apiKeys = ApiKey::where('user_id', Auth::guard('web')->user()->id)->get();

        return view('api-key.list', [
            'apiKeys' => $apiKeys
        ]);
    }

    public function store(CreateApiKeyRequest $request)
    {
        $apiKey = new ApiKey;
        $apiKey->user_id = Auth::guard('web')->user()->id;
        $apiKey->name = $request->input('name');
        $apiKey->key = Str::uuid();
        $apiKey->save();

        return redirect()->back();
    }
}
