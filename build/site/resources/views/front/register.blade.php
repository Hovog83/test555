@extends('front.main.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">


                            <div class="form-group">
                                <label class="col-md-4 control-label">First Name</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="firstname" value="">


                                </div>

                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Last Name</label>

                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="lastname" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" value="">


                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password">


                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password_confirmation">

                                </div>
                            </div>
                            <div class="form-group" style="display:none">
                                <label class="col-md-4 control-label"></label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="role" value="USER">
                                </div>
                            </div>
                            <div class="form-group" style="display:none">
                                <label class="col-md-4 control-label"></label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="status" value="NEW">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <input type="submit" name="submit" value="Submit" class="btn btn-primary">

                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
