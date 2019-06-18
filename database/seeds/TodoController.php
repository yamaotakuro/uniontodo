<?php
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TodoController extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 3) as $num) {
            DB::table('todos')->insert([
                'id' => 1,
                'user_id' => 1,
                'body' => "サンプルタスク {$num}",
                'workload' => "中 {$num}",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
