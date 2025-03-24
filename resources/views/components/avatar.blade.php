@props(['name'=>'name', 'image'=>'/'])
<div>
  {{-- avatar component --}}
  <div class="flex items-center gap-2">
    <div class="w-10 h-10 rounded-full bg-cover bg-center" style="background-image: url({{asset($image)}})">
    </div>
    <div>
      <h1 class="text-md text-gray-700">{{$name}}</h1>
    </div>
  </div>
</div>