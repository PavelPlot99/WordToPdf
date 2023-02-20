<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\WordRequest;
use App\Services\WordService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WordController extends Controller
{
    public function __invoke(WordRequest $request)
    {
        $firstname = $request->firstname;
        $file = $request->file('word');
        $filepath = WordService::generate($file, $firstname);

        return Storage::disk('public')->download($filepath);
    }
}
