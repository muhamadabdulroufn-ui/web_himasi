<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name'      => 'Admin',
            'email'     => 'admin@gmail.com',
            'password'  => Hash::make('indonesia'),
            'role'      => 'admin',
        ]);

        \App\Models\User::create([
            'name'      => 'Pembina',
            'email'     => 'pembina@gmail.com',
            'password'  => Hash::make('indonesia'),
            'role'      => 'pembina',
        ]);

        \App\Models\User::create([
            'name'      => 'Pengurus',
            'email'     => 'pengurus@gmail.com',
            'password'  => Hash::make('indonesia'),
            'role'      => 'pengurus',
        ]);

        \App\Models\Profiles::create([
            'name'          => 'HIMASI UNUSA',
            'description'   => 'BEM (Badan Eksekutif Mahasiswa) sebagai organisasi mahasiswa tingkat fakultas. Melaksanakan kegiatan kokurikuler dan ekstrakurikuler mahasiswa, terutama dalam bidang minat, bakat, dan kesejahteraan mahasiswa sesuai dengan aspirasi mahasiswa yang disalurkan melalui organisasi yang ada.',

            'address'       => 'Surabaya, Indonesia',
            'address_link'  => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d253292.42716058585!2d112.57259700215688!3d-7.27559793655625!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fbf8381ac47f%3A0x3027a76e352be40!2sSurabaya%2C%20Kota%20SBY%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1669015322845!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
            'telpon'        => '082222222222',
            'email'         => 'bem.febtd@unusa.ac.id',
            'logo'          => 'default.jpg',
            'vision'        => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Enim nam laborum optio doloribus eveniet ea aut soluta sit est molestiae, veritatis fugit magni rerum fugiat laboriosam nostrum ipsum consequuntur voluptatem pariatur impedit voluptas doloremque beatae.',
            'mission'       => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Enim nam laborum optio doloribus eveniet ea aut soluta sit est molestiae, veritatis fugit magni rerum fugiat laboriosam nostrum ipsum consequuntur voluptatem pariatur impedit voluptas doloremque beatae.',
            'organization'  => '-',
        ]);
    }
}
