# FLIP TEST

## CARA INSTALL
Sebelum kalian menjalankan aplikasi, sebaiknya ikuti cara di bawah ini agar aplikasi berjalan baik.

#### BUAT DATABASE DAN TABEL
Pertama-tama kita buat database dan tabel untuk menyimpan data hasil POST ke API pihak ke-3. Jika kalian menggukan *``VSCODE``* sebagai editor kalian, maka jalankan terminal dan jalankan `` php system/migration.php ``. Jika kalian tidak menggukan editor kalian bisa membuka *Command prompt* lalu arahkan ke folder project/system lalu jalankan command `` php migration.php `` .

## CARA PENGGUNAAN
- Download/Cone project ini, dan pindahkan ke folder web server
- Jalankan ``XAMPP`` atau web server lainnya
- Jalankan proses pembuatan database dan tabel
- Kemudian buka project di browser
- klik ``post data`` untuk membuat random POST ke API
- klik ``cek semua`` untuk melakukan proses cek  semua transaksi yang statusnya masih `PENDING`
- klik ``cek status`` pada list transaksi untuk mengecek status transaksi tersebut
