<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Setting;
use Illuminate\Support\Facades\DB;
class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->truncate(); // optional
    
        $settings = [
            ['key' => 'site_name', 'value' => 'My Website'],
            ['key' => 'site_email', 'value' => 'info@mywebsite.com'],
            ['key' => 'site_phone', 'value' => '+20123456789'],
            ['key' => 'site_address', 'value' => '123 Nile Street, Cairo, Egypt'],
       // Social Media
       ['key' => 'facebook', 'value' => 'https://facebook.com/mywebsite'],
       ['key' => 'twitter', 'value' => 'https://twitter.com/mywebsite'],
       ['key' => 'instagram', 'value' => 'https://instagram.com/mywebsite'],
       ['key' => 'linkedin', 'value' => 'https://linkedin.com/company/mywebsite'],
        ];
        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }
    
}
