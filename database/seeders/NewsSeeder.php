<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        try {
            User::create([
                'role'          => 'admin',
                'email'         => 'admin@gmail.com',
                'username'      => 'yani',
                'password'      => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'firstname'     => 'yani',
                'lastname'      => ''
            ]);

            User::create([
                'role'          => 'admin',
                'email'         => 'tono@gmail.com',
                'username'      => 'tono',
                'password'      => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'firstname'     => 'tono',
                'lastname'      => 'markino'
            ]);

            User::create([
                'email'         => 'yadi@gmail.com',
                'username'      => 'yadi',
                'password'      => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'firstname'     => 'yadi',
                'lastname'      => 'pikir'
            ]);

            News::create([
                'title'         => 'Seorang Nenek Menjadi Superman',
                'news_content'  => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga rem corrupti tempora iusto tenetur laboriosam quibusdam et velit doloribus, maxime adipisci illo at sunt earum totam aut possimus accusantium. Itaque sed non magni consequatur repudiandae deleniti, nemo delectus ducimus perspiciatis a corporis tenetur ipsam placeat iure voluptate ea dicta eos.',
                'author_id'        => '1'
            ]);

            News::create([
                'title'         => 'Kakek Bisa Terbang',
                'news_content'  => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga rem corrupti tempora iusto tenetur laboriosam quibusdam et velit doloribus, maxime adipisci illo at sunt earum totam aut possimus accusantium. Itaque sed non magni consequatur repudiandae deleniti, nemo delectus ducimus perspiciatis a corporis tenetur ipsam placeat iure voluptate ea dicta eos.',
                'author_id'        => '2'
            ]);

            News::create([
                'title'         => 'Bang Toyib Akhirnya Pulang',
                'news_content'  => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis voluptates vita officia nisi sequi fuga voluptatum architecto maiores ut expedita neque cum nobis quas recusandae sunt sed reprehenderit temporibus ad nemo, eum vero soluta! Alias in minus explicabo eveniet tenetur doloribus, tempore quibusdam nihil nobis unde sit sed nostrum! At quasi accusantium accusamus eum modi provident, quod optio harum labore officia sed repudiandae. Facere veritatis perferendis magnam nobis doloribus repellendus.',
                'author_id'        => '1'
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
        }
    }
}
