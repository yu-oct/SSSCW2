<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form method="POST" action='{{url("/uploads/$id")}}' enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <input type="file" name="upload">
                        <input type="submit" value="Change Upload">
                    </form>

                   @if( ! empty($id) )    
                        <br>
                        <a href="{{ url('/uploads', [$id, $originalName]) }}">{{ $id }} {{ $originalName }}</a>
                        <br>
                       @if(substr($mimeType, 0, 5) == 'image')
                          <img height="25%" width="25%" src="{{ url('/uploads', [$id, $originalName]) }}">
                       @elseif($mimeType == 'application/pdf')
                          <img height="25%" width="25%" src="{{ url('/uploads', [$id, $originalName . '.png']) }}">
                         @endif

                    @endif


                    <a href="{{url('/uploads')}}">uploads</a>

                    @isset($id) 
                        {{ $id }} <br> {{ $path }} <br> {{ $originalName }} <br> {{ $mimeType }}
                    @endisset
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
