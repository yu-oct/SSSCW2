<!-- 加载 JavaScript 文件 -->

<script src="{{ asset('app.js') }}"></script>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('FeedBack') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('feedback.store') }}">
                        @csrf

                        <!-- Feedback Content -->
                        <div class="mx-auto w-3/4">
                        <label for="content" class="block font-medium text-sm text-gray-700">Appreciate for your Feedback :) have a nice day.</label>
                            <label for="content" class="block font-medium text-sm text-gray-700">Content</label>
                            <textarea id="content" name="content" class="block mt-1 w-full" value="{{ old('content') }}" required autofocus></textarea>
                        </div>

                        <div class="flex items-center justify-center mt-4">
                            <x-button onclick="submitFeedback()">
                                {{ __('Submit Feedback') }}
                            </x-button>
                        </div>

                        <div id="success-modal" class="fixed inset-0 flex items-center justify-center hidden">
                            <div class="bg-white p-4 rounded shadow-md">
                                <p class="text-green-500">Submission successful!</p>
                            </div>
                        </div>
                    </form>

                    <div>
                        

                     @can('viewAny', App\Models\Feedback::class)
                <h1>All Feedback</h1>
                    <a href="{{ route('feedback.all') }}">View All Feedback</a>
                @endcan

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
 <script>
        function submitFeedback() {
            // 在这里添加你的 JavaScript 逻辑，例如弹窗
            alert('Feedback Submitted!');
        }
    </script>