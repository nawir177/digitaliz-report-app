<x-app-layout>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            {{-- header --}}
            <x-header title="daily report" icon="document" urlBack="{{route('report.index')}}" />

            {{-- Stat Cards --}}
            <div class="grid grid-cols-1 md:gap-4 gap-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                <x-stat-card propName="Total Reports" propValue="{{$totalReport}}" />
                <x-stat-card propName="Total Projects" propValue="{{$totalProject}}" icon="computer" />
                <x-stat-card propName="Report Accpeted" propValue="{{$reportApprove}}" icon="checked" />
                <x-stat-card propName="Report Not Accepted" propValue="{{$reportNotApprove}}" icon="warning" />
            </div>

            {{-- btn modal --}}
            <x-btn-modal title="Add new Report" icon="list" />

            <!-- Main modal -->
            <x-modal name="authentication-modal" title="Add New Report" maxWidth="3xl">
                <div class="relative bg-white rounded-lg shadow-sm ">
                    <!-- Modalk body -->
                    <div class="">
                        <form class="space-y-4" action="{{route('report.store')}}" method="post">
                            @csrf
                            <div class="mb-4">
                                <label for="start_date" class="block mb-2 text-sm font-medium text-gray-900 ">Start Date</label>
                                <input type="date" id="start_date" name="start_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                            </div>
                            <div class="mb-4">
                                <label for="end_date" class="block mb-2 text-sm font-medium text-gray-900 ">End Date</label>
                                <input type="date" id="end_date" name="end_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                            </div>
                            <button type="submit" class="w-full py-2 rounded-xl bg-blue-700 text-white">Created new reports</button>
                        </form>
                    </div>
                </div>

            </x-modal>
            {{-- end modal  --}}

            {{-- filter date --}}
            <div class="flex gap-2 items-center mt-6">
                <div class="col">
                    <label for="start_date" class="block text-sm font-medium text-gray-900 ">Start Date</label>
                    <input type="date" id="start_date" name="start_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                </div>
                <div class="col">
                    <label for="end_date" class="block text-sm font-medium text-gray-900 ">End Date</label>
                    <input type="date" id="end_date" name="end_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                </div>
                <div class="col">
                    <button class="w-full py-2 px-6 mt-4 rounded bg-blue-700 text-white text-sm">Filter</button>
                </div>
            </div>

            <div class="relative overflow-x-auto rounded-t-xl mt-6">
                <table class="text-xs w-full text-left rtl:text-right text-gray-500 dark:text-gray-400 rounded-t-xl">
                    <thead class=" text-gray-700 uppercase bg-gray-50 rounded-t-xl">
                        <tr>
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
                        @foreach ($reports as $report)
                        <tr class="bg-white border-b  border-gray-200 text-gray-600">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <x-icon name="list" class="size-8 text-gray-500" />
                                    {{ \Carbon\Carbon::parse($report->start_date)->translatedFormat('d F Y') }}
                                </div>

                            </td>
                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($report->end_date)->translatedFormat('d F Y') }}

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
                                    <div class="hidden group-hover:block absolute top-0 left-8 w-40 p-2 bg-white rounded-xl shadow border max-h-36 z-20">{{@$report->note}}</div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2 items-center">
                                    <div class="col">
                                        <form action="{{route('report.destroy',$report->uuid)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn-delete p-2 rounded-xl bg-red-500 text-white hover:bg-red-600" type="submit">
                                                <x-icon name="trash" class="size-5 text-white" />
                                            </button>

                                        </form>
                                    </div>
                                    <div class="col">
                                        <a href="{{route('report.edit',$report->uuid)}}" class="p-2 rounded-xl bg-blue-700 text-white hover:bg-blue-500 flex">
                                            <x-icon name="pencil" class="size-5 text-white" />
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a href="{{route('report.show',$report->uuid)}}" class="px-4 py-2.5 rounded-lg bg-green-400 text-white hover:bg-green-500 flex">
                                            Open
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{$reports->links()}}
            </div>

        </div>
    </div>
</x-app-layout>
