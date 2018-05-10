@extends('back.layout.main')
@section('breadcrumb_first')
    Categorie
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
                <div class="jarviswidget" id="wid-id-4" data-widget-editbutton="false" data-widget-custombutton="false">
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

                        <h2>Categorie form </h2>

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

                        {{ Form::model($categories,array('class'=>'smart-form'))}}

                        <div class="col-xs-12">
                          <section class="col col-4">
                            {{ Form::label('name', 'Name', array('class' => 'input'))}}
                            {{ Form::text('name', $categories->name, $attributes = array('class'=>'form-control'))}}
                            {{ $errors->addEdit->first('name') }}
                          </section>                           
                          <section class="col col-4">
                            {{ Form::label('icone', 'Icone', array('class' => 'input'))}}
                            {{ Form::text('icone', $categories->icone, $attributes = array('class'=>'form-control'))}}
                            {{ $errors->addEdit->first('icone') }}
                          </section>  
                        </div>          
                        <div class="col-xs-12">
                          <section class="col col-4">
                            {{ Form::label('order', 'order', array('class' => 'input'))}}
                            {{ Form::number('order', $categories->order, $attributes = array('class'=>'form-control'))}}
                            {{ $errors->addEdit->first('order') }}
                          </section>                           
                          <section class="col col-4">
                            {{ Form::label('status', 'status', array('class' => 'input'))}}
                            {{ Form::select('status',array('ACTIVE' => 'ACTIVE', 'DELETED' => 'DELETED'), $categories->status, $attributes = array('class'=>'form-control'))}}
                            {{ $errors->addEdit->first('status') }}
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