<x-app-layout>
    <div class="w-full mx-auto p-2">
        <x-header title="edit project has report" icon="list" urlBack="{{route('report.show',$projectHasReport->report->uuid)}}" />
         <div class="py-12">
             <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                 <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                     <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                         <form action="{{route('projectHasReport.update',$projectHasReport->uuid)}}" method="POST">
                             @csrf
                             @method('PATCH')
                             <div class="mx-auto">
                                 <div class="w-full">
                                  <div class="mb-6">
                                        <label for="project" class="block text-sm font-medium text-gray-700">Project</label>
                                        <select id="project" name="project_id" autocomplete="project" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            @foreach ($project as $item)
                                            <option value="{{$item->id}}" @if($projectHasReport->project_id == $item->id) selected @endif>{{$item->name}}</option>
                                            @endforeach
                                        </select>
     
                                  </div>
                                  <button type="submit" class="w-full bg-primary py-2 rounded hover:bg-cyan-400 text-white" >Update</button>
                                 </div>
                             
                             </div>
                         </form>
                     </div>
                 </div>
             </div>
         </div>
    </div>

</x-app-layout>
