<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;


class AIChatController extends Controller
{
    public function chat(Request $request)
    {
        $message = $request->input('message');
        $context = File::get(resource_path('data/ai_context.txt'));

        $context = Str::limit($context, 3000);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.openai.key'),
            'HTTP-Referer' => env('APP_URL'),
            'X-Title' => 'SmartKasip Support',
            'Content-Type' => 'application/json'
        ])->post('https://openrouter.ai/api/v1/chat/completions', [
                    'model' => 'deepseek/deepseek-r1:free',
                    'messages' => [
                        ['role' => 'system', 'content' => $context],
                        ['role' => 'user', 'content' => $message],
                    ],
                ]);
        \Log::info('OPENROUTER_API_KEY = ' . env('OPENROUTER_API_KEY'));


        $reply = $response->json()['choices'][0]['message']['content'] ?? 'No response';

        return response()->json(['reply' => $reply]);

    }

    /**
     * 
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
