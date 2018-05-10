@extends('back.layout.main')
@section('breadcrumb_first')
    image_model
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
                <div class="jarviswidget" id="wid-id-41551" data-widget-editbutton="false" data-widget-custombutton="false">
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

                        <h2>image_model form </h2>

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

                        {{ Form::model($image_model,array('class'=>'smart-form','files'=>true))}}

                        <div class="col-xs-12">
                          <section class="col col-4">
                                {{ Form::label('file', 'file', array('class' => 'input'))}}
                                {!! Form::file('images[]', array('multiple'=>true)) !!}
                                {{ $errors->addEdit->first() }}
                          </section>  
                        </div>                       
                        <div class="col-xs-12">                      
                          <section class="col col-8">
                                <div class="imagesBlok">
                                    
                                </div>
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
        <div class="row">
            <!-- NEW COL START -->
            <article class="col-sm-12 col-md-12 col-lg-12">
                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget" id="wid-id-41551888" data-widget-editbutton="false" data-widget-custombutton="false">
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
                        <h2>image_model Imges </h2>
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
                                <div class="col-xs-12">
                                  <ul>
                                <ul class="gallery" id="images" >
                                    @foreach($images as $value)
                                    <li class="pull-left text-center" id="<?= $value->id ?>">
                                      <div class="col-xs-2">
                                          <img class="imgF margin-10" src="/page/miny_{{$value->image}}" alt="">
                                          <p onclick="copyToClipboard('/page/thumb_{{$value->image}}')" >URL</p>
                                          <a href="#" class="deleteImges btn btn-danger"  data-id="{{$value->id}}" >X</a>
                                      </div>
                                    </li>
                                    @endforeach
                                    </ul>
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
    </section>
    @stop
    @section('scripts')
            <!-- PAGE RELATED PLUGIN(S) -->
    <script type="text/javascript">
        // DO NOT REMOVE : GLOBAL FUNCTIONS!
        $(document).ready(function () {
            pageSetUp();
        file = document.querySelector('input[type=file]');
        $(".deleteImges").on("click",function(e) {
                e.preventDefault();
                elem = $(this);
                id = $(this).data("id");
                $.ajax({
                    url: '/admin/images/deleteImages/'+id,
                    type: 'get',
                    success: function (data) {
                        elem.parent().remove();  
                    }
            })
        })       

        $("input[type=file]").on("change",function() {
           $(".imagesBlok").html("");
           file_length =  document.querySelector('input[type=file]').files.length
            for (i = 0; i < file_length; i++) {
               file_ =  document.querySelector('input[type=file]').files[i];
                $(".imagesBlok").append('<img id="img_'+i+'" class="imgF">');
                previewFile(file_,i);
            }
        })

        function previewFile(file,img) {
          var reader  = new FileReader();
          reader.onloadend = function () {
            $("#img_"+img).attr('src',  reader.result);
          }
          if (file) {
            reader.readAsDataURL(file);
          } else {
             $("#img_"+img).attr('src', "")
            // preview.src = "";
          }
        }

      })

        function copyToClipboard(text) {
          window.prompt("Copy to clipboard: Ctrl+C, Enter", text);
        }


    </script>
@stop