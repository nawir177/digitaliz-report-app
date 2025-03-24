<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="hidden-scroll">
    @include('sweetalert::alert')
    {{-- navbar --}}
    @include('layouts.navbar')
    {{-- Sidebar --}}
    @include('layouts.sidebar')
    {{-- Content --}}

    <div class="p-4 sm:ml-64 pt-20 bg-gray-100 min-h-screen">
        {{$slot}}
    </div>



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.0.0/dist/flowbite.min.js"></script>
    @stack('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".btn-confirm").forEach(button => {
                button.addEventListener("click", function(event) {
                    event.preventDefault(); // Mencegah form langsung terkirim

                    const form = this.closest("form"); // Ambil form terdekat
                    Swal.fire({
                        title: "Apakah Anda yakin?"
                        , icon: "question"
                        , showCancelButton: true
                        , confirmButtonColor: "#0EA7D4"
                        , cancelButtonColor: "#EB268E"
                        , confirmButtonText: "Ya, lanjutkan!"
                        , cancelButtonText: "Batal",
                        roundness: 20
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // Submit form jika dikonfirmasi
                        }
                    });
                });
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".btn-delete").forEach(button => {
                button.addEventListener("click", function(event) {
                    event.preventDefault(); // Mencegah form langsung terkirim

                    const form = this.closest("form"); // Ambil form terdekat
                    Swal.fire({
                        title: "Apakah Anda yakin?"
                        , text: "Data yang dihapus tidak bisa dikembalikan!"
                        , icon: "warning"
                        , showCancelButton: true
                        , confirmButtonColor: "#d33"
                        , cancelButtonColor: "#3085d6"
                        , confirmButtonText: "Ya, hapus!"
                        , cancelButtonText: "Batal"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // Submit form jika dikonfirmasi
                        }
                    });
                });
            });
        });

    </script>
 



</body>
</html>
