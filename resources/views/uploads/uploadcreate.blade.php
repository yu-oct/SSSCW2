<!-- 在 Blade 视图中引入你的 CSS 文件 -->
<link rel="stylesheet" href="{{ asset('style.css') }}">

<!-- 在 Blade 视图中引入你的 JavaScript 文件 -->
<script src="{{ asset('app.js') }}" defer></script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload Notes') }}
        </h2>
    </x-slot>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <form method="POST" action='{{ url("/uploads") }}' enctype="multipart/form-data">
                    @csrf

                    <label for="upload" class="styled-label">Choose File:</label>
                    <input type="file" id="upload" name="upload" style="display:none" onchange="changeAgentContent('upload')" />
                    <input class="styled-input" type="text" value="" disabled id="inputFileAgent" />
                    <input type="button" onclick="document.getElementById('upload').click()" class="styled-button" value="Browse" />
                    <button type="submit" class="styled-button">Save Upload</button>
                </form>
           
                   @if(!empty($id))
    <br>
    <a href="{{ url('/uploads', [$id, $originalName]) }}">{{ $id }} {{ $originalName }}</a>
    <br>
     @if(substr($mimeType, 0, 5) == 'image')
                          <img height="25%" width="25%" src="{{ url('/uploads', [$id, $originalName]) }}">
    @elseif($mimeType == 'application/pdf' || $mimeType == 'application/msword' || $mimeType == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
        @php
            $documentThumbnailPath = asset("storage/uploads/{$id}/{$originalName}.png");
        @endphp

        @if(file_exists(public_path("storage/uploads/{$id}/{$originalName}.png")))
            <img src="{{ $documentThumbnailPath }}" alt="Document to Image">
        @else
            <p>No thumbnail available for the document</p>
        @endif
    @endif
@endif
                    @if($errors->any())
                        <div>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @isset($id) 
                        {{ $id }}
                        <br>
                        {{ $path }}
                        <br>
                        {{ $originalName }}
                        <br>
                        {{ $mimeType }}
                    @endisset
                </div>
            </div>
        </div>
    </div> </div>
        </div>
    </div>
</div>


</x-app-layout>
