@extends('front.layout.main')
@section('content')
<!-- Basic Styles -->
<style type="text/css" media="screen">
    #datatable_cat  thead{
    display:none;
}
</style>
<link rel="stylesheet" type="text/css" media="screen" href="{{asset('/assets/back/css/bootstrap.min.css')}}">

<!-- SmartAdmin Styles : Caution! DO NOT change the order -->
<link rel="stylesheet" type="text/css" media="screen"
      href="{{asset('/assets/back/css/smartadmin-production-plugins.min.css')}}">

<!-- SmartAdmin RTL Support  -->
<link rel="stylesheet" type="text/css" media="screen" href="{{asset('/assets/back/css/smartadmin-rtl.min.css')}}">
  <div id="company" class="main-content">
    <div class="container">
      <div class="row">
        <!-- Start Page-Content -->
        <div class="page-content col-lg-8 col-md-8 col-sm-8">
            <table id="datatable_cat" class="table company-list">
                <thead>
                    <tr class="company-list-single">
                        <th>Image</th>
                        <th>Info</th>
                    </tr>
                </thead>
            </table>
        </div>
          <div class="sidebar-content col-lg-4 col-md-4 col-sm-4">
            <div class="banner">
              <a href="#">
                <img src="{{asset('/assets/front/img/sidebar_banner.png')}}" alt="">
              </a>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
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
            $('#datatable_cat').dataTable({
                processing: true,
                serverSide: true,
                "fnDrawCallback": function ( oSettings ) {
                    $(oSettings.nTHead).hide();
                },
                ajax: '/classifieds/anyData',
                "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs' l C>r>" +
                "t" +
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
                "autoWidth": true,
                columns: [
                    { data: 'image', name: 'image' , orderable: false, searchable: false},
                    { data: 'info', name: 'info', orderable: false, searchable: false },
                ]
            });
           /* END COLUMN SHOW - HIDE */
        })
    </script>
@stop