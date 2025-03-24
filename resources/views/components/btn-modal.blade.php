    @props(['title'=>'title','icon'=>''])
     <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" class="w-full py-3 px-4 rounded-xl bg-gradient-to-r from-primary via-purple-500 to-pink-500 text-white my-10 hover:shadow-xl hover:shadow-violet-400 duration-300 transition-all flex items-center gap-2">
         <div class="col">
          <x-icon name="{{$icon}}" class="text-white size-10" />
         </div>
         <div class="col text-xl">
             {{$title}}
         </div>
     </button>
