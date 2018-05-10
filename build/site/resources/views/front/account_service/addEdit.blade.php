@extends('front.layout.main')
@section('breadcrumb_first')
    services
@stop
@section('breadcrumb_second')
    List
@stop
    @section('content')
            <!-- widget grid -->
            {{ Form::model($services,array('class'=>'default-form','files'=>true))}}

                                  <div class="col-xs-12">
                                    <div class="col-lg-6 col-md-6">
                                      {{ Form::label('title', 'title', array('class' => 'input'))}}
                                      {{ Form::text('title', $services->title, $attributes = array('class'=>'form-control'))}}
                                      {{ $errors->addEdit->first('title') }}
                                    </div>   
                                    <div class="col-lg-6 col-md-6">
                                        {{ Form::label('cat_id', 'cat_id', array('class' => 'input'))}}
                                        {{ Form::select('cat_id',$cat, $services->cat_id, $attributes = array('class'=>'form-control'))}}
                                        {{ $errors->addEdit->first('cat_id') }}
                                    </div>                        
                                  </div>                  
                                  <div class="col-xs-12">
                                     <div class="col-lg-6 col-md-6">
                                            {{ Form::label('subCat_id', 'subCat_id', array('class' => 'input'))}}
                                            {{ Form::select('subCat_id',$subcategory, $services->subCat_id, $attributes = array('class'=>'form-control'))}}
                                            {{ $errors->addEdit->first('subCat_id') }}          
                                     </div>
                                  </div>                          
                                  <div class="col-xs-12">
                                    <div class="col-lg-6 col-md-6">
                                        {{ Form::label('description', 'description', array('class' => 'input'))}}
                                        {{ Form::textarea('description', $services->description, $attributes = array('class'=>'form-control'))}}
                                        {{ $errors->addEdit->first('description') }}
                                    </div> 
                                    <div class="col-lg-6 col-md-6">
                                          {{ Form::label('file', 'file', array('class' => 'input'))}}
                                          {!! Form::file('images[]', array('multiple'=>true)) !!}
                                          {{ $errors->addEdit->first() }}
                                          <div class="col col-12">
                                                <div class="imagesBlok">
                                                    
                                                </div>
                                          </div>  
                                    </div>   
                                  </div>  
                                  <div class="col-xs-12">
                                  {{ Form::submit('Submit',$attributes = array('class'=>'btn btn-primary') )}}

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


                                      @section('scripts')
                                              <!-- PAGE RELATED PLUGIN(S) -->
                                      <script type="text/javascript">
                                          // DO NOT REMOVE : GLOBAL FUNCTIONS!
                                          $(document).ready(function () {
                                          file = document.querySelector('input[type=file]');
                                          $(".deleteImges").on("click",function(e) {
                                                  e.preventDefault();
                                                  elem = $(this);
                                                  id = $(this).data("id");
                                                  $.ajax({
                                                      url: '/service/deleteImages/'+id,
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
                                                      url: '/service/setMainImages/'+id+"/"+services,
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
                                                     url: '/service/getSubCat/'+id,
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
                                                      url: '/service/sortImages',
                                                      type: 'GET',
                                                      data: {images: json}
                                                  })
                                              }
                                          });
                                   })



                                      </script>
                                  @stop
    @stop
  