<link rel="stylesheet" href="{{ asset('app.js') }}">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('MyNotes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex items-center">
                <div class="p-6 text-gray-900">
                    {{-- <ol id="sortable-list" type='1'> --}}
                        @foreach ($uploads as $upload)
                            <li class="flex items-center justify-between">
                                 <div class="mr-12"> UserName:{{ $upload->user->name }}</div>
                                 <div class="mr-12"> UserID:{{ $upload->user->id }}</div>
                                   <div class="mr-12"> FileID:{{ $upload->id }}</div>
                                 <div class="mr-12">  FileTitle:{{ $upload->title }}</div>
                                @auth
                               <div class="flex space-x-2 ml-auto">
                                        @can('update', $upload)
                                            {{-- 仅当认证用户有更新权限时才显示以下内容 --}}
                                            <form method="POST" action='{{ url("/uploads/{$upload->id}/{origName?}") }}' style="display:inline!important;">
                                                @csrf
                                                @method('get')
                                                <button type="submit" class="styled-button">Show</button>
                                            </form>
                                        @endcan
                                        @can('update', $upload)
                                            {{-- 仅当认证用户有更新权限时才显示以下内容 --}}
                                            <form method="POST" action='{{ url("/uploads/{$upload->id}/edit") }}' style="display:inline!important;">
                                                @csrf
                                                @method('get')
                                                <button type="submit" class="styled-button">Edit</button>
                                            </form>
                                        @endcan
                                        @can('delete', $upload)
                                            {{-- 仅当认证用户有删除权限时才显示以下内容 --}}
                                            <form method="POST" action='{{ url("/uploads/{$upload->id}") }}' style="display:inline!important;">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="styled-button">Delete</button>
                                            </form>
                                        @endcan
                                    </div>
                                @endauth
                            </li>
                        @endforeach
                    {{-- </ol> --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
