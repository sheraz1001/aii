<?php

namespace Database\Seeders;

use App\Models\Business;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /** Creates the demo clinic the voice agent answers for during testing. */
    public function run(): void
    {
        $file = base_path('../agent/demo_business.json');
        $demo = file_exists($file) ? (json_decode(file_get_contents($file), true) ?: []) : [];
        unset($demo['id']);

        Business::updateOrCreate(
            ['name' => $demo['name'] ?? 'Smile Dental Clinic'],
            [
                ...$demo,
                'phone_number' => Business::normaliseNumber(env('AII_DEMO_NUMBER')) ?: null,
                'owner_email' => env('AII_CONTACT_EMAIL'),
            ],
        );
    }
}
