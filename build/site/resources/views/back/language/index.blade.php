@extends('back.layout.main')
@section('header_link')
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/back/css/bootsrtap-form-helpers/dist/css/bootstrap-formhelpers.min.css')}}">
@stop
@section('breadcrumb_first')
    Language
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
                <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-2" data-widget-editbutton="false">
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

                            <table id="datatable_col_reorder" class="table table-striped table-bordered table-hover"
                                   width="100%">
                                <thead>
                                <tr>
                                    <th data-hide="phone">ID</th>
                                    <th data-class="expand"><i class="fa fa-fw fa-language text-muted hidden-md hidden-sm hidden-xs"></i> Language</th>
                                    <th data-hide="phone">Fallback Locale</th>
                                    <th data-hide="phone">Created At</th>
                                    <th data-hide="phone">Updated At</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($language as $value)
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td><span class="bfh-languages" data-language="{{ $value->code }}_{{ $value->country_code }}" data-flags="true"></span></td>
                                        <td>
                                            @if ($value->fallback_locale === 1)
                                                <span class="label label-success">On</span>
                                            @else
                                                <span class="label label-danger">Off</span>
                                            @endif
                                        </td>
                                        <td>{{ $value->created_at }}</td>
                                        <td>{{ $value->updated_at }}</td>
                                        <td>
                                            <ul class="demo-btns">
                                                <li>
                                                    <a href="/admin/language/edit/{{ $value->id }}" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i>
                                                        Edit</a>
                                                </li>
                                                <li>
                                                    <a href="/admin/language/delete/{{ $value->id }}" class="btn btn-xs btn-danger"><i class="fa fa-remove"></i>
                                                        Delete</a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
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
    <script src="{{asset('assets/back/css/bootsrtap-form-helpers/dist/js/bootstrap-formhelpers.min.js')}}"></script>


    <script type="text/javascript">

        // DO NOT REMOVE : GLOBAL FUNCTIONS!

        $(document).ready(function () {

            pageSetUp();

            /* // DOM Position key index //

             l - Length changing (dropdown)
             f - Filtering input (search)
             t - The Table! (datatable)
             i - Information (records)
             p - Pagination (paging)
             r - pRocessing
             < and > - div elements
             <"#id" and > - div with an id
             <"class" and > - div with a class
             <"#id.class" and > - div with an id and class

             Also see: http://legacy.datatables.net/usage/features
             */

            /* BASIC ;*/
            var responsiveHelper_datatable_col_reorder = undefined;

            var breakpointDefinition = {
                tablet: 1024,
                phone: 480
            };
            /* COLUMN SHOW - HIDE */
            $('#datatable_col_reorder').dataTable({
                "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs' l C>r>" +
                "t" +
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
                "autoWidth": true,
                "preDrawCallback": function () {
                    // Initialize the responsive datatables helper once.
                    if (!responsiveHelper_datatable_col_reorder) {
                        responsiveHelper_datatable_col_reorder = new ResponsiveDatatablesHelper($('#datatable_col_reorder'), breakpointDefinition);
                    }
                },
                "rowCallback": function (nRow) {
                    responsiveHelper_datatable_col_reorder.createExpandIcon(nRow);
                },
                "drawCallback": function (oSettings) {
                    responsiveHelper_datatable_col_reorder.respond();
                }
            });
            /* END COLUMN SHOW - HIDE */
        })
    </script>
@stop