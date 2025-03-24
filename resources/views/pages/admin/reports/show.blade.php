<x-admin>
    <div class="py-12">
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            {{-- header --}}
            <x-header title="Report Project" icon="windows-solid" urlBack="{{route('admin.dashboard')}}" />
            <h1 class="md:text-md text-sm font-base text-gray-700 mt-10">Report From <b class="text-purple-600 md:text-2xl text-lg"> {{ \Carbon\Carbon::parse($report->start_date)->translatedFormat('d F Y') }}</b> To <b class="text-purple-600 md:text-2xl text-lg"> {{ \Carbon\Carbon::parse($report->end_date)->translatedFormat('d F Y') }}</b></h1>


            <div class="flex mb-6 gap-2 items-center mt-10">
                <div class="col">
                    <a href="{{route('generatePdf',$report->uuid)}}" target="_BLANK" class="flex items-center gap-2 py-2 px-4 rounded bg-primary hover:bg-cyan-400 text-white">Preview PDF
                        <x-icon name="document" /></a>
                </div>
                <div class="col">
                    <a href="{{route('projectHasReport.downloadPdf',$report->uuid)}}" target="_BLANK" class="flex items-center gap-2 py-2 px-4 rounded bg-primary hover:bg-cyan-400 text-white">Download PDF
                        <x-icon name="unduh" /></a>

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
                                        <a href="{{route('admin.report.list',$report->uuid)}}" class="py-2.5 px-4 rounded bg-blue-700 text-white hover:bg-blue-500 flex text-xs">
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




            @if(isset($report->report->status))
            {{-- modal reject --}}
            <x-modal name="rectedModal" title="Reject Report">
                <form action="{{route('admin.report.reject',$report->report->uuid)}}" method="post">
                    @csrf
                    <div>
                        <div class="col mb-4">
                            <label for="note" class="text-gray-700 mb-3">Note</label>
                            <textarea name="note" id="note" class="w-full h-24 border border-gray-200 rounded p-2 focus:outline-none focus:border-gray-400" placeholder="note"></textarea>
                        </div>
                        <div class="col">
                            <button type="submit" class="py-2 px-4 rounded bg-red-500 text-white hover:bg-red-400">Reject Report</button>
                        </div>
                    </div>
                </form>
            </x-modal>
            <!-- end modal -->

            {{-- accpet report button --}}
            <div class="flex justify-end mt-6 gap-2">
                <form action="{{route('admin.report.accept',$report->report->uuid)}}" method="post">
                    @csrf
                    <button type="submit" class="btn-confirm py-2 px-4 rounded bg-green-500 text-white hover:bg-green-400">Accept Report</button>

                </form>
                {{-- rejected buttom --}}
                <div class="col">
                    <button data-modal-target="rectedModal" data-modal-toggle="rectedModal" class="btn-rejected py-2 px-4 rounded bg-red-500 text-white hover:bg-red-400">Reject Report</button>
                </div>

            </div>
            @endif
        </div>
    </div>
</x-admin>
