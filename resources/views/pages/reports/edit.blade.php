<x-app-layout>
    <div class="container w-full mx-auto p-2">
        <x-header title="Edit Report" icon="list" urlBack="{{route('report.index')}}"/>
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                <form action="{{route('report.update',$report->uuid)}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mx-auto">
                        <div class="w-full">
                            <div class="mb-6">
                                <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                                <input type="date" name="start_date" id="start_date" value="{{ $report->start_date }}" autocomplete="start_date" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"> 

                            </div>
                            <div class="mb-6">
                                <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                                <input type="date" name="end_date" id="start_date" value="{{ $report->end_date }}" autocomplete="start_date" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"> 

                            </div>
                            <button type="submit" class="w-full bg-primary py-2 rounded hover:bg-cyan-400 text-white" >Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>