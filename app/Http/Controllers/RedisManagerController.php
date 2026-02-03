<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;


class RedisManagerController extends Controller
{
    /**
     * Store user location in Redis
     */
    public function setUserLocation(Request $request)
    {
        

        $request->validate([
            'user_id'   => 'required|integer',
            'lat'       => 'required|numeric',
            'lng'       => 'required|numeric',
            'latitude'  => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'speed'     => 'nullable|numeric',
            'bearing'   => 'nullable|numeric',
            'name'      => 'nullable|string',
            'date'      => 'nullable|string',
        ]);

        $key = "user:location:{$request->user_id}";

        Redis::hMSet($key, [
            'user_id'   => $request->user_id,
            'id'        => $request->id,
            'lat'       => $request->lat,
            'lng'       => $request->lng,
            'latitude'  => $request->latitude,
            'longitude' => $request->longitude,
            'speed'     => $request->speed,
            'bearing'   => $request->bearing,
            'name'      => $request->name ?? '',
            'date'      => $request->date ?? now()->toDateTimeString(),
        ]);

        // Auto-expire after 1 hour (optional)
        Redis::expire($key, 20);

        return response()->json([
            'status' => 'stored',
            'redis_key' => $key
        ]);
    }

    /**
     * Retrieve user location from Redis
     */
    public function getUserLocation($userId)
    {
        $key = "user:location:$userId";

        if (!Redis::exists($key)) {
            return response()->json([
                'message' => 'No location found for this user'
            ], 404);
        }

        $data = Redis::hgetall($key);

        return response()->json($data);
    }
}
