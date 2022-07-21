<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SessionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sessions')->delete();
        
        \DB::table('sessions')->insert(array (
            0 => 
            array (
                'id' => 'UNtZELCubSq68jnJbf4iJQBPggvPjJG3vm0l6neO',
                'user_id' => 1,
                'ip_address' => '127.0.0.1',
            'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36',
                'payload' => 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiOWt5TTExTzBhTlJEZk1xelFQckRXeWU2SWpmaEh2YWEzUXZHY1Y4YyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo1NDoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL2RhdGFfbWFzdGVyL3J1a3VuX3RldGFuZ2dhIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2FkZXIvanMvYWRtaW4uanMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=',
                'last_activity' => 1658400690,
            ),
        ));
        
        
    }
}