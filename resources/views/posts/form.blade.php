<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- Use 'Edit' for edit mode and create for non-edit/create mode --}}
            {{ isset($post) ? 'Edit' : 'Create' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- don't forget to add multipart/form-data so we can accept file in our form --}}
                    <form method="post"
                        action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store') }}"
                        class="mt-6 space-y-6" enctype="multipart/form-data"class="mt-6 space-y-6">
                        @csrf
                        {{-- add @method('put') for edit mode --}}
                        @isset($post)
                            @method('put')
                        @endisset

                        <div>
                            <x-input-label for="name" value="Name" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                :value="$post->name ?? old('name')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="email" value="Email" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                                :value="$post->email ?? old('email')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>

                        <div>
                            <x-input-label for="usertype" value="Role" />
                            <x-text-input id="usertype" name="usertype" type="text" class="mt-1 block w-full"
                                :value="$post->usertype ?? old('usertype')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('usertype')" />
                        </div>

                        <div>
                            <x-input-label for="password" value="Password" />
                            {{-- use textarea-input component that we will create after this --}}
                            <x-text-input id="password" name="password" type="text" class="mt-1 block w-full"
                                required autofocus>{{ $post->email ?? old('email') }}</x-text-input>
                            <x-input-error class="mt-2" :messages="$errors->get('password')" />
                        </div>
                        <div>
                            <x-input-label for="parent_id" value="Parent Department" />

                            <div>
                                <select class="form-control" style="width: 100%;" name="department_id"
                                    data-placeholder="Parent Department">
                                    <option>{{ null }}</option>
                                    @foreach ($departments as $department_i)
                                        <option {{isset($post) && $post->department_id ==   $department_i->id ? 'selected': ''}} value="{{ $department_i->id }}" >
                                            {{ $department_i->name }}</option>
                                    @endforeach
                                </select>

                                <div class="flex items-center gap-4">
                                    <x-primary-button>{{ __('Save') }}</x-primary-button>
                                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
