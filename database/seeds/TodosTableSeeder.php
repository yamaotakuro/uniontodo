<?php
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TodosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 10) as $num) {
            DB::table('todos')->insert([
                'id' => 1,
                'user_id' => 1,
                'title' => "サンプルタスク {$num}",
                'workload' => "中 {$num}",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
