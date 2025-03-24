<x-admin>
    <x-header title="edit employee" icon="user" urlBack="{{route('admin.employee.index')}}" />
    <div class="container my-8 rounded-xl shadow p-6 bg-white">
        <form action="{{route('admin.division.update',$division->id)}}" method="post">
            @csrf
            @method('put')
            <div class="mb-4">
                <x-input-label for="name" :value="__('name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name',$division->name)" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
           
            <button class="py-2 w-full rounded bg-violet-500 hover:bg-violet-600 text-white">Update</button>
        </form>
    </div>
</x-admin>
