<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tusk')->insert([
           'No'=>1,
           'id'=>'00001',
           'name'=>'課題発表',
           'userid'=>'abc123@aaa.com',
           'view'=>'全体',
           'status'=>'0',
           'sakujo'=>'0',
           'enddate'=>'2020-10-01',
           'limitdate'=>'2020-10-01',
           'insdate'=>'2020-09-29 21:41:56'
        ]);
    }
