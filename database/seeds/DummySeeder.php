<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class DummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private function createYears() {
        for($i = 1; $i <= 4; $i++) {
            DB::table('years')->insert([
                'name'=>$i,
            ]);
        }
    }
    private function createTerms() {
        for($i = 1; $i <=2; $i++) {
            DB::table('terms')->insert([
                'name'=>$i,
            ]);
        }
        DB::table('terms')->insert([
            'name'=>'summer',
        ]);
    }
    private function createYearTerm() {
        for($i = 1; $i <= 4; $i++) {
            for($j = 1; $j <= 3; $j++) {
                DB::table('year_term')->insert([
                    'year_id'=>$i,
                    'term_id'=>$j,
                ]);  
            }
        }
    }
    public function run()
    {
        $this->createYears();
        $this->createTerms();
        $this->createYearTerm();
    }
}
