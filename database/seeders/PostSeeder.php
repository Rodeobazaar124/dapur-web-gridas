<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    Post::create([
            'title' => 'Sinkronisasi Dan Penyusunan Kurikulum',
            'image' => 'https://smkn2sumedang.sch.id/_next/image?url=%2Fimages%2Flanding%2Fberita.png&w=640&q=75',
            'content' => "SMKN 2 SUMEDANG, menggelar Pemilihan Ketua OSIS dan Ketua MPK masa bakti 2020-2021 pada Jum'at (20/11/2020)
Pilketos yang dilakukan melalui e-voting dianggap menjadi pilihan yang harus dilakukan di masa pandemi Covid-19 saat ini.

Selain bisa menghindari kerumunan dan mencegah penyebaran virus, cara ini dirasa efektif dan efisien dalam implementasinya. Yang membanggakan, lanjut Pa Edi, semua proses dilakukan panitia yang merupakan siswa SMKN 2 Sumedang secara mandiri dengan didampingi para pembina OSIS. Untuk menjaga independensi, panitia khususnya admin teknologi informasi diwajibkan membuat pakta integritas sehingga asas Luberjurdil bisa tergaransi.


Pilketos juga merupakan sarana edukasi kepada siswa sebagai calon pemilih pemula dalam Pemilu atau Pilkada. “Kami ingin budaya berdemokrasi yang baik dengan menggunakan hak pilih secara bertanggung jawab terjaga melalui kegiatan Pilketos,” beber Pa Edi (Wakasek). Adapun calon Ketua OSIS yang tersaring ada 6 Kandidat dan calon Ketua MPK ada 6 Kandidat.

Kepala SMKN 2 Sumedang, Drs.H.Edi Supriadi,M.Pd, dalam sambutannya berharap terpilih Ketua OSIS dan Ketua MPK yang lebih baik dan berkualitas dalam memimpin roda organisasi OSIS dan MPK satu tahun ke depan.


Dari hasil penghitungan suara, terpilih dengan suara terbanyak untuk Ketua OSIS adalah kandidat nomor urut 6 yaitu Aan Yuningsih dan suara terbanyak untuk Ketua MPK adalah kandidat nomor urut 6 yaitu Nadia Maharani. Adapun rincian perolehan suara dilihat dari angka partisipasinya, dari total 1721 daftar pemilih tetap (DPT), suara yang masuk sejumlah 1636 , dan suara yang tidak masuk sejumlah 85.",
            'created_at' => now(),
            'user_id' => 1
        ]);
    }
}
