# Agent: Web Profil Kerukunan Umat Beragama
## Dengan Admin Manajemen Berita + Manajemen Konten Dinamis (Fullstack Laravel)

---

## 1. Konteks & Tujuan
Website ini adalah **web profil resmi** bertema *Kerukunan Umat Beragama* yang berfungsi sebagai:
1. Media informasi publik (profil, program, agenda, galeri, dokumen).
2. Media publikasi berita dan artikel edukatif.
3. Sarana aspirasi dan komunikasi masyarakat.
4. Portal admin untuk mengelola berita **dan seluruh konten halaman** (menu, footer, profil, struktur organisasi, dsb).

Website harus **netral, edukatif, inklusif**, dan tidak memuat konten yang menyinggung SARA.

---

## 2. Target Pengguna
- **Publik:** masyarakat umum, komunitas lintas agama, media.
- **Admin:** pengelola konten (halaman, menu, footer, berita, kategori, tag, media).

---

## 3. Fitur Inti (Ringkasan)
### Publik
- Beranda, Profil, Program, Berita, Agenda, Galeri, Dokumen, Kontak/Aspirasi.
- Pencarian dan filter berita.
- SEO dasar + Open Graph untuk berita.

### Admin
- Login admin
- CRUD berita + kategori + tag + media
- **CMS Konten Dinamis:** semua menu dan konten halaman bisa diedit via admin:
  - Navigasi/menu (urutan, label, aktif/nonaktif, link internal/eksternal)
  - Footer (alamat, jam layanan, sosial media, link cepat, copyright)
  - Profil (latar belakang, visi-misi, nilai, legalitas)
  - Struktur organisasi (list anggota + jabatan + foto)
  - Konten halaman statis (tentang, kebijakan privasi, dsb)
  - Pengaturan kontak (email/WA/Google Maps embed)
  - Halaman beranda: highlight (berita unggulan, program unggulan, testimoni)

---

## 4. Wireframe Sederhana (Struktur Layout)

### 4.1 Halaman Publik

#### A. Beranda (`/`)
- Header: Logo + Menu dinamis
- Hero: Judul + tagline + CTA (dinamis)
- Highlight berita (otomatis terbaru / dipilih admin)
- Agenda terdekat
- Program unggulan (dipilih admin)
- Galeri singkat
- Footer dinamis

#### B. Profil (`/profil`)
- Latar belakang (editable)
- Visi & Misi (editable)
- Nilai-nilai (editable)
- Struktur organisasi (editable list)
- Legalitas (editable: dokumen/unduhan)

#### C. Program (`/program`)
- List program + filter (opsional)
- Konten intro halaman (editable)

#### D. Berita (`/berita`) & Detail (`/berita/{slug}`)
- Search + filter kategori/tag
- Detail berita + related

#### E. Agenda (`/agenda`)
- List agenda (opsional CRUD agenda)

#### F. Galeri (`/galeri`)
- Foto + video (opsional CRUD galeri)

#### G. Dokumen (`/dokumen`)
- List dokumen (opsional CRUD dokumen)

#### H. Kontak (`/kontak`)
- Info kontak + peta (editable)
- Form aspirasi (tersimpan)

---

### 4.2 Halaman Admin

#### A. Login (`/admin/login`)
- Email + password

#### B. Dashboard (`/admin`)
- Statistik: berita draft/publish, pesan masuk, konten yang terakhir diedit

#### C. Manajemen Berita (`/admin/berita`)
- Search, filter status, CRUD

#### D. **Manajemen Konten Situs (CMS)**
Menu admin baru:
- `/admin/menu` → kelola navigasi header
- `/admin/footer` → kelola footer
- `/admin/pages` → kelola halaman statis (profil, latar belakang, kebijakan, dll)
- `/admin/organization` → kelola struktur organisasi
- `/admin/settings` → pengaturan umum (logo, warna dasar opsional, kontak, map embed)
- `/admin/home` → pengaturan konten beranda (hero, highlight, program unggulan, testimoni)

---

## 5. User Flow Admin (Draft → Publish)
1. Admin login
2. Tambah berita → isi konten → simpan draft
3. Preview → publish
4. Edit ulang kapan saja → update
5. Archive/unpublish jika diperlukan

Status:
- `draft` / `published` / `archived`

---

## 6. Template Konten Awal

### Visi
“Mewujudkan kehidupan bermasyarakat yang damai, inklusif, dan saling menghormati dalam keberagaman.”

### Misi
1. Mendorong dialog lintas agama yang konstruktif.
2. Mengembangkan edukasi toleransi dan kebhinekaan.
3. Memperkuat kolaborasi sosial dan kemanusiaan.
4. Menyediakan informasi yang transparan dan bertanggung jawab.

### Nilai
- Toleransi
- Inklusif
- Dialog
- Gotong Royong
- Kemanusiaan

### Contoh Berita Netral
Judul: Dialog Lintas Komunitas Dorong Etika Bermedia dan Kerukunan  
Excerpt: Kegiatan dialog bersama tokoh masyarakat membahas etika bermedia dan narasi damai di ruang digital.  
Konten: Forum menghadirkan perwakilan lintas komunitas untuk membahas komunikasi empatik dan pencegahan hoaks demi kerukunan.

---

## 7. Spesifikasi Fullstack Laravel

### 7.1 Teknologi
- Laravel 10/11
- Blade + Tailwind + Alpine (disarankan) atau Inertia
- Auth: Laravel Breeze / Jetstream
- Database: MySQL / PostgreSQL
- Storage: local public + S3/R2
- Editor: Rich text (HTML) atau Markdown + preview

---

## 7.2 Data Model (Tambahan CMS)

### 7.2.1 Konten Halaman Statis
**pages**
- id
- key (unik, misal: `profil`, `latar_belakang`, `kebijakan_privasi`)
- title
- content (HTML/Markdown)
- status (published/draft)
- updated_by
- timestamps

> Alternatif lebih fleksibel: **sections** (blok konten per halaman)

**sections**
- id
- page_key (misal `home`, `profil`)
- section_key (misal `hero`, `visi_misi`, `nilai`)
- title (nullable)
- content (text/html)
- json_data (nullable) untuk data terstruktur
- sort_order
- is_active
- timestamps

### 7.2.2 Menu Navigasi (Header)
**menus**
- id
- label
- type (`internal`|`external`)
- url (misal `/profil` atau `https://...`)
- parent_id (nullable) untuk dropdown
- sort_order
- is_active
- timestamps

### 7.2.3 Footer
**footers** (atau **settings**)
- id
- address (text)
- phone (nullable)
- email (nullable)
- whatsapp (nullable)
- map_embed (text)
- social_links (json) [{platform, url}]
- quick_links (json) [{label, url}]
- copyright_text
- timestamps

### 7.2.4 Struktur Organisasi
**organization_members**
- id
- name
- position
- photo_path (nullable)
- sort_order
- is_active
- timestamps

### 7.2.5 Pengaturan Umum Situs
**site_settings**
- id
- site_name
- logo_path
- favicon_path (nullable)
- primary_color (nullable)
- contact_email
- contact_whatsapp
- office_hours (nullable)
- timestamps

---

## 7.3 Routing

### Publik
- GET / → HomeController@index (render berdasarkan sections/settings/menu/footer)
- GET /{pageKey} → PageController@show (ambil dari pages/sections)
- GET /berita → PostController@index
- GET /berita/{slug} → PostController@show
- GET /kontak → ContactController@index
- POST /kontak → ContactController@store

### Admin (middleware auth + role admin)
- /admin
- /admin/berita (CRUD)
- /admin/kategori (CRUD)
- /admin/tag (CRUD)
- /admin/media
- /admin/pages (CRUD halaman statis)
- /admin/sections (CRUD blok konten per halaman)
- /admin/menu (CRUD menu)
- /admin/footer (edit footer)
- /admin/organization (CRUD struktur organisasi)
- /admin/settings (edit pengaturan situs)

---

## 7.4 Validasi (Laravel Form Request)
### Berita
- title: required|min:5
- slug: unique
- excerpt: required|max:300
- content: required
- cover_image: image|mimes:jpg,png,webp|max:2048
- category_id: required
- tags: array
- status: in:draft,published,archived

### Menu
- label: required
- type: required|in:internal,external
- url: required
- sort_order: integer
- is_active: boolean

### Page/Section
- key/page_key: required|unique
- content: required
- json_data: valid json (nullable)

### Footer/Settings
- map_embed: string (sanitize)
- social_links/quick_links: json

---

## 7.5 Keamanan & Konten
- Hash password default Laravel
- CSRF protection
- Rate limit login
- Sanitasi konten HTML (wajib bila pakai rich text HTML)
- Validasi upload dan pembatasan ukuran file

---

## 8. Deliverables
1. Laravel project + auth admin
2. Migrasi + seeder admin default
3. Halaman publik dinamis (menu, footer, konten dari DB)
4. Admin panel:
   - berita, kategori, tag, media
   - pages/sections (CMS)
   - menu manager
   - footer/settings
   - struktur organisasi
5. README.md (setup lokal + env vars + deployment notes)

---

## 9. Acceptance Criteria
- Semua menu yang tampil di header berasal dari DB dan dapat diatur admin (label, urutan, aktif/nonaktif, dropdown).
- Footer berasal dari DB dan dapat diedit admin.
- Konten Profil (latar belakang, visi-misi, nilai, legalitas) dapat diedit admin.
- Struktur organisasi dapat diubah admin (tambah/edit/hapus/urutan).
- Berita memiliki alur draft → preview → publish.
- Halaman publik hanya menampilkan konten berstatus published dan aktif.
- Responsif mobile, SEO dasar, dan tidak ada konten sensitif/ujaran kebencian.

---
