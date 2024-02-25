<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('books')->insert(

            [
                [
                    'name' => 'To Kill a Mockingbird',
                    'description' => ' Set in the racially charged atmosphere of the American South, this novel follows young Scout Finch as her father, lawyer Atticus Finch, defends a black man falsely accused of raping a white woman, exploring themes of morality, justice, and empathy.',
                    'image' => 'E:\react\testapp\iamge\3.png',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'name' => 'The Great Gatsby',
                    'description' => 'Set in the Jazz Age, this novel delves into the lives of the wealthy and the pursuit of the elusive American Dream through the eyes of narrator Nick Carraway, amidst the enigmatic allure of Jay Gatsby and his obsession with Daisy Buchanan.',
                    'image' => 'E:\react\testapp\iamge\2.jpg',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'name' => 'The Catcher in the Rye',
                    'description' => 'Narrated by disillusioned teenager Holden Caulfield, this coming-of-age novel captures the angst and alienation of adolescence as Holden grapples with societal hypocrisy and searches for genuine connections in a superficial world.',
                    'image' => 'E:\react\testapp\iamge\1.jpg',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
               
                
            ]
        );
    }
}

