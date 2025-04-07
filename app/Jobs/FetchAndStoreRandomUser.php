<?php

namespace App\Jobs;

use App\Models\MainUser;
use App\Models\UserDetail;
use App\Models\Location;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class FetchAndStoreRandomUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $response = Http::withoutVerifying()->get('https://randomuser.me/api/?results=5');

        if ($response->successful()) {
            foreach ($response['results'] as $user) {
                $mainUser = MainUser::create([
                    'name' => $user['name']['first'] . ' ' . $user['name']['last'],
                    'email' => $user['email']
                ]);

                UserDetail::create([
                    'main_user_id' => $mainUser->id,
                    'gender' => $user['gender'] ?? null
                ]);

                Location::create([
                    'main_user_id' => $mainUser->id,
                    'city' => $user['location']['city'] ?? null,
                    'country' => $user['location']['country'] ?? null
                ]);
            }
        }
    }
}
