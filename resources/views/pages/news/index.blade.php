@extends('layouts.app')

@section('content')
    <h3>News</h3>
    <section class="news-feed section-container">
        @php $i = 0; @endphp
        @if(!$links->isEmpty())
            <news-list inline-template>
                <div>
                    @foreach ($links as $link)
                            @php $i++; @endphp
                            <div class="animated fadeInUp delay-{{$i}}s faster">
                                <div class="item row">
                                        <div class="number">{{$i}}</div>
                                        <div class="meta">
                                            <h2>
                                                <a href="{{$link->source_link}}" target="_blank">{{$link->source_title}} ({{$link->source_name}})</a>
                                            </h2>
                                            <p>
                                                <span class="tags">Tag: {{$link->tag_name}}</span> - 
                                                <span class="dated-posted">Added {{ \Carbon\Carbon::parse($link->source_date)->diffForHumans() }}</span>
                                                <span class="favourites"><a href="#" v-on:click="favourite({{$link->source_link_id}}, {{$link->favorited}})">{{$link->favorited_label}}</a></span>
                                            </p>
                                        </div>
                                </div>
                            </div>
                    @endforeach
                </div>
            </news-list>
        @else
            <h2>Your feed</h2>
            <p>Your feed is empty. Have you added sources and tags in your <a href="{{route('settings.account')}}">settings</a>?</p>
        @endif
        {{ $links->links() }}
    </section>
@endsection
