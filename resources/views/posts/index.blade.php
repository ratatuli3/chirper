{{-- use AppLayout Component located in app\View\Components\AppLayout.php which use resources\views\layouts\app.blade.php view --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ 'Employees' }}
            </h2>
            <a href="{{ route('posts.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">ADD</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                 <form action="" method="GET">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Filter by Parent Department</label>
                            <select name="department_id" class="form-select">
                                <option>{{ null }}</option>
                                    @foreach ($departments as $department_i)
                                        <option value="{{ $department_i->id }}" {{ Request::get('department_id') == $department_i->id ? 'selected':''}}>
                                            {{ $department_i->name }}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <br/>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Filter</button>
                        </div>
                    </div>
                </form>
                    <table class="border-collapse table-auto w-full text-sm">
                        <thead>
                            <tr>
                                <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">
                                    @sortablelink('name')</th>
                                <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">
                                    @sortablelink('email')</th>
                                <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">
                                    @sortablelink('usertype', 'Role')</th>
                                <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">
                                    @sortablelink('department_id', 'Parent Department')</th>
                                <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 text-left">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach ($posts as $post)
                                <tr>
                                    <td
                                        class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                        {{ $post->name }}</td>
                                    <td
                                        class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                        {{ $post->email }}</td>
                                    <td
                                        class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                        {{ $post->usertype }}</td>
                                    <td
                                        class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                        {{ \App\Models\Department::find($post->department_id)->name ?? ''}}</td>
                                    <td
                                        class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                        <a href="{{ route('posts.show', $post->id) }}"
                                            class="border border-blue-500 hover:bg-blue-500 hover:text-white px-4 py-2 rounded-md">SHOW</a>
                                        <a href="{{ route('posts.edit', $post->id) }}"
                                            class="border border-yellow-500 hover:bg-yellow-500 hover:text-white px-4 py-2 rounded-md">EDIT</a>
                                        {{-- add delete button using form tag --}}
                                        <form method="post" action="{{ route('posts.destroy', $post->id) }}"
                                            class="inline">
                                            @csrf
                                            @method('delete')
                                            <button
                                                class="border border-red-500 hover:bg-red-500 hover:text-white px-4 py-2 rounded-md">DELETE</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $posts->appends(\Request::except('page'))->render() !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
