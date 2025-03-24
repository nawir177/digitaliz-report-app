<x-app-layout>

    <div class="py-12">
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            {{-- header --}}
            <x-header title="Report Project" icon="windows-solid" urlBack="{{route('report.index')}}"/>
           
            <h1 class="md:text-md text-sm font-base text-gray-700 mt-10">Report From <b class="text-purple-600 md:text-2xl text-lg"> {{ \Carbon\Carbon::parse($report->start_date)->translatedFormat('d F Y') }}</b> To <b class="text-purple-600 md:text-2xl text-lg"> {{ \Carbon\Carbon::parse($report->end_date)->translatedFormat('d F Y') }}</b></h1>

          {{-- btn modal --}}
          <x-btn-modal title="Add New Project" icon="windows-solid" />


            <!-- Main modal -->
            <div id="authentication-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow-sm ">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t  border-gray-200">
                            <h3 class="text-xl font-semibold text-gray-900">
                                Add Project
                            </h3>
                            <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center " data-modal-hide="authentication-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5">
                            <form class="space-y-4" action="{{route('projectHasReport.store')}}" method="post">
                                @csrf
                            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 ">Select Project</label>
                                    <select id="countries" name="project_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                        @foreach ($project as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" value="{{$report->id}}" name="report_id">
                                <button type="submit" class="w-full py-2 rounded-xl bg-blue-700 text-white">Add Project</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex mb-6 gap-2 items-center">
                <div class="col">
                     <a href="{{route('generatePdf',$report->uuid)}}" target="_BLANK" class="flex items-center gap-2 py-2 px-4 rounded bg-primary hover:bg-cyan-400 text-white">Preview PDF <x-icon name="document"/></a>
                </div>
                <div class="col">
                     <a href="{{route('projectHasReport.downloadPdf',$report->uuid)}}" target="_BLANK" class="flex items-center gap-2 py-2 px-4 rounded bg-primary hover:bg-cyan-400 text-white">Download PDF <x-icon name="unduh"/></a>

                </div>
            </div>

            <div class="relative overflow-x-auto rounded-t-xl mt-6">
                <table class="text-xs w-full text-left rtl:text-right text-gray-500 dark:text-gray-400 rounded-t-xl">
                    <thead class=" text-gray-700 uppercase bg-gray-50 rounded-t-xl">
                        <tr>

                            <th scope="col" class="px-6 py-3">
                                Project Name
                            </th>
                           

                            <th scope="col" class="px-6 py-3">
                                Amount Report
                            </th>
                           
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($projectHasReport)>0)
                            @foreach ($projectHasReport as $report)
                            <tr class="bg-white border-b  border-gray-200 text-gray-600 md:text-lg text-sm">
                                <td class="px-6 py-4">
                                    {{$report->project->name}}
                                </td>
                                <td class="px-6 py-4">
                                    {{count($report->listReport)}}
                                </td>
                            
                                <td class="px-6 py-4">
                                    <div class="flex gap-3 items-center">
                                          <div class="col">
                                            <form action="{{route('projectHasReport.delete',$report->uuid)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-delete p-2 rounded-xl bg-red-300 text-white hover:bg-red-500">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="md:size-6 size-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                    </svg>
                                                </button>
                                            </form>
                                          </div>
                                        <div class="col">
                                            <a href="{{route('projectHasReport.edit',$report->uuid)}}" class="p-2 rounded-xl bg-amber-400 text-white hover:bg-amber-500 flex">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="md:size-6 size-4">
                                                    <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                                                </svg>
                                            </a>
                                        </div>    
                                        <div class="col">
                                            <a href="{{route('projectHasReport.list',$report->uuid)}}" class="py-2.5 px-4 rounded bg-blue-700 text-white hover:bg-blue-500 flex text-xs">
                                                <div class="col">
                                                    OPEN
                                                </div>
                                            </a>
                                        </div>

                                    </div>
                                </td>
                            </tr>
                            @endforeach

                        @else
                            <tr class="bg-white border-b  border-gray-200">
                                <th colspan="3" class="text-center text-red-400 px-6 py-3 text-lg font-thin">Nothing Project</th>

                            </tr>
                        @endif

                    </tbody>
                </table>
            </div>
            {{-- <div class="mt-4">
                {{$reports->links()}}
            </div> --}}

        </div>
    </div>
</x-app-layout>

