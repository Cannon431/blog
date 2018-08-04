@extends('layouts.main')
@section('title') 404 @endsection
@section('content')
<div class="st-content">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="primary" class="content-area padding-content white-color">
                    <main id="main" class="site-main" role="main">

                        <section class="error-404 not-found text-center">
                            <h1 class="404">404</h1>

                            <p class="lead">Такого не существует</p>

                            <div class="row">
                                <div class="col-sm-4 col-sm-offset-4">
                                    <p class="go-back-home"><a href="{{ url('/') }}">На главную страницу</a></p>
                                </div>
                            </div>

                        </section><!-- .error-404 -->

                    </main><!-- #main -->
                </div><!-- #primary -->
            </div>
        </div>
    </div>
</div>
@endsection