<?php

namespace Database\Seeders;

use App\Models\Policy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $policy =[
            [
              'privacy_policy' =>'juygfxxxzzssssssssssssss',
              'terms_conditions' =>'juygfxxxzzssssssssssssss',
              'refund_policy' =>'juygfxxxzzssssssssssssss',
              'payment_policy' =>'juygfxxxzzssssssssssssss',
              'about_us' =>'juygfxxxzzssssssssssssss',
              'return_process' =>'juygfxxxzzssssssssssssss',

            ]
            ];

            Policy::insert($policy);
    }
}
