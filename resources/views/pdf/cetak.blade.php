<!DOCTYPE html>
<html>
<head>
    <title>Izin Cuti</title>
</head>
<style>
  @page {
      size: A4; /* Atur ukuran halaman menjadi Legal */
      margin: 0.5 cm; /* Atur margin sesuai kebutuhan Anda */
      font-size: 10px;
      font-weight: bold;
  }
  /* Mengatur border-collapse untuk menghindari celah antar sel */
table {
    border-collapse: collapse;
    width: 100%; /* Menyesuaikan lebar tabel dengan lebar parent */
}

/* Gaya untuk sel tabel */
table td, table th {
    border: 1px solid #000000; /* Membuat garis tepi (border) dengan warna abu-abu (#ddd) */
    padding: 2px; /* Memberikan jarak dalam sel */
    text-align: left; /* Menyusun teks ke kiri dalam sel */
}

#myTable {
            border-collapse: collapse; /* Menghapus garis batas antara sel-sel tabel */
            width: 100%; /* Lebar tabel 100% dari kontainer */
        }

        #myTable, #myTable th, #myTable td {
            border: none; /* Menghilangkan batas di sel, header, dan tabel */
        }

</style>
<body>
  <table id="myTable">
    <tr>
      <td width="30%"></td>
      <td width="30%"></td>
      <td><h3>Watampone, {{strftime('%d %B %Y', strtotime(\Carbon\Carbon::now()))}} <br> Yth. Ketua Pengadilan Agama Watampone<br>di<br>Watampone.</h3></td>
    </tr>
  </table>
    <h3 style="text-align: center">FORMULIR PERMINTAAN DAN PEMBERIAN CUTI</h3>

    <table>
      <tr>
          <td colspan="4" style="font-weight: bold;">I. DATA PEGAWAI</td>
      </tr>
      <tr>
          <td>NAMA</td>
          <td>{{$cuti->employee->nama}}</td>
          <td>NIP</td>
          <td>{{$cuti->employee->nip}}</td>
      </tr>
      <tr>
          <td>JABATAN</td>
          <td>{{$cuti->employee->department->nama_jabatan}}</td>
          <td>MASA KERJA</td>
          <td>{{$pegawai->masaKerja()}}</td>
      </tr>
      <tr>
          <td>UNIT KERJA</td>
          <td colspan="3">{{$cuti->employee->department->kategori}}</td>
      </tr>
  </table>
  <br>
  <table>
    <tr>
        <td colspan="4" style="font-weight: bold;">II. JENIS CUTI YANG DIAMBIL</td>
    </tr>
    <tr>
        <td>1. CUTI TAHUNAN</td>
        <td>{{$cuti->jenis_cuti == 'Cuti Tahunan' ? 'V' : ''}}</td>
        <td>2. CUTI BESAR</td>
        <td>{{$cuti->jenis_cuti == 'Cuti Besar' ? 'V' : ''}}</td>
    </tr>
    <tr>
      <td>3. CUTI SAKIT</td>
      <td>{{$cuti->jenis_cuti == 'Cuti Sakit' ? 'V' : ''}}</td>
      <td>4. CUTI MELAHIRKAN</td>
      <td>{{$cuti->jenis_cuti == 'Cuti Melahirkan' ? 'V' : ''}}</td>
    </tr>
    <tr>
      <td>5. CUTI KARENA ALASAN PENTING</td>
      <td>{{$cuti->jenis_cuti == 'Alasan Penting' ? 'V' : ''}}</td>
      <td>6. CUTI DI LUAR TANGGUNGAN NEGARA</td>
      <td>{{$cuti->jenis_cuti == 'Di Luar Tanggungan Negara' ? 'V' : ''}}</td>
    </tr>
</table>
<br>
<table>
  <tr>
      <td style="font-weight: bold;">III. ALASAN CUTI</td>
  </tr>
  <tr>
      <td>Nonton Bola</td>
  </tr>
</table>
<br>
<table>
  <tr>
      <td colspan="6" style="font-weight: bold;">IV. LAMANYA CUTI</td>
  </tr>
  <tr>
      <td>Selama</td>
      <td>{{$cuti->jumlah_hari}} hari</td>
      <td>Mulai Tanggal</td>
      <td>{{ \Carbon\Carbon::parse($cuti->periode_awal)->format('d F Y') }}</td>
      <td>s/d</td>
      <td>{{ \Carbon\Carbon::parse($cuti->periode_akhir)->format('d F Y') }}</td>
  </tr>
</table>
<br>
<table>
  <tr>
      <td colspan="5" style="font-weight: bold;">V. CATATAN CUTI</td>
  </tr>
  <tr>
      <td colspan="3">1. CUTI TAHUNAN</td>
      <td>2. CUTI BESAR</td>
      <td></td>
  </tr>
  <tr>
    <td>TAHUN</td>
    <td>SISA</td>
    <td>KETERANGAN</td>
    <td>3. CUTI SAKIT</td>
    <td></td>
  </tr>
  <tr>
    <td>2021</td>
    <td>{{@$sisaLast->jumlah_cuti}}</td>
    <td></td>
    <td>4. CUTI MELAHIRKAN</td>
    <td></td>
  </tr>
  <tr>
    <td>2022</td>
    <td>{{@$sisaPast->jumlah_cuti}}</td>
    <td></td>
    <td>5. CUTI KARENA ALASAN PENTING</td>
    <td></td>
  </tr>
  <tr>
    <td>2023</td>
    <td>{{@$sisaNow->jumlah_cuti}}</td>
    <td>Diambil {{$cuti->jumlah_hari}} hari, sisa {{@$sisaNow->jumlah_cuti}} hari</td>
    <td>6. CUTI DI LUAR TANGGUNGAN NEGARA</td>
    <td></td>
  </tr>
</table>
<br>
<table>
  <tr>
      <td colspan="3" style="font-weight: bold;">VI. ALAMAT SELAMA MENJALANKAN CUTI</td>
  </tr>
  <tr>
      <td rowspan="2" width="50%">{{$cuti->alamat_cuti}}</td>
      <td>Telp</td>
      <td>{{$cuti->phone_cuti}}</td>
  </tr>
  <tr>
    <td colspan="2"><div style="text-align: center">
      <p style="margin: 0;">Hormat Saya,</p>
      <img src="data:image/png;base64,{{ base64_encode($signatureQR) }}" alt="QR Code" style="margin:0">
      <p style="margin:0">{{$cuti->employee->nama}}</p>
      <p style="margin:0">NIP. {{$cuti->employee->nip}}</p>
  </div></td>
  </tr>
</table>
<br>
<table>
  <tr>
      <td colspan="4" style="font-weight: bold;">VII. PERTIMBANGAN ATASAN LANGSUNG</td>
  </tr>
  <tr>
      <td>DISETUJUI</td>
      <td>PERUBAHAN</td>
      <td>DITANGGUHKAN</td>
      <td>TIDAK DISETUJUI</td>
  </tr>
  <tr style="color:white">
    <td>v</td>
    <td>v</td>
    <td>v</td>
    <td>v</td>
  </tr>
  <tr>
    <td style="border:none"></td>
    <td style="border:none"></td>
    <td style="border:none"></td>
    <td><div style="text-align: center">
      <p style="margin:0">{{$cuti->atasan->department->nama_jabatan}} {{$infoSatker->nama_satker}},</p>
      <img style="margin:0" src="data:image/png;base64,{{ base64_encode($signatureQR) }}" alt="QR Code">
      <p style="margin:0">{{$cuti->atasan->nama}}</p>
      <p style="margin:0">NIP. {{$atasanLangsung->nip}}</p>
  </div></td>
  </tr>
</table>
<br>
<table>
  <tr>
      <td colspan="4" style="font-weight: bold;">VIII. KEPUTUSAN PEJABAT YANG BERWENANG MEMBERIKAN CUTI</td>
  </tr>
  <tr>
      <td>DISETUJUI</td>
      <td>PERUBAHAN</td>
      <td>DITANGGUHKAN</td>
      <td>TIDAK DISETUJUI</td>
  </tr>
  <tr style="color:white">
    <td>v</td>
    <td>v</td>
    <td>v</td>
    <td>v</td>
  </tr>
  <tr>
    <td style="border:none"></td>
    <td style="border:none"></td>
    <td style="border:none"></td>
    <td><div style="text-align: center">
      <p style="margin:0">Ketua {{$infoSatker->nama_satker}},</p>
      <img style="margin:0" src="data:image/png;base64,{{ base64_encode($signatureQR) }}" alt="QR Code">
      <p style="margin:0">{{$ketua->nama}}</p>
      <p style="margin:0">NIP. {{$ketua->nip}}</p>
  </div></td>
  </tr>
</table>
</body>
</html>
