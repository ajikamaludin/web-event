<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Content;
use Illuminate\Database\Seeder;
use App\Models\Setting;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Administrator',
        //     'email' => 'admin@admin.com',
        //     'password' => bcrypt('password'),
        //     'is_admin' => 1, // admin user
        // ]);

        // User::factory()->create([
        //     'name' => 'User',
        //     'email' => 'user@admin.com',
        //     'password' => bcrypt('password'),
        //     'is_admin' => 0, // normal user
        // ]);

        // Setting::create([
        //     'midtrans_server_key' => 'SB-Mid-server-UA0LQbY4aALV0CfLLX1v7xs8',
        //     'midtrans_client_key' => 'SB-Mid-client-xqqkspzoZOM10iUG',
        //     'midtrans_merchant_id' => 'G561244367',
        //     'site_name' => 'Situs Jual Tiket Konser',
        //     'ticket_price' => '15000',
        //     'is_open_order' => Setting::OPEN_ORDER,
        // ]);

        Content::where('content', '!=', null)->delete();
        $contents = [
            [
                'content_name' => 'LOGO_1',
                'content' => 'images/fleycia.png',
                'type' => Content::TYPE_IMAGE,
                'sort' => 1,
            ],
            [
                'content_name' => 'LOGO_2',
                'content' => 'images/afika.png',
                'type' => Content::TYPE_IMAGE,
                'sort' => 2,
            ],
            // [
            //     'content_name' => 'IMAGE_BANNER',
            //     'content' => json_encode([
            //         "images" => [[
            //             "url" => "http://localhost:8000/images/sample.jpeg",
            //             "caption" => "Event Konser Termeriah Abad ini"
            //         ],[
            //             "url" => "http://localhost:8000/images/sample.jpeg",
            //             "caption" => "Event Konser Termeriah Abad ini"
            //         ]]
            //     ]),
            //     'type' => Content::TYPE_MULTI_IMAGE,
            //     'sort' => 3,
            // ],
            [
                'content_name' => 'IMAGE_BANNER_2',
                'content' => 'images/sample.jpeg',
                'type' => Content::TYPE_IMAGE,
                'sort' => 3,
            ],
            [
                'content_name' => 'TITLE_1',
                'content' => 'FALENTAIN BERSAMA',
                'type' => Content::TYPE_TEXT,
                'sort' => 4,
            ],
            [
                'content_name' => 'TITLE_1_1',
                'content' => 'SITI BADRIAH VS ANDIKA MAHESA (KANGEN BAND)',
                'type' => Content::TYPE_TEXT,
                'sort' => 5,
            ],
            [
                'content_name' => 'SUB_TITLE_1',
                'content' => 'MERIAHKAN DAN SAKSIKAN PENAMPILAN SPERKTAKULER DARI SITI BADRIAH DAN ANDIKA KANGEN BAND',
                'type' => Content::TYPE_TEXT,
                'sort' => 6,
            ],
            [
                'content_name' => 'IMAGE_1',
                'content' => 'images/babang-tamvan.jpg',
                'type' => Content::TYPE_IMAGE,
                'sort' => 7,
            ],
            [
                'content_name' => 'IMAGE_2',
                'content' => 'images/siti-badriah.jpg',
                'type' => Content::TYPE_IMAGE,
                'sort' => 8,
            ],
            [
                'content_name' => 'SUB_TITLE_2',
                'content' => 'JANGAN KETINGGALAN MOMEN FALENTINE YANG SUPER SERU DAN SPEKTAKULER BERSAMA PASANGAN. SAHABAT DAN KELUARGA DI MERIHKAN ARTIS YANG SEDANG HITS YAKNI SITI BADRIA DAN ANDIKA MAHESA ( KANGEN BAND )',
                'type' => Content::TYPE_TEXT,
                'sort' => 9,
            ],
            [
                'content_name' => 'TITLE_2',
                'content' => 'INTIP PENAMPILAN MEREKA',
                'type' => Content::TYPE_TEXT,
                'sort' => 10,
            ],
            [
                'content_name' => 'YT_1',
                'content' => 'https://www.youtube.com/embed/DKBseO40CXU',
                'type' => Content::TYPE_URL,
                'sort' => 11,
            ],
            [
                'content_name' => 'TITLE_3',
                'content' => 'TIKET 50RB',
                'type' => Content::TYPE_TEXT,
                'sort' => 12,
            ],
            [
                'content_name' => 'SUB_TITLE_3',
                'content' => '
                    <ul class="list-disc text-lg">
                        <li>DAPAT TIKET LIVE KONSER</li>
                        <li>DAPAT VOUCHER UNDIAN</li>
                        <li>DAPAT VOUCHER RP. 1.500.000,- di perumahan afika residence</li>
                    </ul>
                ',
                'type' => Content::TYPE_TEXT,
                'sort' => 13,
            ],
            [
                'content_name' => 'YT_2',
                'content' => 'https://www.youtube.com/embed/DKBseO40CXU',
                'type' => Content::TYPE_URL,
                'sort' => 14,
            ],
        ];

        foreach ($contents as $content) {
            Content::create($content);
        }
    }
}
