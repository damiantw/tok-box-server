<?php

namespace App\Http\Controllers;

use App\TokBox;
use App\TokBoxSession;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class TokBoxSessionController extends Controller
{
    public function index()
    {
        return response()->json(TokBoxSession::query()->with(['tokens' => function($query) {
            $query->unexpired();
        }])->get());
    }

    public function store(TokBox $tokBox, Request $request)
    {
        return response()->json($tokBox->createSession($request->input('name')));
    }
}
