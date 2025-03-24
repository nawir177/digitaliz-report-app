<x-admin>
    <x-header icon="home" title="dashboard" urlBack="{{route('admin.dashboard')}}"/>
       {{-- Stat Cards --}}
       <div class="grid grid-cols-1 md:gap-4 gap-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
           <x-stat-card propName="Total Reports" propValue="{{$totalReport}}" />
           <x-stat-card propName="Total Projects" propValue="{{$totalProject}}" icon="computer" />
           <x-stat-card propName="Users" propValue="{{$totalUser}}" icon="user" />
           <x-stat-card propName="Report Pending" propValue="{{$reportPending}}" icon="document" />
       </div>

       {{-- table report --}}
       <h1 class="text-violet-600 text-xl md:text-2xl font-bold mt-6">Laporan terbaru</h1>
       <div class="relative overflow-x-auto rounded-t-xl mt-6">
           <table class="text-xs w-full text-left rtl:text-right text-gray-500 dark:text-gray-400 rounded-t-xl">
                <thead class=" text-gray-700 uppercase bg-gray-50 rounded-t-xl">
                    <tr>
                         <th scope="col" class="px-6 py-3">
                             Name
                         </th>
                         <th scope="col" class="px-6 py-3">
                             Start Date
                         </th>
                         <th scope="col" class="px-6 py-3">
                             End Date
                         </th>
                         <th scope="col" class="px-6 py-3">
                             Amount Project
                         </th>
                         <th scope="col" class="px-6 py-3">
                             Status
                         </th>
                         <th scope="col" class="px-6 py-3">
                             Action
                         </th>
                    </tr>
                    
                </thead>
                <tbody>
                    @foreach($reports as $report)   
                    <tr class="bg-white border-b  border-gray-200 text-gray-600">
                        <td class="px-6 py-4">
                            <x-avatar name="{{$report->user->name}}" image="{{$report->user->image()}}"/>
                        </td>
                        <td class="px-6 py-4">
                           {{ \Carbon\Carbon::parse($report->start_date)->translatedFormat('d F Y') }}
                        </td>
                        <td class="px-6 py-4">
                           {{ \Carbon\Carbon::parse($report->start_date)->translatedFormat('d F Y') }}
                        </td>
                        <td class="px-6 py-4">
                            {{$report->projectHasReport->count()}}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex relative group">
                                {{-- note --}}
                                <span class="px-2 py-1 {{$report->statusColor()}} rounded text-white text-xs">{{$report->status}}</span>
                                @if ($report->status == 'rejected')
                                {{-- tooltip --}}
                                <div class="hidden hidden-scroll group-hover:block absolute top-0 left-8 w-40 p-2 bg-white rounded-xl shadow border max-h-36 z-20 overflow-y-scroll">{{@$report->note}}</div>
                                @endif
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <a href="{{route('admin.report.show',$report->uuid)}}" class="text-white bg-violet-500 py-2 px-6 hover:bg-violet-600 rounded-lg">View</a>
                        </td>
                    </tr>
                    @endforeach
           </table>
       </div>
         <div class="mt-4">
              {{$reports->links()}} 
            </div>

</x-admin>