# Buku Manual Pengguna (User) — SPECTRUM Evidence

> Dokumen ini ditujukan untuk **pengguna unit/fungsi/program studi** yang mengisi evidence.
> 
> **Catatan editor:** silakan sesuaikan istilah “unit/fungsi/prodi” dengan kebijakan internal kampus.

---

## 1) Tujuan Aplikasi
SPECTRUM Evidence dipakai untuk:
- melihat daftar indikator yang aktif,
- mengirim evidence untuk indikator,
- memantau status review evidence,
- mengelola draft/submission/revisi,
- melihat evidence yang sudah approved,
- dan melihat ringkasan dashboard progres.

<!-- TODO: Tambah screenshot halaman dashboard utama -->

---

## 2) Syarat Akses
Sebelum menggunakan aplikasi:
1. User harus memiliki akun WordPress aktif.
2. User harus punya metadata unit/fungsi (`fungsi_slug`) dari admin.
3. Jika akun belum punya unit/fungsi, halaman Spectrum akan menampilkan pesan bahwa akun belum siap dipakai.

<!-- TODO: Tambah screenshot pesan "Akun Anda belum memiliki fungsi/unit" -->

---

## 3) Struktur Menu Utama
Menu sidebar yang biasa dipakai user:
1. **Dashboard**
2. **Evidence Saya**
3. **Buat Evidence Baru**
4. **SDG & Indikator THE**
5. **Approved Evidence**

---

## 4) Alur Cepat Penggunaan (Ringkas)
1. Buka **SDG & Indikator THE** untuk melihat indikator aktif.
2. Buka **Buat Evidence Baru**.
3. Pilih **Tahun** dan **Kategori** (Mandatory/General).
4. Pilih indikator, isi form evidence.
5. Simpan sebagai **Draft** atau langsung **Submit**.
6. Pantau di **Evidence Saya** sampai status berubah (Submitted/Approved/Rejected).
7. Jika Rejected, edit dan submit ulang.

---

## 5) Panduan Detail per Halaman

## 5.1 Dashboard
Fungsi halaman:
- menampilkan statistik progres pengumpulan evidence,
- progress per unit,
- kontribusi unit,
- status evidence per SDG.

Tips baca data:
- **Jumlah data yang diminta** = total mandatory assignment.
- **Jumlah data dikonfirmasi** = approved + no data.
- **Proses pengumpulan data (%)** = confirmed / requested.

<!-- TODO: Tambah screenshot blok KPI dashboard -->
<!-- TODO: Tambah screenshot chart progress per unit -->

---

## 5.2 SDG & Indikator THE
Fungsi halaman:
- melihat indikator berdasarkan tahun aktif,
- filter by SDG / type / keyword,
- referensi sebelum isi evidence.

Tips:
- cek `metric_question`, `metric_points`, `metric_note` sebelum mengirim evidence,
- pastikan evidence relevan dengan indikator yang dipilih.

<!-- TODO: Tambah screenshot halaman katalog indikator + filter -->

---

## 5.3 Buat Evidence Baru
Langkah pengisian:
1. Pilih **Tahun**.
2. Pilih **Kategori**:
   - **Mandatory**: indikator wajib dari assignment unit.
   - **General**: indikator non-mandatory.
3. Pilih indikator.
4. Baca panel info indikator:
   - Question,
   - Maximum points,
   - Notes.
5. Isi data:
   - Judul evidence,
   - sumber evidence (Link atau File),
   - ringkasan.
6. Jika metrik numeric, isi **Input Numeric Value**.
7. Klik:
   - **Simpan Draft** jika belum final,
   - **Submit** jika siap direview.

Catatan Mandatory:
- Jika benar-benar tidak memiliki data mandatory, centang **Not Available**.
- Status ini diproses sebagai “No Data” untuk mandatory terkait.

<!-- TODO: Tambah screenshot form kosong -->
<!-- TODO: Tambah screenshot panel info indikator -->
<!-- TODO: Tambah screenshot contoh submit berhasil -->

---

## 5.4 Evidence Saya
Fitur utama:
- list evidence milik user,
- filter (tahun/status/sdg/keyword),
- sorting tabel per kolom,
- ekspor CSV,
- buka detail evidence,
- edit evidence tertentu.

Status evidence:
- **DRAFT**: belum dikirim reviewer.
- **SUBMITTED**: sudah dikirim, menunggu review.
- **APPROVED**: disetujui reviewer.
- **REJECTED**: ditolak reviewer, perlu revisi.

Aksi umum:
- klik evidence untuk lihat detail,
- jika status DRAFT/REJECTED, lakukan edit lalu submit ulang.

<!-- TODO: Tambah screenshot tabel Evidence Saya -->
<!-- TODO: Tambah screenshot filter dan tombol export -->

---

## 5.5 Detail Evidence
Di halaman ini user dapat:
- melihat detail data evidence,
- melihat histori log perubahan status,
- melihat catatan review,
- melakukan edit jika status memungkinkan.

Kapan bisa edit?
- Hanya saat status **DRAFT** atau **REJECTED**.

<!-- TODO: Tambah screenshot detail evidence + timeline/log -->

---

## 5.6 Approved Evidence
Fungsi halaman:
- melihat evidence yang sudah approved,
- filter per unit / SDG,
- sorting kolom,
- export CSV.

Catatan:
- halaman ini saat ini bisa diakses user umum yang login.

<!-- TODO: Tambah screenshot halaman approved evidence -->

---

## 6) Export CSV
Dari halaman Evidence Saya / Approved Evidence:
1. Atur filter jika perlu.
2. Klik **Export CSV**.
3. File berisi kolom utama termasuk score review (jika ada).

Catatan teknis:
- newline pada text diekspor dalam bentuk literal `\n` agar struktur CSV stabil saat dibuka.

---

## 7) Troubleshooting (User)

### Kasus A — Tidak bisa masuk halaman Spectrum
Penyebab umum:
- akun belum punya `fungsi_slug`.

Solusi:
- minta admin mengisi unit/fungsi user.

### Kasus B — Indikator tidak muncul di form
Cek:
- tahun aktif sudah benar,
- kategori Mandatory/General sesuai,
- assignment mandatory sudah ada,
- user unit benar.

### Kasus C — Ditolak reviewer
Tindakan:
- buka detail evidence,
- baca catatan reviewer,
- revisi evidence,
- submit ulang.

---

## 8) FAQ (User)
**Q: Kapan saya pilih Draft vs Submit?**  
A: Draft untuk simpan sementara. Submit untuk mengirim ke reviewer.

**Q: Bisa edit evidence setelah submit?**  
A: Tidak langsung. Jika ditolak (Rejected), evidence bisa direvisi dan submit ulang.

**Q: File atau link, pilih yang mana?**  
A: Ikuti standar dokumen unit. Bila ada dokumen resmi, unggah file + link pendukung bila perlu.

---

## 9) Checklist Sebelum Submit
- [ ] Tahun sudah benar
- [ ] Indikator sudah tepat
- [ ] Judul jelas
- [ ] Ringkasan menjawab pertanyaan indikator
- [ ] Link/file valid dan dapat diakses
- [ ] Nilai numeric terisi (jika metrik numeric)
- [ ] Sudah review typo/format

---

## 10) Catatan untuk Tim Dokumentasi
Bagian yang paling butuh screenshot:
1. Alur form dari pilih indikator sampai submit.
2. Contoh status di Evidence Saya.
3. Contoh halaman detail + catatan reviewer.
4. Contoh filter + export CSV.
