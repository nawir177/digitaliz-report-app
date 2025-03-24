 @props([
    'icon'=>null,
    'title'=>'title',
    'urlBack'=>'/'
 ]
 )
 <div class="mb-10 p-3 rounded-xl drop-shadow-sm w-full bg-white  shadow-violet-400 flex justify-between items-center">
    <div class="col">
        <div class="flex gap-2 items-center">
            <div class="col">
                <x-icon name="{{$icon}}" class="md:size-14 size-10 text-purple-600" />
            </div>
            <div class="col">
                <h1 class="md:text-2xl text-md text-purple-600 font-madium uppercase font-bold">{{$title}}</h1>
            </div>
        </div>
    </div>
    <div class="col">
        <a href="{{$urlBack}}" class="p-2 rounded-xl bg-slate-50 border flex items-center justify-center hover:bg-slate-100 text-purple-600">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="md:size-10 size-6">
              <path fill-rule="evenodd" d="M7.72 12.53a.75.75 0 0 1 0-1.06l7.5-7.5a.75.75 0 1 1 1.06 1.06L9.31 12l6.97 6.97a.75.75 0 1 1-1.06 1.06l-7.5-7.5Z" clip-rule="evenodd" />
          </svg>
        </a>
    </div>
 </div>
