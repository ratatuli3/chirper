{{-- use AppLayout Component located in app\View\Components\AppLayout.php which use resources\views\layouts\app.blade.php view --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ 'Departments' }}
            </h2>
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
                    onNodeSelected: function(event,data){
                        $.ajax({
                            url: `/departments/${data.id}/userData`,
                            method: "GET",
                            dataType: "json",
                            success: function(data){
                                    $('#userTable tbody tr').remove();

                                    let content = "";

                                    data.forEach(function(user){
                                        content += `<tr>
                                    <td
                                        class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                        ${user.name}</td>
                                    <td
                                        class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                        ${user.email}</td>
                                    <td
                                        class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                        ${user.usertype}</td>
                                </tr>`
                                    });
                                    $('#userTable tbody').append(content); 
                            }
                        });
                    }
                }); 
            }
        });
    });

  
    </script>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table id="userTable" class="border-collapse table-auto w-full text-sm">
                        <thead>
                            <tr>
                                <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">
                                    @sortablelink('name')</th>
                                <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">
                                    @sortablelink('email')</th>
                                <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">
                                    @sortablelink('role')</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                        </tbody>
                    </table>
                    {!! $posts->appends(\Request::except('page'))->render() !!}
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
