<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\Setting::create([
            'site_name' => "Laravel's blog",
            'contact_number' => '44 335 688 9',
            'contact_email' => 'info@laravel_blog.com',
            'address' => 'Novi Sad, Serbia'
        ]);
    }
}
