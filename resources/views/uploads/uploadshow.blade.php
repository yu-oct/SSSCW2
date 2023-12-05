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
              <form method="POST" action='{{ url("/uploads") }}' enctype="multipart/form-data" class="flex flex-wrap gap-4">
                @csrf
                <label for="upload" class="styled-label w-full">Choose File:</label>
                <div class="flex w-full gap-4">
                    <input type="file" id="upload" name="upload" style="display:none" onchange="changeAgentContent('upload')" />
                    <input class="styled-input w-full max-w-[200px]" type="text" placeholder="Choose File" value="" disabled id="inputFileAgent" />
                    <input type="button" onclick="document.getElementById('upload').click()" class="styled-button" value="Browse" />
                </div>
                <label for="title" class="styled-label w-full">Title:</label>  
                 <input class="styled-input  w-full" type="text" name="title" placeholder="Enter Title" value="" />
                 <label for="description" class="styled-label w-full">Description:</label>
  <textarea class="styled-input w-full" name="description" placeholder="Enter Description"></textarea>
  <button type="submit" class="styled-button w-full">Save Upload</button>

            </form>
                   @if(!empty($id))
    <br>
    <div class="flex justify-center items-center">
    <a href="{{ url('/uploads', [$id, $originalName]) }}">
  &#128269; Click here to see an enlarged image
</a>
    </div>
    <br>
     @if(substr($mimeType, 0, 5) == 'image')
                          <div class="flex justify-center items-center">
  <img height="25%" width="25%"  src="{{ url('/uploads', [$id, $originalName]) }}" alt="Uploaded Image">
</div>

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

                  <div class="flex justify-center items-center mt-8">
  <div class="border p-4 ml-4">
    @isset($id) 
    <p class="text-pink-300 font-semibold">File Information Check</p>
    <br>
      Your File id is <strong>{{ $id }}</strong>.
      <br>
      Your File Title is <strong>{{ $title }}</strong>.
      <br>
      Your File Description is <strong>{{ $description }}</strong>.
      <br>
      Your File path is <strong>{{ $path }}</strong>.
      <br>
      Your File OriginalName is <strong>{{ $originalName }}</strong>.
      <br>
      Your File Type is <strong>{{ $mimeType }}</strong>.
    @endisset
  </div>
</div>

                </div>
            </div>
        </div>
    </div> </div>
        </div>
    </div>
</div>


</x-app-layout>
