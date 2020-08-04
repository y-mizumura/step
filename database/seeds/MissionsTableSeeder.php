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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // 削除
        // ※delete()では自動増分のIDがリセットされない
        DB::table('missions')->truncate();

        // 初期データ
        DB::table('missions')->insert([
            [
                'name' => 'ランニング',
                'user_id' => 1,
                'category_id' => 1,
                'score_unit' => '分',
                'memo' => '5分間ウォーキング',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => '腕立て',
                'user_id' => 1,
                'category_id' => 1,
                'score_unit' => '回',
                'memo' => NULL,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => '読書',
                'user_id' => 1,
                'category_id' => 2,
                'score_unit' => 'ページ',
                'memo' => NULL,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'あさがおの観察',
                'user_id' => 1,
                'category_id' => 3,
                'score_unit' => 'cm',
                'memo' => NULL,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
