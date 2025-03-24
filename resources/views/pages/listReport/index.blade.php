<x-app-layout>
    <div class="py-12">
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            {{-- header --}}
             <x-header title="list report" icon="list" urlBack="{{route('report.show',$projectHasReport->report->uuid)}}" />
                      {{-- btn modal --}}
                      <x-btn-modal title="Add List Report" icon="list" />

            <h1 class="text-2xl font-base text-gray-600">Project Name : {{$projectHasReport->project->name}}</h1>

            <!-- Main modal -->
            <div id="authentication-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow-sm border ">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t  border-gray-200">
                            <h3 class="text-xl font-semibold text-gray-900">
                                Add Project
                            </h3>
                            <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center " data-modal-hide="authentication-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5">
                            <form class="space-y-4" action="{{ route('projectHasReport.storeList') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4">
                                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                                    <textarea id="message" name="content" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Write your thoughts here..."></textarea>
                                </div>

                                <div class="mb-4">
                                    <label class="block mb-2 text-sm font-medium text-gray-900" for="small_size">Upload Screenshot</label>
                                    <input name="image" class="block w-full mb-2 text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" id="imageInput" type="file" accept="image/*">
                                    <!-- Preview gambar -->
                                    <div id="imagePreviewContainer" class="mt-4 hidden">
                                        <p class="text-sm text-gray-500 mb-2">Image Preview:</p>
                                        <img id="imagePreview" class="max-w-xs rounded-lg border border-gray-300" alt="Preview" />
                                    </div>
                                </div>

                                <input type="hidden" value="{{ $projectHasReport->id }}" name="projectHasReportId">
                                <button type="submit" class="w-full py-2 rounded-xl bg-blue-700 text-white">Add List</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

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
                            <th scope="col" class="px-6 py-3">
                                Action
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
                                <img src="{{$report->image()}}" alt="thumb" width="150">
                            </td>
                            
                            <td class="px-6 py-4">
                                <div class="flex gap-2 items-center">
                                    <div class="col">
                                        <a href="{{route('projectHasReprot.editList',$report->uuid)}}" class="p-2 rounded-xl bg-amber-400 text-white hover:bg-amber-500 flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                                <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                                            </svg>
                                        </a>
                                    </div>

                                    <div class="col">
                                        <form action="{{route('projectHasReprot.deleteList',$report->uuid)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete p-2 rounded-xl bg-red-300 text-white hover:bg-red-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>

                                </div>
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
            {{-- <div class="mt-4">
                {{$reports->links()}}
        </div> --}}

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

</x-app-layout>

