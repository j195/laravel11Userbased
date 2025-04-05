<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MainUser;

class UserApiController extends Controller
{
    public function index(Request $request)
    {
        $query = MainUser::with(['detail', 'location']);

        // Apply filters
        if ($request->has('gender')) {
            $query->whereHas('detail', fn ($q) => $q->where('gender', $request->gender));
        }

        if ($request->has('city')) {
            $query->whereHas('location', fn ($q) => $q->where('city', $request->city));
        }

        if ($request->has('country')) {
            $query->whereHas('location', fn ($q) => $q->where('country', $request->country));
        }

        $fields = collect(explode(',', $request->input('fields', 'name,email,details.gender,location.city,location.country')))
                ->map(fn($f) => trim($f));
                // Limit records
        $limit = $request->input('limit', 10);

        $users = $query->limit($limit)->get();

        if ($users->isEmpty()) {
            return response()->json([
                'message' => 'No matching users found.'
            ], 404);
        }
        // Transform response based on requested fields
        $transformed = $users->map(function ($user) use ($fields) {
            $data = [];
            if ($fields->contains('name')) {
                $data['name'] = $user->name;
            }
            if ($fields->contains('email')) {
                $data['email'] = $user->email;
            }
            if ($fields->contains('details.gender') || $fields->contains('gender')) {
                $data['gender'] = $user->detail->gender ?? null;
            }
            if ($fields->contains('location.city') || $fields->contains('city')) {
                $data['city'] = $user->location->city ?? null;
            }
            if ($fields->contains('location.country') || $fields->contains('country')) {
                $data['country'] = $user->location->country ?? null;
            }

            return $data;
        });

        return response()->json([
            'data' => $transformed
        ]);

    }
}
