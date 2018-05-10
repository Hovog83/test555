@extends('back.layout.main')
@section('breadcrumb_first')
    task
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
                        <h2>task form </h2>
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

                        {{ Form::model($task,array('class'=>'smart-form'))}}

                        <div class="col-xs-12">
                          <section class="col col-6">
                            {{ Form::label('title', 'title', array('class' => 'input'))}}
                            {{ Form::text('title', $task->title, $attributes = array('class'=>'form-control'))}}
                            {{ $errors->addEdit->first('title') }}
                          </section>    
                          <section class="col col-6">
                            {{ Form::label('status', 'status', array('class' => 'input'))}}
                            {{ Form::select('status',array('ACTIVE'=>'ACTIVE','DAN'=>'DAN','BUG'=>'BUG'), $task->status, $attributes = array('class'=>'form-control'))}}
                            {{ $errors->addEdit->first('status') }}
                          </section>  
                        </div>          
                        <div class="col-xs-12">
                          <section class="col col-4">
                            {{ Form::label('start_date', 'start_date', array('class' => 'input datepicker'))}}
                            {{ Form::text('start_date', $task->start_date, $attributes = array('class'=>'form-control'))}}
                            {{ $errors->addEdit->first('start_date') }}
                          </section>          
                          <section class="col col-4">
                            {{ Form::label('end_date', 'end_date', array('class' => 'input datepicker'))}}
                            {{ Form::text('end_date', $task->end_date, $attributes = array('class'=>'form-control'))}}
                            {{ $errors->addEdit->first('end_date') }}
                          </section>   
                          <section class="col col-4">
                            {{ Form::label('user_id', 'user_id', array('class' => 'input'))}}
                            {{ Form::select('user_id[]',$users, $task->user_id, $attributes = array('class'=>'form-control select2','multiple'=>'multiple'))}}
                            {{ $errors->addEdit->first('user_id') }}
                          </section> 
                        </div>     
                        <div class="col-xs-12">
                                {{ Form::label('description', 'description', array('class' => 'input'))}}
                                {{ Form::textarea('description', $task->description, $attributes = array('class'=>'form-control'))}}
                                {{ $errors->addEdit->first('description') }}
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
    <script src="{{asset('assets/back/js/plugin/ckeditor/ckeditor.js')}}"></script>

    
    <script type="text/javascript">
        // DO NOT REMOVE : GLOBAL FUNCTIONS!
        $(document).ready(function () {
            pageSetUp();
            $("#start_date").datepicker({ dateFormat: 'yy-mm-dd' })
            $("#end_date").datepicker({ dateFormat: 'yy-mm-dd' })
            editor =   CKEDITOR.replace( 'description', { height: '380px', startupFocus : true,filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images', 
              filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}', 
              filebrowserBrowseUrl: '/laravel-filemanager?type=Files', 
              filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'} );
        })
        $(document).on('click', '#imagesbu', function(event) {
          event.preventDefault();
                $("#images").toggle();

        })
    </script>
@stop