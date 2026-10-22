<x-layout>
    <div class="max-w-7xl mx-auto mt-20">
        <h1 class="text-center font-sans font-extrabold lowercase tracking-tighter leading-none text-8xl md:text-[10rem] text-white">
            <span class="bg-gradient-to-r from-violet-500 to-pink-500 bg-clip-text text-transparent">muvi</span>
        </h1>

        @if(session('error'))
            <div class="mb-4 rounded-md border border-red-400 bg-red-900/20 w-md mx-auto px-4 py-3 text-sm text-red-400" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <form action="" class="my-10">
            <div class="flex flex-col items-center">
                <div
                    class="flex items-center border pl-4 gap-2 border-gray-500/30 h-[46px] rounded-full overflow-hidden max-w-md w-full bg-slate-700 mx-auto mb-2">
                    <x-search-icon/>
                    <input
                        id="search"
                        name="search"
                        value="{{request('search')}}"
                        type="text"
                        placeholder="Search titles"
                        required
                        autocomplete="off"
                        class="w-full h-full outline-none text-gray-200 bg-transparent placeholder-gray-400 text-sm"
                    >
                </div>

                <div class="flex gap-5 max-w-md w-full justify-center">
                    @foreach ($history as $term)
                        <a
                            href="{{route('home', ['search' => $term])}}"
                            class="flex flex-col items-center gap-1 group cursor-pointer w-12 text-center"
                            title="{{$term}}"
                        >
                            <div class="bg-slate-700 group-hover:bg-slate-600  p-2 rounded-full">
                                <x-search-icon/>
                            </div>
                            <p class="text-gray-300 text-xs group-hover:text-white line-clamp-2 w-full break-words">{{$term}}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        </form>
        <ul class="grid grid-cols-3 gap-4">
            @if(count($data) > 0)
                @foreach ($data as $item)
                    <li class="py-5 px-10 hover:scale-102 cursor-pointer hover:bg-slate-800/30 rounded-xl break-inside-avoid"
                        title="{{$item->title}}">
                        <a class="flex flex-col items-center" href="{{route('movie', $item->id)}}">
                            <h4 class="text-gray-100 font-bold mb-2 text-xl">{{$item->title}} <span
                                    class="text-gray-500">({{$item->year}})</span></h4>
                            <img
                                src="{{$item->poster}}"
                                onerror="this.onerror=null;this.src='{{ asset('images/poster-fallback.svg') }}';"
                                alt="Poster of {{$item->title}}"
                            />
                        </a>
                    </li>
                @endforeach
            @else
                @if(strlen(request('search', '')) > 0)
                    <span class="text-mute text-sm col-span-3 text-gray-300 text-center">Could not find what you are looking for. Try to search differently</span>
                @endif
            @endif
        </ul>
    </div>

</x-layout>
