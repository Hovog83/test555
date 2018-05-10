@extends('back.layout.main')
@section('breadcrumb_first')
    pages
@stop
@section('breadcrumb_second')
    List
@stop
    @section('content')
            <!-- widget grid -->
    <section id="widget-grid" class="">
        <!-- row -->
        <div class="row">
            <!-- NEW WIDGET START -->
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-8" data-widget-editbutton="true">
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
                        <div class="col-xs-12">
                            <a href="/admin/pages/create" class="btn btn-primary" >Create</a>
                        </div>
                            <table id="datatable_cat" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>title</th>
                                        <th>slug</th>
                                        <th>Order</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                            </table>
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
            <!-- PAGE RELATED PLUGIN(S) -->
    <script src="{{asset('assets/back/js/plugin/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/back/js/plugin/datatables/dataTables.colVis.min.js')}}"></script>
    <script src="{{asset('assets/back/js/plugin/datatables/dataTables.tableTools.min.js')}}"></script>
    <script src="{{asset('assets/back/js/plugin/datatables/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/back/js/plugin/datatable-responsive/datatables.responsive.min.js')}}"></script>
    <script type="text/javascript">
        // DO NOT REMOVE : GLOBAL FUNCTIONS!
        $(document).ready(function () {
            pageSetUp();
            $('#datatable_cat').dataTable({
                processing: true,
                serverSide: true,
                ajax: '/admin/pages/anyData',
                "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs' l C>r>" +
                "t" +
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
                "autoWidth": true,
                "fnRowCallback": function(nRow, aData, iDisplayIndex) {
                    nRow.setAttribute('id',aData.id);
                },
                columns: [
                    { data: 'title', name: 'title' },
                    { data: 'slug', name: 'slug' },
                    { data: 'order', name: 'order' },
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
           /* END COLUMN SHOW - HIDE */

                $('tbody').sortable({
                    stop: function( event, ui ) {
                        var sort_url = $(this).attr('data-url');
                        var json = $( "tbody" ).sortable( "toArray" );
                          $.ajax({
                            url: '/admin/pages/sortTable',
                            type: 'GET',
                            data: {sort: json}
                        })
                    }
                });
        })
    </script>
@stop