@extends('layouts.master')


@section('content')

    <section>
    <h1>Leaderboard</h1>
        <p class="sub-title"> Weekly geek ranking! </p>
        <select class="leaderboards-filter" name="leaderboardfilter" id="filter">
            <option value="Km">Total distance</option>
            <option value="Time">Total time</option>
        </select>


    <div class="leaderboards-data leaderboards-data--head">
        <p>Nr.</p>
        <p>Geek</p>
        <p>Performance</p>
    </div>
    <div id="Km" class="leaderboard">
    @foreach($leaderboard['Kilometers'] as $key =>  $r)
        <div id="km-item" class="leaderboards-data">
            @if($key == 0)
                <p>{{ $key+1 }}<span class="medal"><img src="/img/medals/gold-medal.png" alt="" class="medal-img"></span></p>
            @elseif($key == 1)
                <p>{{ $key+1 }}<span class="medal"><img src="/img/medals/silver-medal.png" alt="" class="medal-img"></span></p>
            @elseif($key == 2)
                <p>{{ $key+1 }}<span class="medal"><img src="/img/medals/bronze-medal.png" alt="" class="medal-img"></span></p>
            @else
                <p>{{ $key+1 }}</p>
            @endif
            <p class="leaderboards-data--nerd"><a href="/user/{{$r['user']->id}}">{{ $r['user']->firstname . ' ' . $r['user']->lastname}}</a>

            </p>
            <p>{{ $r['km'] . " km"}}</p>
        </div>
        <hr>
    @endforeach
    </div>

    <div id="Time" class="leaderboard">
    @foreach($leaderboard['Time'] as $key =>  $r)
        <div id="time-item" class="leaderboards-data">
            @if($key == 0)
                <p>{{ $key+1 }}<span class="medal"><img src="/img/medals/gold-medal.png" alt="" class="medal-img"></span></p>
            @elseif($key == 1)
                <p>{{ $key+1 }}<span class="medal"><img src="/img/medals/silver-medal.png" alt="" class="medal-img"></span></p>
            @elseif($key == 2)
                <p>{{ $key+1 }}<span class="medal"><img src="/img/medals/bronze-medal.png" alt="" class="medal-img"></span></p>
            @else
                <p>{{ $key+1 }}</p>
            @endif

            <p class="leaderboards-data--nerd"><a href="/user/{{$r['user']->id}}">{{ $r['user']->firstname . ' ' . $r['user']->lastname}}</a>


            </p>

            <p>{{ $r['time'] . " minutes"}}</p>
        </div>
        <hr>
    @endforeach
    </div>
@endsection

    </section>

@section('scripts')
    <script src="/js/leaderboardsfilter.js"></script>
@endsection