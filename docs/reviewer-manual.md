# Buku Manual Reviewer — SPECTRUM Evidence

> Dokumen ini untuk reviewer yang melakukan verifikasi evidence dan memberi keputusan.

---

## 1) Peran Reviewer
Reviewer bertugas untuk:
- memeriksa evidence yang masuk,
- menilai kelengkapan/ketepatan,
- memberi keputusan **Approve** atau **Reject**,
- memberi score saat approve,
- memberi catatan evaluasi.

---

## 2) Hak Akses Reviewer
Akses reviewer ditentukan oleh:
1. Role/capability WordPress reviewer/admin.
2. **Reviewer scope** (jika diaktifkan): membatasi evidence yang boleh dilihat/diproses.

Dampak scope:
- evidence di luar scope tidak tampil di queue,
- dan tidak bisa diproses walaupun user memanipulasi request.

<!-- TODO: Tambah screenshot reviewer scope di database/admin page (jika nanti ada UI) -->

---

## 3) Menu yang Digunakan Reviewer
Menu utama reviewer:
1. Dashboard
2. Evidence untuk Direview
3. Approved Evidence
4. (opsional) halaman user lainnya untuk audit

---

## 4) Alur Review Standar
1. Buka **Evidence untuk Direview**.
2. Filter/sort data jika perlu.
3. Buka detail evidence.
4. Cek:
   - kesesuaian dengan metric question,
   - kualitas bukti (dokumen/link),
   - kecocokan periode data,
   - konsistensi ringkasan vs dokumen.
5. Ambil keputusan:
   - **Approve** → wajib isi score,
   - **Reject** → wajib isi alasan.
6. Simpan review.
7. Pantau hasil di **Approved Evidence** / queue.

---

## 5) Aturan Keputusan

## 5.1 Approve
Syarat minimum:
- evidence valid,
- relevan dengan indikator,
- dapat diverifikasi.

Saat approve:
- isi score (range 1–5),
- opsional tambahkan catatan penguatan.

## 5.2 Reject
Reject jika:
- bukti tidak relevan,
- bukti tidak cukup/invalid,
- data tidak menjawab pertanyaan indikator,
- lampiran/link tidak dapat diverifikasi.

Saat reject:
- alasan **wajib diisi** secara spesifik.

Contoh catatan reject yang baik:
- “Dokumen belum menunjukkan data periode yang diminta (2024/2025).”
- “Link mengarah ke halaman umum, tidak ada bukti indikator 2.3.3.”

---

## 6) Score Review (1–5)
Contoh rubric sederhana (silakan sesuaikan internal):
- **1**: bukti sangat minim/tidak meyakinkan.
- **2**: bukti ada tapi kualitas rendah.
- **3**: bukti cukup, masih ada kekurangan minor.
- **4**: bukti baik, valid, relevan.
- **5**: bukti sangat kuat, lengkap, dan jelas.

Catatan:
- score akan tersimpan pada log review (format catatan review),
- score juga muncul di export CSV yang relevan.

---

## 7) Reviewer Scope (Implementasi)
Jika reviewer scope dipakai, data scope minimal berisi:
- `reviewer_id`
- salah satu / kombinasi:
  - `unit_code`,
  - `metric_id`,
  - `sdg_number`.

Prinsip filter:
- jika reviewer **tidak punya scope rows**: reviewer melihat semua (fallback open).
- jika reviewer **punya scope rows**: hanya evidence yang match scope.

<!-- TODO: Tambah screenshot contoh data scope reviewer -->

---

## 8) Approved Evidence
Reviewer dapat:
- memfilter evidence approved,
- mengecek kualitas outcome,
- export CSV untuk rekap.

Kolom score dapat dipakai untuk audit mutu review.

---

## 9) Dashboard untuk Reviewer
Dashboard membantu reviewer melihat:
- progres mandatory per unit,
- kontribusi general per unit,
- status evidence per SDG.

Jika fakultas agregat aktif:
- reviewer dapat melihat capaian level fakultas,
- tetap bisa drill ke unit/prodi.

<!-- TODO: Tambah screenshot dashboard reviewer -->

---

## 10) SOP Operasional Reviewer (Disarankan)

### Harian
- cek queue evidence submitted,
- review evidence prioritas,
- pastikan catatan review jelas.

### Mingguan
- audit konsistensi score antar reviewer,
- evaluasi evidence yang sering rejected,
- koordinasi feedback ke unit.

### Bulanan
- rekap approved/rejected,
- analisis SDG/metric dengan gap evidence tinggi,
- usulkan perbaikan guidance pengisian user.

---

## 11) Troubleshooting Reviewer

### Kasus A — Evidence tidak muncul di queue
Cek:
- status evidence memang SUBMITTED,
- scope reviewer membatasi data,
- tahun/filter di halaman.

### Kasus B — Tidak bisa approve/reject
Cek:
- evidence di luar scope,
- nonce/session expired,
- permission reviewer.

### Kasus C — Score tidak muncul di export
Cek:
- review approve disimpan dengan score,
- catatan log review tersedia,
- evidence sudah masuk hasil query export.

---

## 12) FAQ Reviewer
**Q: Bolehkah approve tanpa score?**  
A: Tidak, score wajib saat approve.

**Q: Bolehkah reject tanpa alasan?**  
A: Tidak, alasan wajib diisi.

**Q: Apakah reviewer bisa memproses evidence di luar scope?**  
A: Tidak, sistem menolak proses di luar scope (jika scope aktif untuk reviewer tsb).

---

## 13) Checklist Review per Evidence
- [ ] Indikator yang dipilih sudah tepat
- [ ] Bukti valid dan bisa diverifikasi
- [ ] Periode data sesuai
- [ ] Ringkasan evidence konsisten dengan bukti
- [ ] Keputusan approve/reject sudah sesuai
- [ ] Catatan reviewer jelas dan actionable
- [ ] Score terisi (jika approve)

---

## 14) Catatan untuk Tim Dokumentasi
Sisipkan screenshot pada:
1. Halaman queue reviewer.
2. Form approve/reject (dengan score & notes).
3. Contoh evidence good vs bad.
4. Dashboard reviewer dan interpretasinya.
