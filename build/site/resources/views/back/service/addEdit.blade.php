@extends('back.layout.main')
@section('breadcrumb_first')
    services
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

                        <h2>services form </h2>

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

                        {{ Form::model($services,array('class'=>'smart-form','files'=>true))}}

                        <div class="col-xs-12">
                          <section class="col col-4">
                            {{ Form::label('title', 'title', array('class' => 'input'))}}
                            {{ Form::text('title', $services->title, $attributes = array('class'=>'form-control'))}}
                            {{ $errors->addEdit->first('title') }}
                          </section>                           
                          <section class="col col-4">
                          {{ Form::label('status', 'status', array('class' => 'input'))}}
                          {{ Form::select('status',array('NEW' => 'NEW', 'APPROVED' => 'APPROVED', 'BLOCKED' => 'BLOCKED', 'DELETED' => 'DELETED'), $services->status, $attributes = array('class'=>'form-control'))}}
                          {{ $errors->addEdit->first('status') }}
                          </section>  
                        </div>                  
                        <div class="col-xs-12">
                          <section class="col col-4">
                              {{ Form::label('cat_id', 'cat_id', array('class' => 'input'))}}
                              {{ Form::select('cat_id',$cat, $services->cat_id, $attributes = array('class'=>'form-control'))}}
                              {{ $errors->addEdit->first('cat_id') }}
                          </section>                           
                          <section class="col col-4">
                                 {{ Form::label('subCat_id', 'subCat_id', array('class' => 'input'))}}
                                 {{ Form::select('subCat_id',$subcategory, $services->subCat_id, $attributes = array('class'=>'form-control'))}}
                                 {{ $errors->addEdit->first('subCat_id') }}          
                          </section>  
                        </div>                          
                        <div class="col-xs-12">
                          <section class="col col-4">
                            {{ Form::label('order', 'order', array('class' => 'input'))}}
                            {{ Form::number('order', $services->order, $attributes = array('class'=>'form-control'))}}
                            {{ $errors->addEdit->first('order') }}
                          </section>                           
                          <section class="col col-4">
                              {{ Form::label('description', 'description', array('class' => 'input'))}}
                              {{ Form::textarea('description', $services->description, $attributes = array('class'=>'form-control'))}}
                              {{ $errors->addEdit->first('description') }}
                          </section>  
                        </div>                        
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
                <div class="jarviswidget" id="wid-id-15" data-widget-editbutton="false" data-widget-custombutton="false">
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
                        <h2>services Imges </h2>
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
                                    @foreach($services->getServiceImages() as $value)
                                    <li class="pull-left text-center" id="<?= $value->id ?>">
                                      <div class="col-xs-2">
                                          <img class="imgF margin-10" src="/uploads/miny_{{$value->image}}" alt="">
                                          <a href="#" class="deleteImges btn btn-danger"  data-id="{{$value->id}}" >X</a>
                                          @if($value->mine == 0)
                                            <a href="#" class="btn btn-primary setMain"  data-services="{{$services->id}}" data-id="{{$value->id}}" >Set as main imges</a>
                                          @else
                                            <span  class="btn btn-info disabledSetMain" data-services="{{$services->id}}" data-id="{{$value->id}}"  disabled >main</span>
                                          @endif
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
                    url: '/admin/service/deleteImages/'+id,
                    type: 'get',
                    success: function (data) {
                        elem.parent().remove();  
                    }
            })
        })       
        $(document).on("click",".setMain",function(e) {
                e.preventDefault();
                elem = $(this);
                id = $(this).data("id");
                services = $(this).data("services");
                $.ajax({
                    url: '/admin/service/setMainImages/'+id+"/"+services,
                    type: 'get',
                    success: function (data) {
                      if(data == "true"){
                         $(".disabledSetMain").removeClass('disabledSetMain').removeClass('setMain').removeClass('btn-info').addClass('btn-primary').addClass('setMain').text('Set as main imges').removeAttr('disabled');     
                          elem.text('main').removeClass('setMain').addClass("disabledSetMain").addClass('btn-info').attr('disabled', 'disabled');
                      }
                    }
            })
        })
        $("#cat_id").on("change",function(e) {
               e.preventDefault();
               id =  $( "#cat_id option:selected" ).val();
               $.ajax({
                   url: '/admin/service/getSubCat/'+id,
                   type: 'get',
                   dataType: "json",
                   success: function (data) {
                    $("#subCat_id").html("");
                    $.each( data, function( key, value ) {
                        $("#subCat_id").append('<option value="'+key+'" >'+value+'</option>')
                    });
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


        $('#images').sortable({
            stop: function( event, ui ) {
                var sort_url = $(this).attr('data-url');
                var json = $( "#images" ).sortable("toArray");
                  $.ajax({
                    url: '/admin/service/sortImages',
                    type: 'GET',
                    data: {images: json}
                })
            }
        });
 })



    </script>
@stop