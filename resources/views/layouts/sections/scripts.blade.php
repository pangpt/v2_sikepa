<!-- BEGIN: Vendor JS-->
<script src="{{ asset(mix('assets/vendor/libs/jquery/jquery.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/popper/popper.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/js/bootstrap.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/js/menu.js')) }}"></script>
@yield('vendor-script')
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="{{ asset(mix('assets/js/main.js')) }}"></script>
<script>
  // Fungsi untuk menampilkan waktu berjalan, hari, dan tanggal
  function displayTimeAndDay() {
      var currentTime = new Date();
      var hours = currentTime.getHours();
      var minutes = currentTime.getMinutes();
      var seconds = currentTime.getSeconds();

      // Format waktu
      hours = (hours < 10 ? "0" : "") + hours;
      minutes = (minutes < 10 ? "0" : "") + minutes;
      seconds = (seconds < 10 ? "0" : "") + seconds;

      // Ambil nama hari
      var days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
      var currentDay = days[currentTime.getDay()];

      // Ambil tanggal
      var date = currentTime.getDate();

      // Ambil bulan dalam bentuk teks
      var monthNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
      var month = monthNames[currentTime.getMonth()];

      // Ambil tahun
      var year = currentTime.getFullYear();

      // Tampilkan waktu, hari, dan tanggal pada elemen dengan id "current-time", "current-day", dan "current-date"
      document.getElementById("current-time").innerHTML = hours + ":" + minutes + ":" + seconds;
      document.getElementById("current-day").innerHTML = currentDay;
      document.getElementById("current-date").innerHTML = date + " " + month + " " + year;

      // Jalankan fungsi ini setiap detik
      setTimeout(displayTimeAndDay, 1000);
  }

  // Panggil fungsi displayTimeAndDay untuk pertama kali
  displayTimeAndDay();



</script>
@yield('js-after')

<!-- END: Theme JS-->
<!-- Pricing Modal JS-->
@stack('pricing-script')
<!-- END: Pricing Modal JS-->
<!-- BEGIN: Page JS-->
@yield('page-script')
<!-- END: Page JS-->
