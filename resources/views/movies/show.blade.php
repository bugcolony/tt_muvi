<x-layout>
    <div class="max-w-7xl mx-auto mt-20">
        <a
            href="{{url()->to('/')}}"
            class="bg-slate-700 hover:bg-slate-600 text-white font-bold py-2 px-4 rounded-full w-20 text-center block mb-10"
        >
            Home
        </a>
        <article class="flex gap-10">
            <div class="w-1/4 flex flex-col">
                <img
                    src="{{$movie->poster}}"
                    onerror="this.onerror=null;this.src='{{ asset('images/poster-fallback.svg') }}';"
                    alt="Poster of {{$movie->title}}"
                />
                <div class="flex justify-between text-gray-100 mt-5">
                    <div class="flex gap-2">
                        <img
                            class="w-20"
                            src="https://thumb.wikimedia.org/wikipedia/commons/thumb/6/69/IMDB_Logo_2016.svg/250px-IMDB_Logo_2016.svg.png?utm_source=en.wikipedia.org&utm_campaign=parser&utm_content=thumbnail"
                            alt="imdb logo"
                        />

                        <div class="flex flex-col">
                            <span class="font-bold">{{$movie->imdb_rating}} / 10</span>
                            <span class="text-xs">{{$movie->imdb_votes}}</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <img
                            class="w-10"
                            src="https://upload.wikimedia.org/wikipedia/commons/f/f2/Metacritic_M.png?utm_source=commons.wikimedia.org&utm_campaign=index&utm_content=original"
                            alt="metacritic logo"
                        />

                        <span class="font-bold">{{$movie->metascore ?? '-'}} / 100</span>
                    </div>
                </div>

            </div>
            <div class="text-gray-100 flex-1 mb-5">
                <div class="mb-5">
                    <h2 class="text-gray-100 font-bold text-xl">{{$movie->title}} </h2>
                    <p class="text-sm text-gray-500"><span title="Release year">{{$movie->year ?? 'N/A'}}</span> - <span title="Rating">{{$movie->rating ?? 'Not Rated'}}</span> - <span title="Runtime">{{$movie->runtime ?? 'N/A'}}</span></p>
                </div>

                <div class="grid grid-cols-3 gap-3">
                    <p class="bg-slate-800/70 rounded-xl p-6 col-span-3">{{$movie->plot}}</p>


                    <div class="grid grid-cols-2 gap-2 bg-slate-800/70 p-6 col-span-2 rounded-xl border-l-5 border-sky-500">
                        <div>
                            <h5 class="font-bold text-xs">Genre</h5>
                            <p class="text-gray-200">{{$movie->genre ?? '-'}}</p>
                        </div>
                        <div>
                            <h5 class="font-bold text-xs">Director</h5>
                            <p class="text-gray-200">{{$movie->director ?? '-'}}</p>
                        </div>
                        <div>
                            <h5 class="font-bold text-xs">Writer</h5>
                            <p class="text-gray-200">{{$movie->writer ?? '-'}}</p>
                        </div>
                        <div>
                            <h5 class="font-bold text-xs">Actors</h5>
                            <p class="text-gray-200">{{$movie->actors ?? '-'}}</p>
                        </div>
                    </div>

                    <div class="bg-slate-800/70 p-6 rounded-xl border-l-5 border-amber-400">
                        <div class="mb-2">
                            <h5 class="font-bold text-xs">Awards</h5>
                            <p class="text-gray-200">{{$movie->awards ?? '-'}}</p>
                        </div>
                        <div>
                            <h5 class="font-bold text-xs">Box office</h5>
                            <p class="text-gray-200">{{$movie->box_office ?? '-'}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</x-layout>
