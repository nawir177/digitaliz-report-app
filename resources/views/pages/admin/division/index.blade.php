<x-admin>
    <x-header title="division" icon="user" urlBack="{{route('admin.division.index')}}"/>

    {{-- modal --}}
       <button data-modal-target="addEmployeeModal" data-modal-toggle="addEmployeeModal" class="btn-rejected py-2 px-4 my-4 rounded bg-violet-500 text-white hover:bg-violet-600">Add New Division</button>
             <x-modal name="addEmployeeModal" title="Add Employee" maxWidth="3xl">
                 <form action="{{route('admin.division.store')}}" method="post" enctype="multipart/form-data">
                     @csrf
                     <div class="col mb-4">
                         <label for="name" class="text-gray-700 mb-3">Name</label>
                         <input type="text" name="name" id="name" class="w-full border border-gray-200 rounded p-2 focus:outline-none focus:border-gray-400" placeholder="Name">
                     </div>
                   
                     <button class="py-2 w-full rounded bg-violet-500 hover:bg-violet-600 text-white">Add</button>
                 </form>

             </x-modal>


    {{-- end modal  --}}
     <div class="relative overflow-x-auto rounded-t-xl mt-4">
         <table class="text-xs w-full text-left rtl:text-right text-gray-500 dark:text-gray-400 rounded-t-xl">
             <thead class=" text-gray-700 uppercase bg-gray-50 rounded-t-xl">
                 <tr>
                     <th scope="col" class="px-6 py-3">
                         Name
                     </th>
                   
                     <th scope="col" class="px-6 py-3">
                         Action
                     </th>
                 </tr>

             </thead>
             <tbody>
                 @foreach($divisions as $division)
                 <tr class="bg-white border-b  border-gray-200 text-gray-600">
                     <td class="px-6 py-4">
                            {{$division->name}}
                     </td>
                    
                     <td class="px-6 py-4">
                         <div class="flex gap-2 items-center">
                             <div class="col">
                                 <form action="{{route('admin.division.delete',$division->id)}}" method="post">
                                     @csrf
                                     @method('DELETE')
                                     <button class="btn-delete p-2 rounded-xl bg-red-500 text-white hover:bg-red-600" type="submit">
                                         <x-icon name="trash" class="size-5 text-white" />
                                     </button>

                                 </form>
                             </div>
                             <div class="col">
                                 <a href="{{route('admin.division.edit',$division->id)}}" class="p-2 rounded-xl bg-blue-700 text-white hover:bg-blue-500 flex">
                                     <x-icon name="pencil" class="size-5 text-white" />
                                 </a>
                             </div>
                         </div>

                     </td>
                 </tr>
                 @endforeach
         </table>
     </div>

</x-admin>