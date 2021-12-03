@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('site.home')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item">@lang('site.home')</li>
    </ul>
    <div class="row">

        <div class="col-md-12">
    <div class="row" id="top-statistics">
        <div class="col-md-12">
                <div class="row ">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-2">
                                    <p class="mb-0"><span><i class="fa fa-list"></i></span>@lang('genres.genres')</p>
                                    <a href="{{route('admin.genres.index')}}">@lang('site.show_all')</a>
                                </div>
                                <div class="loader loader-sm" ></div>
                                <h3 class="mb-0" id="genres-count" style="display: none"></h3>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-2">
                                    <p class="mb-0 "><span><i class="fa fa-film"></i></span>@lang('movies.movies')</p>
                                    <a href="{{route('admin.movies.index')}}">@lang('site.show_all')</a>
                                </div>
                                <div class="loader loader-sm" ></div>
                                <h3 class="mb-0" id="movies-count" style="display: none"></h3>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-2">
                                    <p class="mb-0 "><span><i class="fa  fa-address-book-o"></i></span>@lang('actors.actors')</p>
                                    <a href="{{route('admin.actors.index')}}">@lang('site.show_all')</a>
                                </div>
                                <div class="loader loader-sm" ></div>
                                <h3 class="mb-0" id="actors-count" style="display: none"></h3>
                            </div>
                        </div>

                    </div>
                </div>
        </div>
    </div>


    <div class="row my-3" >
        <div class="col-md-12">
            <div class="card">
                  <div class="card-body">
                      <div class="d-flex justify-content-between">
                          <h4>@lang('movies.movies_chart')</h4>
                          <select id="movies-chart-year" name="year" style="width: 100px;" >
                              @for($i=5;$i>=0;$i--)
                                  <option value="{{now()->subYears($i)->year}}" {{now()->subYears($i)->year==now()->year?'selected':''}}>{{now()->subYears($i)->year}}</option>
                              @endfor
                          </select>
                      </div>
                      <div  id="movies-chart-wrapper"></div>
                  </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <div class="card">

                <div class="card-body">


                    <div class="d-flex my-2">
                        <h4 class="mb-0">@lang('movies.top') @lang('movies.popular')</h4>
                        <a href="{{ route('admin.movies.index') }}" class="mx-2 mt-1">@lang('site.show_all')</a>
                    </div>

                    <table class="table">
                        <tr>
                            <th>#</th>
                            <th style="width: 30%;">@lang('movies.title')</th>
                            <th>@lang('movies.vote')</th>
                            <th>@lang('movies.vote_count')</th>
                            <th>@lang('movies.release_date')</th>
                        </tr>

                        @foreach ($popularMovies as $index => $movie)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><a href="{{ route('admin.movies.show', $movie->id) }}">{{ $movie->title }}</a></td>
                                <td><i class="fa fa-star text-warning"></i> <span class="mx-2">{{ $movie->vote }}</span></td>
                                <td>{{ $movie->vote_count }}</td>
                                <td>{{ $movie->release_date }}</td>
                            </tr>
                        @endforeach
                    </table>

                    <div class="d-flex my-2">
                        <h4 class="mb-0">@lang('movies.top') @lang('movies.now_playing')</h4>
                        <a href="{{ route('admin.movies.index', ['type' => 'now_playing']) }}" class="mx-2 mt-1">@lang('site.show_all')</a>
                    </div>

                    <table class="table">
                        <tr>
                            <th>#</th>
                            <th style="width: 30%;">@lang('movies.title')</th>
                            <th>@lang('movies.vote')</th>
                            <th>@lang('movies.vote_count')</th>
                            <th>@lang('movies.release_date')</th>
                        </tr>

                        @foreach ($nowPlayingMovies as $index => $movie)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><a href="{{ route('admin.movies.show', $movie->id) }}">{{ $movie->title }}</a></td>
                                <td><i class="fa fa-star text-warning"></i> <span class="mx-2">{{ $movie->vote }}</span></td>
                                <td>{{ $movie->vote_count }}</td>
                                <td>{{ $movie->release_date }}</td>
                            </tr>
                        @endforeach
                    </table>

                    <hr>

                    <div class="d-flex my-2">
                        <h4 class="mb-0">@lang('movies.top') @lang('movies.upcoming')</h4>
                        <a href="{{ route('admin.movies.index', ['type' => 'upcoming']) }}" class="mx-2 mt-1">@lang('site.show_all')</a>
                    </div>

                    <table class="table">
                        <tr>
                            <th>#</th>
                            <th style="width: 30%;">@lang('movies.title')</th>
                            <th>@lang('movies.vote')</th>
                            <th>@lang('movies.vote_count')</th>
                            <th>@lang('movies.release_date')</th>
                        </tr>

                        @foreach ($upcomingMovies as $index => $movie)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><a href="{{ route('admin.movies.show', $movie->id) }}">{{ $movie->title }}</a></td>
                                <td><i class="fa fa-star text-warning"></i> <span class="mx-2">{{ $movie->vote }}</span></td>
                                <td>{{ $movie->vote_count }}</td>
                                <td>{{ $movie->release_date }}</td>
                            </tr>
                        @endforeach
                    </table>


                </div><!-- end of card body -->

            </div><!-- end of card -->

        </div><!-- end of col -->

    </div><!-- end of row -->

    </div><!-- end of col -->

    </div><!-- end of row -->

@endsection


@push('scripts')
    <script>
        $(function () {
            topStatistics();
            moviesChart("{{now()->year}}");
            $('#movies-chart-year').on('change',function () {
                let year=$(this).find(':selected').val();
                moviesChart(year);
            });
        });
        function topStatistics () {
            $.ajax({
                url:"{{route('admin.home.top-statistics')}}" ,
                cache:false,
                success:function (data) {
                    $("#top-statistics .loader-sm").hide();
                    $("#top-statistics #genres-count").show().text(data.genres_count);
                    $("#top-statistics #movies-count").show().text(data.movies_count);
                    $("#top-statistics #actors-count").show().text(data.actors_count);


                }
            });

        }

        function  moviesChart(year) {
            let  loader=`
               <div class="d-flex justify-content-center align-items-center">
               <div class="loader loader-md"></div>
               </div>
               `;
            $('#movies-chart-wrapper').empty().append(loader);
           $.ajax({
                url:"{{route('admin.home.movies-chart')}}" ,
                data:{
                    'year':year
                },
                cache:false,
                success:function (html) {
                    $('#movies-chart-wrapper').empty().append(html);
                }
            });

        }
    </script>
@endpush
