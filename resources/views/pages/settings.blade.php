@extends('layouts.app')

@section('content')
    <div class="container settings-container">
        <div class="row">
            @include('partials.sidebar')

            <main class="col-7">
                <section class="settings-news section-container">
                    <h4>News Sources</h4>
                    <news-sources></news-sources>
                </section>

                <section class="basic-information section-container">
                    <h4>Tags</h4>
                    <p>Tags to look out in articles for</p>
                    <news-tags></news-tags>
                </section>
            </main>
        </div>
    </div>
@endsection