<!-- resources/views/feedback/all.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Feedback') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1>All Feedback</h1>

                    <ul>
                        @foreach($feedback as $entry)
                            <li>
                <strong>{{ $entry->user->name }}:</strong> {{ $entry->content }}
                <!-- 其他反馈信息的显示 -->
            </li>
                            <!-- 其他反馈信息的显示 -->
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
