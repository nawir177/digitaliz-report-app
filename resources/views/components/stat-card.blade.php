@props(['propName', 'propValue','icon'=>'list'])
<div class="w-full bg-white shadow rounded-lg p-4">
    <div class="flex items-center justify-between">
        <div class="flex gap-2">
            <div class="flex p-2 bg-violet-100 rounded-full items-center justify-center">
                <x-icon name="{{$icon}}" class="text-violet-700 size-8" />
            </div>
            <p class="text-sm text-gray-600">{{ $propName }}</p>
        </div>
        <div class="flex items-center">
            <p class="text-4xl font-bold text-violet-600">{{ $propValue }}</p>
        </div>
    </div>
</div>

