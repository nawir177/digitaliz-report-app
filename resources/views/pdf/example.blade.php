<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <style>
                @page {
                margin: 2cm; /* Atur margin halaman */
                }


        body {
            font-family: 'Times New Roman', Times, serif;
        }
         img {
         max-width: 100%;
         height: auto;
         }
     hr{
     height: 10px;
     border: none; /* Menghilangkan border default */
     background: linear-gradient(to right, blue, purple); /* Gradasi dari biru ke ungu */
     }


    </style>
</head>
<body>
  <img src="{{ public_path('/logo.png') }}" alt="Gambar Contoh" width="200">
  <hr style="border: none; height: 2px; background: black; margin-top: 40px; margin-bottom: 60px">

  <h2>Laporan Bulan : {{ \Carbon\Carbon::parse($report->start_date)->translatedFormat('F Y') }}</h2>

    <ul>
        <li>Nama : {{$report->user->name}}</li>
        <li>Divisi : Programmer</li>
        <li>Masa Pengerjaan : {{ \Carbon\Carbon::parse($report->start_date)->translatedFormat('d F Y') }} - {{ \Carbon\Carbon::parse($report->end_date)->translatedFormat('d F Y') }}</li>
    </ul>

    @foreach ($projectHasReport as $item)
    <h2 style="margin-top: 40px; margin-bottom: 30px">Nama Project : {{$item->project->name}}</h2>
    <table border="1" cellpadding="6" cellspacing='0'>
        <tr>
            <th>No</th>
            <th style="width: 300px">Deskripsi</th>
            <th>Dokumentasi Gambar</th>
        </tr>
        @foreach ($item->listReport as $list)
        
        <tr>
            <td style="padding: 2; text-align: center">{{$loop->iteration}}</td>
            <td>{{$list->content}} </td>
            <td><img src="{{ public_path('storage/'.$list->getOrder().'/'.$list->getMedia('images')[0]['file_name']) }}" alt="gambar" width="250"></td>
        </tr>
        @endforeach
    </table>
    @endforeach


</body>
</html>

