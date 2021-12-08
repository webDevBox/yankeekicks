<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TokenAuthenticate;

class TokenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(TokenAuthenticate::count() == 0)
        {
            TokenAuthenticate::create([
                'token' => getRandomToken()
            ]);
        }
    }
}
