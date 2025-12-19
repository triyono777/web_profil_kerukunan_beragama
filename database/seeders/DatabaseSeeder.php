<?php

namespace Database\Seeders;

use App\Models\Agenda;
use App\Models\Category;
use App\Models\Document;
use App\Models\Footer;
use App\Models\MediaItem;
use App\Models\Menu;
use App\Models\OrganizationMember;
use App\Models\Page;
use App\Models\Post;
use App\Models\Program;
use App\Models\Section;
use App\Models\SiteSetting;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@kerukunan.local'],
            [
                'name' => 'Admin Kerukunan',
                'password' => bcrypt('password'),
                'is_admin' => true,
            ],
        );

        $siteSetting = SiteSetting::firstOrCreate(
            ['id' => 1],
            [
                'site_name' => 'Profil Kerukunan Umat Beragama',
                'contact_email' => 'halo@kerukunan.local',
                'contact_phone' => '021-123456',
                'contact_whatsapp' => '6281234567890',
                'contact_address' => 'Jl. Harmoni No. 10, Jakarta',
                'office_hours' => 'Senin-Jumat 09.00 - 17.00',
                'hero_title' => 'Ruang bersama untuk merawat toleransi',
                'hero_subtitle' => 'Profil dan informasi resmi kerukunan umat beragama. Terbuka untuk kolaborasi lintas komunitas.',
                'hero_cta_label' => 'Lihat Agenda Damai',
                'hero_cta_link' => '/agenda',
                'map_embed' => '<iframe src="https://maps.google.com" class="w-full h-64" loading="lazy"></iframe>',
                'theme' => 'aurora',
            ],
        );

        Footer::firstOrCreate(
            ['id' => 1],
            [
                'address' => $siteSetting->contact_address,
                'phone' => $siteSetting->contact_phone,
                'email' => $siteSetting->contact_email,
                'whatsapp' => $siteSetting->contact_whatsapp,
                'map_embed' => $siteSetting->map_embed,
                'social_links' => [
                    ['platform' => 'Instagram', 'url' => 'https://instagram.com/kerukunan'],
                    ['platform' => 'YouTube', 'url' => 'https://youtube.com/@kerukunan'],
                ],
                'quick_links' => [
                    ['label' => 'Profil', 'url' => '/profil'],
                    ['label' => 'Berita', 'url' => '/berita'],
                    ['label' => 'Kontak', 'url' => '/kontak'],
                ],
                'copyright_text' => '© ' . date('Y') . ' Portal Kerukunan Umat Beragama',
            ],
        );

        $menus = [
            ['label' => 'Beranda', 'url' => '/', 'type' => 'internal'],
            ['label' => 'Profil', 'url' => '/profil', 'type' => 'internal'],
            ['label' => 'Program', 'url' => '/program', 'type' => 'internal'],
            ['label' => 'Berita', 'url' => '/berita', 'type' => 'internal'],
            ['label' => 'Agenda', 'url' => '/agenda', 'type' => 'internal'],
            ['label' => 'Galeri', 'url' => '/galeri', 'type' => 'internal'],
            ['label' => 'Dokumen', 'url' => '/dokumen', 'type' => 'internal'],
            ['label' => 'Kontak', 'url' => '/kontak', 'type' => 'internal'],
        ];

        foreach ($menus as $index => $menu) {
            Menu::updateOrCreate(
                ['label' => $menu['label']],
                [
                    'url' => $menu['url'],
                    'type' => $menu['type'],
                    'sort_order' => $index,
                    'is_active' => true,
                ],
            );
        }

        Page::updateOrCreate(
            ['key' => 'profil'],
            [
                'title' => 'Profil',
                'slug' => 'profil',
                'status' => 'published',
                'content' => '<p>Portal resmi untuk merawat dialog lintas iman, kolaborasi sosial, dan edukasi toleransi.</p>',
                'published_at' => now(),
            ],
        );

        Section::updateOrCreate(
            ['page_key' => 'profil', 'section_key' => 'latar_belakang', 'sort_order' => 1],
            [
                'title' => 'Latar Belakang',
                'content' => 'Portal ini hadir sebagai ruang bersama untuk merawat kerukunan, membagikan praktik dialog, dan menyediakan informasi terpercaya seputar keberagaman.',
            ],
        );

        Section::updateOrCreate(
            ['page_key' => 'profil', 'section_key' => 'visi', 'sort_order' => 2],
            [
                'title' => 'Visi',
                'content' => 'Mewujudkan kehidupan bermasyarakat yang damai, inklusif, dan saling menghormati dalam keberagaman.',
            ],
        );

        Section::updateOrCreate(
            ['page_key' => 'profil', 'section_key' => 'misi', 'sort_order' => 3],
            [
                'title' => 'Misi',
                'json_data' => [
                    'items' => [
                        'Mendorong dialog lintas agama yang konstruktif.',
                        'Mengembangkan edukasi toleransi dan kebhinekaan.',
                        'Memperkuat kolaborasi sosial dan kemanusiaan.',
                        'Menyediakan informasi yang transparan dan bertanggung jawab.',
                    ],
                ],
            ],
        );

        Section::updateOrCreate(
            ['page_key' => 'profil', 'section_key' => 'nilai', 'sort_order' => 4],
            [
                'title' => 'Nilai',
                'json_data' => [
                    'items' => ['Toleransi', 'Inklusif', 'Dialog', 'Gotong Royong', 'Kemanusiaan'],
                ],
            ],
        );

        Section::updateOrCreate(
            ['page_key' => 'home', 'section_key' => 'nilai', 'sort_order' => 1],
            [
                'title' => 'Nilai Inti',
                'json_data' => [
                    'items' => ['Kolaborasi', 'Keterbukaan', 'Dialog Empatik'],
                ],
            ],
        );

        Section::updateOrCreate(
            ['page_key' => 'home', 'section_key' => 'tagline', 'sort_order' => 2],
            [
                'title' => 'Narasi Damai',
                'content' => 'Merawat ruang aman untuk belajar keberagaman, berbagi kisah, dan menyusun aksi bersama.',
            ],
        );

        $category = Category::firstOrCreate(['slug' => 'edukasi'], ['name' => 'Edukasi', 'description' => 'Narasi damai dan edukasi toleransi']);
        $tags = collect(['dialog', 'edukasi', 'digital', 'kerukunan'])
            ->map(fn ($tag) => Tag::firstOrCreate(['slug' => Str::slug($tag)], ['name' => ucfirst($tag)]));

        $post = Post::updateOrCreate(
            ['slug' => 'dialog-lintas-komunitas-dorong-etika-bermedia'],
            [
                'user_id' => $admin->id,
                'category_id' => $category->id,
                'title' => 'Dialog Lintas Komunitas Dorong Etika Bermedia',
                'excerpt' => 'Kegiatan dialog bersama tokoh masyarakat membahas etika bermedia dan narasi damai di ruang digital.',
                'content' => '<p>Forum menghadirkan perwakilan lintas komunitas untuk membahas komunikasi empatik dan pencegahan hoaks demi kerukunan.</p>',
                'status' => 'published',
                'published_at' => now()->subDay(),
                'is_featured' => true,
            ],
        );

        $post->tags()->sync($tags->pluck('id'));

        Program::updateOrCreate(
            ['slug' => 'program-dialog-lintas-iman'],
            [
                'title' => 'Program Dialog Lintas Iman',
                'excerpt' => 'Sesi diskusi rutin untuk merawat empati dan kolaborasi.',
                'description' => 'Menghadirkan tokoh lintas iman untuk berbagi praktik dialog sehat dan kerja kolaboratif.',
                'is_featured' => true,
                'status' => 'published',
                'cta_label' => 'Ikut Sesi',
                'cta_link' => '/kontak',
            ],
        );

        Agenda::updateOrCreate(
            ['slug' => 'lokakarya-moderasi-beragama'],
            [
                'title' => 'Lokakarya Moderasi Beragama',
                'description' => 'Pelatihan singkat bagi fasilitator komunitas.',
                'start_at' => Carbon::now()->addDays(10)->setTime(9, 0),
                'end_at' => Carbon::now()->addDays(10)->setTime(15, 0),
                'location' => 'Balai Harmoni',
                'is_featured' => true,
                'status' => 'published',
                'registration_link' => '/kontak',
            ],
        );

        OrganizationMember::updateOrCreate(
            ['name' => 'Raka Setia'],
            [
                'position' => 'Ketua',
                'photo_path' => null,
                'bio' => 'Fasilitator dialog lintas iman dan edukasi toleransi.',
                'sort_order' => 1,
                'is_active' => true,
            ],
        );

        MediaItem::updateOrCreate(
            ['title' => 'Galeri Dialog Damai'],
            [
                'type' => 'image',
                'media_path' => 'images/sample-gallery.jpg',
                'description' => 'Cuplikan kegiatan dialog lintas komunitas.',
                'is_active' => true,
            ],
        );

        Document::updateOrCreate(
            ['title' => 'Pedoman Kerukunan'],
            [
                'description' => 'Dokumen singkat panduan praktik kerukunan.',
                'file_path' => 'documents/pedoman-kerukunan.pdf',
                'is_active' => true,
                'published_at' => now(),
            ],
        );
    }
}
