<x-app-layout>
    <div class="py-12">
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            {{-- header --}}
           <x-header title="Edit List Report" icon="list" urlBack="{{route('projectHasReport.list',$list->projectHasReport->uuid)}}" />

            <div class="w-full p-4 rounded border mx-auto my-6 bg-white">
               <form class="space-y-4" action="{{ route('projectHasReprot.updateList',$list->uuid) }}" method="post" enctype="multipart/form-data">
                   @csrf
                   @method('PATCH')
                   <div class="mb-4">
                       <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                       <textarea id="message" name="content" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Write your thoughts here...">{{$list->content}}</textarea>
                   </div>

                   <div class="mb-4">
                       <label class="block mb-2 text-sm font-medium text-gray-900" for="small_size">Upload Screenshot</label>
                       <input name="image" class="block w-full mb-8 text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" id="imageInput" type="file" accept="image/*">
                       <img src="{{$list->image()}}" alt="testing" width="300" id="imageOld">
                       <div id="imagePreviewContainer" class="mt-4 hidden">
                           <p class="text-sm text-gray-500 mb-2">Image Preview:</p>
                           <img id="imagePreview" class="max-w-xs rounded-lg border border-gray-300" alt="Preview" src="{{$list->image()}}" />
                       </div>

                   </div>
                   <button type="submit" class="w-full py-2 rounded-xl bg-blue-700 text-white">Update List</button>
               </form>

            </div>
        </div>
    </div>

  <script>
      // Ambil elemen input dan preview
      const imageInput = document.getElementById('imageInput');
      const imagePreviewContainer = document.getElementById('imagePreviewContainer');
      const imagePreview = document.getElementById('imagePreview');
      const imageOld =document.getElementById('imageOld');


      // Event listener untuk perubahan file input
      imageInput.addEventListener('change', function() {
          const file = this.files[0]; // Ambil file pertama
          if (file) {
              const reader = new FileReader();

              // Ketika file selesai dibaca
              reader.onload = function(e) {
                  imagePreview.src = e.target.result; // Tampilkan gambar di preview
                  imagePreviewContainer.classList.remove('hidden'); // Tampilkan container preview
                  imageOld.classList.add('hidden');
              };

              reader.readAsDataURL(file); // Baca file sebagai DataURL
          } else {
              // Sembunyikan preview jika tidak ada file
              imagePreviewContainer.classList.add('hidden');
          }
      });

  </script>

</x-app-layout>
