<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(User::whereEmail('admin@gmail.com')->count() == 0)
        {
            User::create([
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt(123456),
                'status' => 0,
                'role' => 1
            ]);
        }
        if(User::whereEmail('yankeekicks@gmail.com')->count() == 0)
        {
            User::create([
                'name' => 'yankeekicks',
                'email' => 'yankeekicks@gmail.com',
                'password' => bcrypt(123456),
                'status' => 0,
                'role' => 3
            ]);
        }
        
    }
}
