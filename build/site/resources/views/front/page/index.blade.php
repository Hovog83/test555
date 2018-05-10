@extends('front.layout.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="headline centered">{{trans('interface.'.$page["titleCode"])}}</h3>
            </div>
        </div>
    </div>
    <!-- Stages -->
    <div class="container">
        {!! trans('page.'.$page["titleCode"].'_html') !!}
    </div>

@endsection
