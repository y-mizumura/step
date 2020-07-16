<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StepsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 削除
        // ※delete()では自動増分のIDがリセットされない
        DB::table('steps')->truncate();

        // 初期データ
        $start = '2020-07-01'; # 開始日時
        $end = '2020-07-05'; # 終了日時
        for ($date = $start; $date <= $end; $date = date('Y-m-d', strtotime($date . '+1 day'))) {
            DB::table('steps')->insert([
                [
                    'mission_id' => 1,
                    'date' => $date,
                    'score' => '30',
                    'memo' => NULL,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'mission_id' => 2,
                    'date' => $date,
                    'score' => '20',
                    'memo' => NULL,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'mission_id' => 3,
                    'date' => $date,
                    'score' => '15',
                    'memo' => NULL,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            ]);
        }

        $start = '2020-07-06'; # 開始日時
        $end = '2020-07-12'; # 終了日時
        for ($date = $start; $date <= $end; $date = date('Y-m-d', strtotime($date . '+3 day'))) {
            DB::table('steps')->insert([
                [
                    'mission_id' => 1,
                    'date' => $date,
                    'score' => '40',
                    'memo' => NULL,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'mission_id' => 2,
                    'date' => $date,
                    'score' => '25',
                    'memo' => NULL,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'mission_id' => 3,
                    'date' => $date,
                    'score' => '20',
                    'memo' => NULL,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            ]);
        }

        $start = '2020-07-13'; # 開始日時
        $end = '2020-07-17'; # 終了日時
        for ($date = $start; $date <= $end; $date = date('Y-m-d', strtotime($date . '+4 day'))) {
            DB::table('steps')->insert([
                [
                    'mission_id' => 1,
                    'date' => $date,
                    'score' => '45',
                    'memo' => NULL,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'mission_id' => 2,
                    'date' => $date,
                    'score' => '30',
                    'memo' => NULL,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'mission_id' => 3,
                    'date' => $date,
                    'score' => '20',
                    'memo' => NULL,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            ]);
        }
    }
}
