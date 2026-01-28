<?php

namespace App\Actions\Weather;

use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class ShowWeatherAction
{
    use AsAction;

    public function handle(Request $request)
    {
        $weather = null;
        $error = null;

        // Cek apakah user sudah input nama kota
        if ($city = $request->input('city')) {
            $apiKey = env('OPENWEATHER_API_KEY');
            
            // Tembak API OpenWeather
            $response = Http::get("https://api.openweathermap.org/data/2.5/weather", [
                'q' => $city,
                'units' => 'metric',
                'appid' => $apiKey
            ]);

            if ($response->successful()) {
                $weather = $response->json();
            } else {
                $status = $response->status();
                $msg = $response->json()['message'] ?? 'Unknown error';
                $error = "Error ({$status}): {$msg}";
            }
        }

        // Render halaman Vue dengan data cuaca
        return Inertia::render('Weather/Index', [
            'weather' => $weather,
            'error' => $error,
            'filters' => $request->only('city'),
        ]);
    }
}