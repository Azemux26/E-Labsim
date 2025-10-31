<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WablasServices
{
    protected $token;
    protected $baseUrl;

    public function __construct()
    {
        $this->token = config('services.wablas.token', env('WABLAS_API_TOKEN'));
        $this->baseUrl = config('services.wablas.base_url', env('WABLAS_BASE_URL'));
    }

    /**
     * Kirim pesan WA via Wablas dan kembalikan response lengkap
     */
    public function sendMessage($phone, $message)
    {
        $response = Http::withHeaders([
            'Authorization' => $this->token,
        ])->post("{$this->baseUrl}/send-message", [
            'data' => [
                [
                    'phone' => $phone,
                    'message' => $message,
                ]
            ]
        ]);
        // dd($response->body(), $response->status(), $response->json());
        return $response->json();
    }
}
