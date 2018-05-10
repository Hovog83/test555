@extends('back.layout.main')
@section('breadcrumb_first')
    menu
@stop
@section('breadcrumb_second')
    List
@stop
    @section('content')
            <!-- widget grid -->
        <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/back/css/smartadmin-production-plugins.min.css')}}">

    <section id="widget-grid" class="">
        <!-- row -->
        <div class="row">
            <!-- NEW WIDGET START -->
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-80" data-widget-editbutton="true">
                    <!-- widget options:
                    usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="true">
                    data-widget-colorbutton="true"
                    data-widget-editbutton="true"
                    data-widget-togglebutton="true"
                    data-widget-deletebutton="true"
                    data-widget-fullscreenbutton="true"
                    data-widget-custombutton="true"
                    data-widget-collapsed="true"
                    data-widget-sortable="true"
                    -->
                    <header>
                        <span class="widget-icon"> <i class="fa fa-table"></i> </span>

                        <h2>List </h2>

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
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>title</th>   
                                    <th>slug</th>   
                                    <th>View</th>   
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($page as $value)
                                <tr class="smart-form" id="{{ $value->id}}" >
                                    <td>{{$value->title}}</td>
                                    <td>{{$value->slug}}</td>
                                    <td>
                                    @if($menuPages->isPageChecked(['page_id'=>$value->id,"menu_id"=>$id]))
                                         <section class="col col-5">                
                                            <label class="toggle"><input type="checkbox" class="checkboxA" data-menu="{{$id}}" data-page="{{$value->id}}" value="1" checked><i data-swchon-text="ON" data-swchoff-text="OFF"></i></label>
                                         </section>
                                    @else
                                    <section class="col col-5">                
                                       <label class="toggle"><input type="checkbox" data-menu="{{$id}}" data-page="{{$value->id}}"  class="checkboxA" value="1" ><i data-swchon-text="ON" data-swchoff-text="OFF"></i></label>
                                    </section>
                                    @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                            <button type="button" class="btn btn-primary checkboxSave">Save</button>
                        </div>
                        <!-- end widget content -->
                    </div>
                    <!-- end widget div -->
                </div>
                <!-- end widget -->
            </article>
            <!-- WIDGET END -->
        </div>
        <!-- end row -->
        <!-- end row -->
    </section>
    <!-- end widget grid --> 
    @stop
    @section('scripts')

            

    <script src="{{asset('assets/back/js/plugin/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/back/js/plugin/datatables/dataTables.colVis.min.js')}}"></script>
    <script src="{{asset('assets/back/js/plugin/datatables/dataTables.tableTools.min.js')}}"></script>
    <script src="{{asset('assets/back/js/plugin/datatables/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/back/js/plugin/datatable-responsive/datatables.responsive.min.js')}}"></script>
    <script type="text/javascript">
        // DO NOT REMOVE : GLOBAL FUNCTIONS!
        $(document).ready(function () {
            pageSetUp();

            function toObject(arr) {
              var rv = {};
              for (var i = 0; i < arr.length; ++i)
                if (arr[i] !== undefined) rv[i] = arr[i];
              return rv;
            }
            $(".checkboxSave").on('click',function(event) {
               json = [];
                $( ".checkboxA" ).each(function( key,index ) {
                      checked = $(this).is(':checked');
                      json[key] = [];
                     json[key]["1"] = checked;
                        page  =  $(this).data("page");
                     json[key]["2"] = page;
                     json[key] = toObject(json[key])
                });
                   $.ajax({
                        url: '/admin/MenuPages/isPageCheckedSave',
                        type: 'GET',
                        data: {isChecked: toObject(json),menu:$( ".checkboxA" ).data("menu") }
                    })
            });

            $('tbody').sortable({
                stop: function( event, ui ) {
                    var sort_url = $(this).attr('data-url');
                    var json = $( "tbody" ).sortable( "toArray" );
                      $.ajax({
                        url: '/admin/MenuPages/sortTable',
                        type: 'GET',
                        data: {sort: json}
                    })
                }
            });
        })
    </script>
@stop