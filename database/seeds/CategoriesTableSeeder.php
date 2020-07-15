<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
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
        DB::table('categories')->truncate();

        // 初期データ
        DB::table('categories')->insert([
            [
                'name' => '運動',
                'color' => '#66CCFF',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => '自己啓発',
                'color' => '#FFCC66',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => '食事',
                'color' => '#CCFF66',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
