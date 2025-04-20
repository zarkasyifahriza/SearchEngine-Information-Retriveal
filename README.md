# 🔍 Search Engine Peraturan Perundang-Undangan

Proyek UTS untuk matakuliah **Information Retrieval**  
Oleh: **Zarkasyi Fahriza (220411100001)**

## 📖 Deskripsi Proyek

Aplikasi ini merupakan search engine sederhana yang digunakan untuk mencari **peraturan perundang-undangan di Indonesia**. Pengguna dapat melakukan pencarian berdasarkan **judul peraturan**, **nomor**, atau **tahun**.  
Aplikasi dibangun menggunakan Laravel (PHP) dan memanfaatkan skrip Python untuk melakukan pemrosesan query berdasarkan dokumen JSON (`list.json`) berisi data peraturan.

---

## 🚀 Fitur Utama

- Pencarian cepat berdasarkan kata kunci
- Filter jumlah hasil pencarian (6, 12, atau 24 hasil)
- Tampilan hasil yang terstruktur: judul, deskripsi, nomor, dan tautan
- Antarmuka responsif berbasis Bootstrap
- Proses pencarian menggunakan Python dan dikembalikan ke Laravel

---

## 🛠️ Teknologi yang Digunakan

- **Laravel 9** - Backend Framework
- **Python 3** - Pemrosesan Query (TF-IDF / Cosine Similarity)
- **Bootstrap 5** - UI Framework
- **jQuery** - AJAX Request
- **JSON** - Format data peraturan

---

## 🧠 Arsitektur Sistem

1. **Frontend**:
   - Pengguna memasukkan kata kunci dan jumlah hasil yang diinginkan.
   - Data dikirim via AJAX ke route `/search`.

2. **Backend (Laravel)**:
   - Route `/search` dijalankan oleh `LandingController@search`.
   - Controller menjalankan skrip Python dengan parameter (data, rank, query).
   - Output JSON dari Python dikonversi ke HTML dan dikembalikan ke frontend.

3. **Python (query.py)**:
   - Membaca data dari `list.json`.
   - Melakukan perhitungan kesesuaian terhadap query pengguna.
   - Mengembalikan hasil terbaik dalam format JSON.

---

## 🔁 Alur Sistem (Ringkasan)

```plaintext
User ➜ Input kata kunci & rank ➜ Tekan "Cari"
  ➜ JavaScript kirim GET ke /search
    ➜ Laravel controller memanggil Python (query.py)
      ➜ Python cari di list.json & kembalikan hasil (JSON)
        ➜ Laravel ubah ke HTML
          ➜ Kirim ke frontend ➜ Tampil di <div id="content">
