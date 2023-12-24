<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- Use 'Edit' for edit mode and create for non-edit/create mode --}}
            {{ isset($department) ? 'Edit Department' : 'Create Department' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- don't forget to add multipart/form-data so we can accept file in our form --}}
                    <form method="post"
                        action="{{ isset($department) ? route('departments.update', $department->id) : route('departments.store') }}"
                        class="mt-6 space-y-6" enctype="multipart/form-data"class="mt-6 space-y-6">
                        @csrf
                        {{-- add @method('put') for edit mode --}}
                        @isset($department)
                            @method('put')
                        @endisset

                        <div>
                            <x-input-label for="name" value="Name" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="$department->name ?? old('name')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="description" value="Description" />
                            <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" :value="$department->description ?? old('description')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div>
                            <x-input-label for="parent_id" value="Parent Department" />

                            <div>
                                <select class="form-control" style="width: 100%;"
                                    name="parent_id"
                                    data-placeholder="Parent Department">
                                    <option>{{Null}}</option>
                                    @foreach ($departments as $department_i)
                                        <option value="{{ $department_i->id }}">
                                        {{-- {{ isset($department) ? (n_array($department)) ?'selected':''>) : }}> --}}
                                            {{ $department_i->name }}</option>

                                    @endforeach
                                </select>


{{-- 
                                <input type="hidden" name="{{ $department->name }}[]" /> --}}

                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
