@extends('back.layout.main')
@section('breadcrumb_first')
    user
@stop
@section('breadcrumb_second')
    List
@stop
    @section('content')
            <!-- widget grid -->
    <section id="widget-grid" class="">
        <!-- row -->
        <div class="row">
            <!-- NEW COL START -->
            <article class="col-sm-12 col-md-12 col-lg-12">
                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget" id="wid-id-5" data-widget-editbutton="false" data-widget-custombutton="false">
                    <!-- widget options:
                        usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
                        data-widget-colorbutton="false"
                        data-widget-editbutton="false"
                        data-widget-togglebutton="false"
                        data-widget-deletebutton="false"
                        data-widget-fullscreenbutton="false"
                        data-widget-custombutton="false"
                        data-widget-collapsed="true"
                        data-widget-sortable="false"
                    -->
                    <header>
                        <span class="widget-icon"> <i class="fa fa-edit"></i> </span>

                        <h2>user form </h2>

                    </header>

                    <!-- widget div-->
                    <div>
                        <!-- widget edit box -->
                        <div class="jarviswidget-editbox">
                            <!-- This area used as dropdown edit box -->
                        </div>
                        <!-- end widget edit box -->
                        <!-- widget content -->
                        <div class="widget-body no-padding">

                        {{ Form::model($users,array('class'=>'smart-form'))}}

                        <div class="col-xs-12">
                          <section class="col col-6">
                            {{ Form::label('firstname', 'firstname', array('class' => 'input'))}}
                            {{ Form::text('firstname', $users->firstname, $attributes = array('class'=>'form-control'))}}
                            {{ $errors->addEdit->first('firstname') }}
                          </section>                           
                          <section class="col col-6">
                            {{ Form::label('lastname', 'lastname', array('class' => 'input'))}}
                            {{ Form::text('lastname', $users->lastname, $attributes = array('class'=>'form-control'))}}
                            {{ $errors->addEdit->first('lastname') }}
                          </section>  
                        </div>          
                        <div class="col-xs-12">
                          <section class="col col-6">
                            {{ Form::label('email', 'email', array('class' => 'input'))}}
                            {{ Form::text('email', $users->email, $attributes = array('class'=>'form-control'))}}
                            {{ $errors->addEdit->first('email') }}
                          </section>                           
                          <section class="col col-6">
                            {{ Form::label('status', 'status', array('class' => 'input'))}}
                            {{ Form::select('status',array('ACTIVE'=>'ACTIVE','DELETED'=>'DELETED','BLOCKED'=>'BLOCKED','BANNED'=>'BANNED','NEW'), $users->status, $attributes = array('class'=>'form-control'))}}
                            {{ $errors->addEdit->first('status') }}
                          </section>  
                        </div>                        
                        <div class="col-xs-12">
                          <section class="col col-6">
                            {{ Form::label('address', 'address', array('class' => 'input'))}}
                            {{ Form::text('address', $users->address, $attributes = array('class'=>'form-control'))}}
                            {{ $errors->addEdit->first('address') }}
                          </section>                           
                          <section class="col col-6">
                            {{ Form::label('role', 'role', array('class' => 'input'))}}
                            {{ Form::select('role',array('USER'=>'USER','ADMIN'=>'ADMIN','MODERATOR'=>'MODERATOR'), $users->role, $attributes = array('class'=>'form-control'))}}
                            {{ $errors->addEdit->first('role') }}
                          </section>  
                        </div>                       
                        <div class="col-xs-12">
                          <section class="col col-6">
                            {{ Form::label('password', 'password', array('class' => 'input'))}}
                            {{ Form::text('password', "", $attributes = array('class'=>'form-control'))}}
                            {{ $errors->addEdit->first('password') }}
                          </section>                            
                          <section class="col col-6">
                            {{ Form::label('rpassword', 'rpassword', array('class' => 'input'))}}
                            {{ Form::text('rpassword', "", $attributes = array('class'=>'form-control'))}}
                            {{ $errors->addEdit->first('rpassword') }}
                          </section>  
                        </div>                  
                        <div class="col-xs-12">
                          <section class="col col-6">
                            {{ Form::label('home_phone', 'home_phone', array('class' => 'input'))}}
                            {{ Form::text('home_phone', $users->home_phone, $attributes = array('class'=>'form-control'))}}
                            {{ $errors->addEdit->first('home_phone') }}
                          </section>                           
                          <section class="col col-6">
                              {{ Form::label('mobile_phone', 'mobile_phone', array('class' => 'input'))}}
                              {{ Form::text('mobile_phone', $users->mobile_phone, $attributes = array('class'=>'form-control'))}}
                              {{ $errors->addEdit->first('mobile_phone') }}
                          </section>  
                        </div>
                        <div class="col-xs-12">
                        {{ Form::submit('Submit',$attributes = array('class'=>'btn btn-primary') )}}
                        </div>

                        </div>
                        <!-- end widget content -->

                    </div>
                    <!-- end widget div -->

                </div>
                <!-- end widget -->
            </article>
            <!-- END COL -->
        </div>
        <!-- end row -->
    </section>
    @stop
    @section('scripts')
            <!-- PAGE RELATED PLUGIN(S) -->
    <script src="{{asset('/back/js/plugin/jquery-form/jquery-form.min.js')}}"></script>


    <script type="text/javascript">

        // DO NOT REMOVE : GLOBAL FUNCTIONS!

        $(document).ready(function () {
            pageSetUp();

            var depends = {
                depends: function () {
                    return !$("input[name='id']").val();
                }
            };

            $("#smart-form-register").validate({
                // Rules for form validation
                rules: {
                    email: {
                        required: depends
                    },
                    password: {
                        required: depends,
                        minlength: 3,
                        maxlength: 20
                    },
                    password_confirmation: {
                        required: depends,
                        minlength: 3,
                        maxlength: 20,
                        equalTo: '#password'
                    },
                    first_name: {
                        required: true
                    },
                    last_name: {
                        required: true,
                    }
                },

                // Messages for form validation
                messages: {
                    password: {
                        required: 'Please enter your password'
                    },
                    password_confirmation: {
                        required: 'Please enter your password one more time',
                        equalTo: 'Please enter the same password as above'
                    },
                    first_name: {
                        required: 'Please select your first name'
                    },
                    last_name: {
                        required: 'Please select your last name'
                    }
                },

                // Do not change code below
                errorPlacement: function (error, element) {
                    error.insertAfter(element.parent());
                }
            });
        })
    </script>
@stop