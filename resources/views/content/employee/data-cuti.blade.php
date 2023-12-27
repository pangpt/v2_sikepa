<h6 class="mb-4 text-muted"><span class="tf-icons bx bx-info-circle"></span>Khusus admin/kasubag kepegawaian dapat mengubah sisa cuti tahunan dengan mengklik kolom sisa pada tabel kemudian tekan tombol 'enter'</h6>

<table class="table table-bordered">
  <thead>
    <tr>
        <th class="text-nowrap">Cuti</th>
        <th class="text-nowrap text-center">Tahun</th>
        <th class="text-nowrap text-center">Sisa</th>
    </tr>
</thead>
<tbody>
    @php
    $tahunSekarang = date("Y");
    $tahunSebelumnya2 = $tahunSekarang - 2;
    @endphp

    @for ($tahun = $tahunSebelumnya2; $tahun <= $tahunSekarang; $tahun++)
    <tr>
        <td class="text-nowrap">Tahunan</td>
        <td>
            {{ $tahun }}
        </td>
        <td contenteditable="{{ $isAdmin ? 'true' : 'false' }}" class="edit-sisa-cuti" data-employee-id="{{ $pegawaidetail->id }}" data-tahun="{{$tahun}}">
            @foreach ($leave_employee as $cuti)
                @if ($cuti->tahun == $tahun)
                    {{ $cuti->jumlah_cuti ?? 0}}
                @endif
            @endforeach
        </td>
    </tr>
    @endfor
</tbody>

</table>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
// $('.edit-sisa-cuti').on('blur', function () {
  $('.edit-sisa-cuti').on('keydown', function (event) {
    if (event.key === 'Enter') {
        event.preventDefault(); // Mencegah perubahan baris saat menekan "Enter"
        $(this).blur(); // Menghilangkan fokus dari sel saat menekan "Enter"

    var newValue = $(this).text().trim();
    var tahun = $(this).closest('tr').find('td:eq(1)').text().trim();
    var employeeId = $(this).data('employee-id'); // Dapatkan employee_id dari atribut data
    console.log(newValue)
    console.log(tahun)
    console.log(employeeId)

    $.ajax({
        url: '/profil-pegawai/pns/updateCell',
        method: 'POST',
        data: {
            tahun: tahun,
            newValue: newValue,
            employee_id: employeeId, // Sertakan employee_id dalam permintaan
            "_token": "{{ csrf_token() }}"
        },
        success: function (response) {
            if (response.success) {
                // alert('Data cuti berhasil diperbarui.');
                swal('Sukses', 'Data cuti berhasil diperbarui', 'success');
            } else {
                swal('Maaf', 'Gagal memperbarui data cuti', 'error');
            }
        },
        error: function () {
            swal('Maaf','Terjadi kesalahan. Silakan coba lagi.','error');
        }
    });
  }
});

</script>


