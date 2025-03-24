<x-admin>
    <x-header title="employee" icon="user" urlBack="{{route('admin.employee.index')}}"/>
    {{-- empoyee table --}}
         <button data-modal-target="addEmployeeModal" data-modal-toggle="addEmployeeModal" class="btn-rejected py-2 px-4 my-6 rounded bg-red-500 text-white hover:bg-red-400">Add New Emloyee</button>

         <x-modal name="addEmployeeModal" title="Add Employee" maxWidth="3xl">
            {{-- form add employee --}}
            <form action="{{route('admin.employee.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="col mb-4">
                    <label for="name" class="text-gray-700 mb-3">Name</label>
                    <input type="text" name="name" id="name" class="w-full border border-gray-200 rounded p-2 focus:outline-none focus:border-gray-400" placeholder="Name">
                </div>
                <div class="col mb-4">
                    <label for="email" class="text-gray-700 mb-3">Email</label>
                    <input type="email" name="email" id="email" class="w-full border border-gray-200 rounded p-2 focus:outline-none focus:border-gray-400" placeholder="Email">
                </div>
                <div class="col mb-4">
                    <label for="password" class="text-gray-700 mb-3">Password</label>
                    <input type="password" name="password" id="password" class="w-full border border-gray-200 rounded p-2 focus:outline-none focus:border-gray-400" placeholder="Password">
                </div>
                <div class="col mb-4">
                    <label for="division" class="text-gray-700 mb-3">Division</label>
                    <select name="division_id" id="division_id" class="w-full border border-gray-200 rounded p-2 focus:outline-none focus:border-gray-400">
                        @foreach($divisions as $division)
                        <option value="{{$division->id}}">{{$division->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col mb-4">
                    <label for="role" class="text-gray-700 mb-3">Role</label>
                    <select name="role" id="role" class="w-full border border-gray-200 rounded p-2 focus:outline-none focus:border-gray-400">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
               <button class="py-2 w-full rounded bg-violet-500 hover:bg-violet-600 text-white">Add</button>
            </form>

         </x-modal>

         <div class="relative overflow-x-auto rounded-t-xl mt-6">
             <table class="text-xs w-full text-left rtl:text-right text-gray-500 dark:text-gray-400 rounded-t-xl">
                 <thead class=" text-gray-700 uppercase bg-gray-50 rounded-t-xl">
                     <tr>
                         <th scope="col" class="px-6 py-3">
                             Name
                         </th>
                         <th scope="col" class="px-6 py-3">
                             Email
                         </th>
                         <th scope="col" class="px-6 py-3">
                             Division
                         </th>
                         <th scope="col" class="px-6 py-3">
                             Role
                         </th>
                         <th scope="col" class="px-6 py-3">
                             Action
                         </th>
                     </tr>

                 </thead>
                 <tbody>
                     @foreach($employees as $employee)
                     <tr class="bg-white border-b  border-gray-200 text-gray-600">
                         <td class="px-6 py-4">
                             <x-avatar name="{{$employee->name}}" image="{{$employee->image()}}" />
                         </td>
                         <td class="px-6 py-4">
                            {{$employee->email}}
                         </td>
                         <td class="px-6 py-4">
                            {{$employee->division->name ?? 'not assigned'}}
                         </td>
                         <td class="px-6 py-4">
                         {{-- get role user spatie --}}
                           {{$employee->getRoleNames()->first()}}
                         </td>
                         
                         <td class="px-6 py-4">
                            <div class="flex gap-2 items-center">
                                <div class="col">
                                    <form action="{{route('admin.employee.delete',$employee->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-delete p-2 rounded-xl bg-red-500 text-white hover:bg-red-600" type="submit">
                                            <x-icon name="trash" class="size-5 text-white" />
                                        </button>

                                    </form>
                                </div>
                                <div class="col">
                                    <a href="{{route('admin.employee.edit',$employee->id)}}" class="p-2 rounded-xl bg-blue-700 text-white hover:bg-blue-500 flex">
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