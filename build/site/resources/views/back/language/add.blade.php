@extends('back.layout.main')
@section('header_link')
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/back/css/bootsrtap-form-helpers/dist/css/bootstrap-formhelpers.min.css')}}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/back/css/language.css')}}">
@stop
@section('breadcrumb_first')
    Language
@stop
@section('breadcrumb_second')
    Add
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

                        <h2>Language Form </h2>
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
                            <form id="smart-form-register" class="smart-form" action="/admin/language/edit" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <fieldset>
                                    <section>
                                        <label class="toggle"><input type="checkbox" id="fallback_locale" name="fallback_locale" ><i data-swchon-text="ON" data-swchoff-text="OFF"></i>Fallback locale
                                        </label>
                                        <div class="note">You can change language fallback locale, by switching ON/OFF (not recommended)
                                        </div>
                                    </section>
                                    <section>
                                        <?php
                                            $langList = [];
                                            foreach($language as $lang){
                                                $langList[] =  $lang->language;
                                            }
                                        ?>
                                            <input type="hidden" name="language" value="">
                                            <div class="bfh-selectbox bfh-languages" data-available="{{ implode($langList, ',') }}" data-flags="true" data-allow-blank="false">
                                            <input type="hidden" value="">
                                            <a class="bfh-selectbox-toggle" role="button" data-toggle="bfh-selectbox" href="#">
                                                <span class="bfh-selectbox-option input-medium" data-option=""></span>
                                                <b class="caret"></b>
                                            </a>
                                            <div class="bfh-selectbox-options">
                                                <div role="listbox">
                                                    <ul role="option">
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </fieldset>
                                <footer>
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                </footer>
                            </form>

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
    <script src="{{asset('assets/back/js/plugin/jquery-form/jquery-form.min.js')}}"></script>
    <script src="{{asset('assets/back/css/bootsrtap-form-helpers/dist/js/bootstrap-formhelpers.min.js')}}"></script>



    <script type="text/javascript">

        // DO NOT REMOVE : GLOBAL FUNCTIONS!

        $(document).ready(function () {
            pageSetUp();

            $(document).on('click', 'button[type=submit]', function(e){
                var language = $('.bfh-languages input').val();
                if(language == ''){
                    e.preventDefault();
                    $('.bfh-selectbox-toggle').css('border-color', '#A90329');
                }
                $('input[name=language]').val(language);
            });


        })
    </script>
@stop