<?php

namespace App\Repositories;

use Illuminate\support\Facades\Http;

class ArtistApiRepository
{
    public static function all()
    {
        return self::get('task/')->json();
    }

    public static function find($id)
    {
        return self::get('task/?id=' . $id)->json();
    }

    private static function get($endpoint)
    {
        return Http::withHeaders([
            'Basic' => 'ZGV2ZWxvcGVyOlpHVjJaV3h2Y0dWeQ=='
        ])
        ->get('https://moat.ai/api/' . $endpoint);
    }
}
