<?php

use Illuminate\Database\Seeder;

use App\Profile;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $user = App\User::create([
            'name' => 'Maja Isakovic',
            'email' => 'maja@gmail.com',
            'password' => bcrypt('password'),
            'admin' => 1
        ]);

        App\Profile::create([
            'user_id' => $user->id,
            'avatar' => 'uploads/avatars/avatar1.jpg',
            'about' => 'neki tamo about text',
            'facebook' => 'facebook.com',
            'youtube' => 'youtube.com'

        ]);
    }
}
