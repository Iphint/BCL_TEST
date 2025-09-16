# 📦 Logistics Management System (Laravel)

## 🧩 Struktur Proyek

- `app/Models` → Model Eloquent
- `database/migrations` → Skema database
- `app/Http/Controllers` → Controller
- `routes/web.php` → Routing
- `resources/views` → Blade templates

## 🗃️ Database

Tabel:
- `shipments` → Pelacakan pengiriman
- `fleets` → Data armada
- `bookings` → Pemesanan armada
- `location_check_ins` → Check-in lokasi armada

## ▶️ Cara Menjalankan

1. Clone repo
2. `composer install`
6. `php artisan serve`
7. Buka `http://localhost:8000`

## 🔐 Fitur

- Pelacakan pengiriman
- CRUD Armada + Filter
- Pemesanan armada + validasi
- Check-in lokasi peta (Google Maps)
- Laporan pengiriman per armada