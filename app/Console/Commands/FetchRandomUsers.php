<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\MainUser;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FetchRandomUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:random-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch 5 random users and store them in the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $response = Http::withoutVerifying()->get('https://randomuser.me/api/?results=5');
        $users = $response->json()['results'];

        foreach ($users as $user) {
            $main = MainUser::create([
                'name' => $user['name']['first'] . ' ' . $user['name']['last'],
                'email' => $user['email']
            ]);

            $main->detail()->create([
                'gender' => $user['gender']
            ]);

            $main->location()->create([
                'city' => $user['location']['city'],
                'country' => $user['location']['country']
            ]);
        }

        $this->info('5 users fetched and saved.');
        Log::info('🔁 Running FetchRandomUsers job...');
    }
}
