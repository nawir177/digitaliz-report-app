<x-admin>
    <div>
         <x-header title="list report" icon="list" urlBack="{{route('admin.report.show',$projectHasReport->report->uuid)}}" />

         <h1 class="text-2xl font-base text-gray-600">Project Name : {{$projectHasReport->project->name}}</h1>


         <div class="relative overflow-x-auto rounded-t-xl mt-6">
             <table class="text-xs w-full text-left rtl:text-right text-gray-500  rounded-t-xl">
                 <thead class=" text-gray-700 uppercase bg-gray-50 rounded-t-xl">
                     <tr>

                         <th scope="col" class="px-6 py-3">
                             No
                         </th>
                         <th scope="col" class="px-6 py-3">
                             Feature
                         </th>
                         <th scope="col" class="px-6 py-3">
                             Image
                         </th>

                     </tr>
                 </thead>
                 <tbody>
                     @if (count($listReports)>0)
                     @foreach ($listReports as $report)
                     <tr class="bg-white border-b  border-gray-200 text-gray-600 text-lg">
                         <td class="px-6 py-4">
                             {{$loop->iteration}}
                         </td>
                         <td class="px-6 py-4">
                             {{$report->content}}
                         </td>
                         <td class="px-6 py-4">
                             <img src="{{$report->image()}}" alt="thumb" width="300">
                         </td>


                     </tr>
                     @endforeach

                     @else
                     <tr class="bg-white border-b  border-gray-200">
                         <th colspan="4" class="text-center text-red-400 px-6 py-3 text-lg font-thin">Not List Report</th>

                     </tr>
                     @endif

                 </tbody>
             </table>
         </div>

    </div>
    <script>
        // Ambil elemen input dan preview
        const imageInput = document.getElementById('imageInput');
        const imagePreviewContainer = document.getElementById('imagePreviewContainer');
        const imagePreview = document.getElementById('imagePreview');

        // Event listener untuk perubahan file input
        imageInput.addEventListener('change', function() {
            const file = this.files[0]; // Ambil file pertama
            if (file) {
                const reader = new FileReader();

                // Ketika file selesai dibaca
                reader.onload = function(e) {
                    imagePreview.src = e.target.result; // Tampilkan gambar di preview
                    imagePreviewContainer.classList.remove('hidden'); // Tampilkan container preview
                };

                reader.readAsDataURL(file); // Baca file sebagai DataURL
            } else {
                // Sembunyikan preview jika tidak ada file
                imagePreviewContainer.classList.add('hidden');
            }
        });

    </script>

</x-admin>

