<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('MyNotes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <ol id="sortable-list" type='1'>
                     <ol id="sortable-list" type='1'>
    @foreach ($uploads as $upload)
        <li>
            <a href='{{ url("/uploads/{$upload->id}/{$upload->originalName}") }}'>
                {{ $upload->originalName }}
            </a>
            @auth
                @can('update', $upload)
                    {{-- 仅当认证用户有更新权限时才显示以下内容 --}}
                    {{ $upload->user->name }} {{ $upload->user->id }}
                    <form method="POST" action='{{ url("/uploads/{$upload->id}/edit") }}' style="display:inline!important;">
                        @csrf
                        @method('get')
                        <button type="submit" style="display:inline!important;">Edit</button>
                    </form>
                @endcan

                @can('delete', $upload)
                    {{-- 仅当认证用户有删除权限时才显示以下内容 --}}
                    <form method="POST" action='{{ url("/uploads/{$upload->id}") }}' style="display:inline!important;">
                        @csrf
                        @method('delete')
                     <button type="submit" style="display:inline!important;">Delete</button>
                    </form>
                @endcan
            @endauth
        </li>
    @endforeach
</ol>

@if (session('operation'))
    {{ session('operation') }} {{ session('id') }}
@endif

@auth
    @can('create', App\Models\Upload::class)
        {{-- 仅当认证用户有创建权限时才显示以下内容 --}}
        <a href="/uploads/create">Add file</a>
    @endcan

    <br>I am {{ Auth::user()->name }} and My number is {{ Auth::user()->id }}.
@endauth


                    @guest
                        <a href="/login">Login</a> or <a href="/register">Register as a new user</a>.
                    @endguest
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
