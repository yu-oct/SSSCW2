<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                   @guest
                        {{-- 游客的内容 --}}
                        <p>Welcome, Guest!</p>
                        <p>Please login or register to access more features.</p>
                    @else
                        {{-- 已登录用户的内容 --}}
                        <p>Welcome, {{ Auth::user()->name }}!</p>
                        <p>Your UserID is {{ Auth::user()->id }}</p>
                        <p>This is a Notekeeping App, you can keep your Picturenotes here</p>
                    @endguest

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
