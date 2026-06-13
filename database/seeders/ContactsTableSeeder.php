<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contact::create([
            'email_1' => 'info@cafe-katumiri.com',
            'email_2' => 'support@cafe-katumiri.com',
            'phone' => '+62 812 3456 7890',
            'address' => 'Jl. Raya No. 123, Bandung, Indonesia',
            'office_hours' => 'Senin - Jumat: 09.00 - 17.00 WIB',
        ]);
    }
}
