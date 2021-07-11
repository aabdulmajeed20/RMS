<?php

use App\Report;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 20; $i++) {
            Report::create([
                'name' => "report$i",
                'content' => "This is a test report for testing the added reports to the system.\n This for report number $i.",
                'user_id' => rand(1,10)
            ]);
        }
    }
}
