<x-admin>
    <x-header title="edit employee" icon="user" urlBack="{{route('admin.employee.index')}}"/>
    <div class="container my-8 rounded-xl shadow p-6 bg-white">
        <form action="{{route('admin.employee.update',$user->id)}}" method="post">
        @csrf
        @method('put')
              <div class="mb-4">
                  <x-input-label for="name" :value="__('name')" />
                  <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name',$user->name)" required autofocus autocomplete="name" />
                  <x-input-error :messages="$errors->get('name')" class="mt-2" />
              </div>
              <div class="mb-4">
                  <x-input-label for="email" :value="__('email')" />
                  <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email',$user->email)" required autofocus autocomplete="Email" />
                  <x-input-error :messages="$errors->get('email')" class="mt-2" />
              </div>
              <div class="mb-4">
                   <x-input-label for="division_id" :value="__('division')" class="mb-2" />
                     <select id="division_id" name="division_id" class="bg-gray-50 border text-md border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                       @foreach($divisions as $division)
                         <option value="{{$division->id}}" @if($user->division_id==$division->id) selected @endif>{{$division->name}}</option>
                       @endforeach
                     </select>
              </div>
               <div class="mb-4">
                   <x-input-label for="password" :value="__('Password')" />
                   <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" autocomplete="current-password" />
                   <x-input-error :messages="$errors->get('password')" class="mt-2" />
               </div>

              <button class="py-2 w-full rounded bg-violet-500 hover:bg-violet-600 text-white">Update</button>
        </form>
    </div>
</x-admin>