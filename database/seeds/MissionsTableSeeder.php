<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MissionsTableSeeder extends Seeder
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
        DB::table('missions')->truncate();

        // 初期データ
        DB::table('missions')->insert([
            [
                'name' => 'ランニング',
                'user_id' => 1,
                'category_id' => 1,
                'level_unit' => '分',
                'memo' => '最初5分間はウォーキング',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => '腕立て',
                'user_id' => 1,
                'category_id' => 1,
                'level_unit' => '回',
                'memo' => NULL,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => '腹筋',
                'user_id' => 1,
                'category_id' => 1,
                'level_unit' => '回',
                'memo' => NULL,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}