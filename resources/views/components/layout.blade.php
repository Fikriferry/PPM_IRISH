<!doctype html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Homepage</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

   @if (Request::is('customer/login') || Request::is('customer/register'))
      <x-navbar_login />
   @else
      <x-navbar />
   @endif



   <div class="container-fluid py-4">
      {{  $slot }}
   </div>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>

   @push('scripts')
      <script>
        document.addEventListener("DOMContentLoaded", function () {
          // Fade-in saat halaman selesai dimuat
          document.body.classList.add('fade-in');

          // Tambahkan event pada semua link internal
          document.querySelectorAll("a").forEach(function (el) {
            const href = el.getAttribute("href");

            // Hanya berlaku untuk link internal
            if (href && !href.startsWith("#") && !href.startsWith("http")) {
               el.addEventListener("click", function (e) {
                 e.preventDefault(); // cegah pindah langsung
                 document.body.classList.remove("fade-in");
                 document.body.classList.add("fade-out");

                 // Tunggu transisi selesai baru pindah halaman
                 setTimeout(function () {
                   window.location.href = href;
                 }, 500);
               });
            }
          });
        });
      </script>
   @endpush

</body>

</html>