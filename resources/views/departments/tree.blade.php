{{-- use AppLayout Component located in app\View\Components\AppLayout.php which use resources\views\layouts\app.blade.php view --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ 'Departments' }}
            </h2>
            <a href="{{ route('departments.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">ADD</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div id="treeview" class="p-6 text-gray-900">
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: "{{ route('departments.treeData') }}",
                method: "GET",
                dataType: "json",
                success: function(data) {
                    $('#treeview').treeview({
                        data: data,
                        levels: 10000000,
                    });
                }
            });
        });
    </script>

</x-app-layout>
