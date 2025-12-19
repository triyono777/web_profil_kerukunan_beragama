# Web Profil Kerukunan Umat Beragama

Portal profil publik bertema kerukunan umat beragama dengan admin panel untuk berita, konten dinamis, menu, footer, struktur organisasi, agenda, galeri, dan dokumen.

## Fitur Singkat
- Autentikasi admin (Laravel Breeze) + middleware `admin`.
- CRUD berita dengan status draft/published/archived, kategori, tag, cover image, meta SEO, dan featured flag.
- CMS dinamis: menu header, footer (alamat, sosial, quick links), pengaturan situs (hero CTA, kontak, map embed), halaman statis, sections (blok konten per halaman), struktur organisasi.
- Konten lain: program, agenda, galeri media, dokumen unduhan, pesan aspirasi kontak.
- Halaman publik: beranda, profil, berita (search/filter), agenda, program, galeri, dokumen, kontak.

## Persiapan
Pastikan sudah terpasang: PHP 8.2+, Composer, Node.js 18+, dan database (MySQL/PostgreSQL/SQLite).

## Langkah Instalasi
```bash
cp .env.example .env
composer install
php artisan key:generate
# Atur koneksi DB di .env
php artisan migrate --seed
php artisan storage:link
npm install
npm run build   # atau npm run dev selama pengembangan
php artisan serve
```

### Kredensial Admin
- Email: `admin@kerukunan.local`
- Password: `password`

## Struktur Penting
- `app/Models` – Menu, SiteSetting, Footer, Section, Page, Post, Category, Tag, Program, Agenda, MediaItem, Document, OrganizationMember, ContactMessage.
- `app/Http/Controllers/Admin` – Dashboard + CRUD admin.
- `app/Http/Controllers` – Halaman publik (home, berita, profil, program, agenda, galeri, dokumen, kontak).
- `resources/views/admin` – Blade admin menggunakan `x-app-layout`.
- `resources/views/public` + `layouts/public.blade.php` – Tampilan publik dinamis.
- `database/seeders/DatabaseSeeder` – Data awal konten, menu, admin default.

## Catatan Implementasi
- Semua menu/header dan footer diambil dari DB dan dapat diubah via admin.
- Profil dan konten statis memakai `pages` + `sections` (blok konten per halaman); hanya menampilkan yang aktif/published.
- Berita hanya menampilkan status `published` di publik; alur draft → publish sesuai request.
- Upload file tersimpan di `storage/app/public`, akses via `php artisan storage:link`.
- Cache ringan untuk menu, footer, settings di `AppServiceProvider` (hapus otomatis saat update).

## Testing Cepat
Gunakan SQLite untuk uji cepat:
```bash
touch database/database.sqlite
php artisan migrate --seed --database=sqlite
php artisan test
```

## Lisensi
MIT.
