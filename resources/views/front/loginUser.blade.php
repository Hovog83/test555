@extends('front.layout.signin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="/login">
                        {!! csrf_field() !!}
                        @if(session('message'))
                            <fieldset>
                                <section>
                                    <div class="alert alert-success" role="alert">
                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                        <span class="sr-only">Success:</span>
                                        {{session('message')}}
                                    </div>
                                </section>
                            </fieldset>
                        @endif
                        @if($errors->first('form'))
                            <div class="alert alert-danger" role="alert">
                                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                <span class="sr-only">Error:</span>
                                {{ @$errors->first('form') }}
                            </div>
                        @endif
                        <div class="form-group">
                            <label class="col-md-4 control-label">code</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="code" value="{{ old('code') }}">

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i>Login
                                </button>

                                <a class="btn btn-link" href="{{ url('/reset') }}">Forgot Your Password?</a>
                            </div>
                            <div></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
