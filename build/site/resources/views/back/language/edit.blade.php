@extends('back.layout.main')
@section('header_link')
    <link rel="stylesheet" type="text/css" media="screen"
          href="{{asset('assets/back/css/bootsrtap-form-helpers/dist/css/bootstrap-formhelpers.min.css')}}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/back/css/language.css')}}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/back/css/toastr/toastr.min.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('breadcrumb_first')
    Language
@stop
@section('breadcrumb_second')
    Edit
    @stop
    @section('content')
            <!-- widget grid -->
    <div id="widget-grid" class="">
        <section>
            <!-- row -->
            <div class="row">
                <!-- NEW COL START -->
                <article class="col-sm-12 col-md-12 col-lg-12">
                    <!-- Widget ID (each widget will need unique ID)-->
                    <div class="jarviswidget" id="wid-id-4" data-widget-editbutton="false"
                         data-widget-custombutton="false">
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

                                <form id="smart-form-register" class="smart-form" action="/admin/language/edit/{{ @$language->id }}"
                                      method="post">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="id" value="{{ @$language->id }}"
                                           data-code="{{ @$language->code }}">
                                    <fieldset>
                                        <section>
                                            <span class="bfh-languages"
                                                  data-language="{{ @$language->code . '_' . @$language->country_code }}"
                                                  data-flags="true"></span>

                                            <div class="note">{{ @$language->name }}</div>
                                        </section>
                                        <section>
                                            <label class="toggle"><input type="checkbox" id="fallback_locale"
                                                                         name="fallback_locale" {{ (!isset($language->fallback_locale) || 1 == @$language->fallback_locale) ? 'checked' : '' }}><i
                                                        data-swchon-text="ON" data-swchoff-text="OFF"></i>Fallback
                                                locale
                                            </label>

                                            <div class="note">
                                                You can change language fallback locale, by switching ON/OFF (not recommended)
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

        @if(isset($translation['default']))
            @foreach($translation['default'] as $name => $lang)
              @if($name != "page")
                <section>
                    <!-- row -->
                    <div class="row">

                        <!-- NEW COL START -->
                        <article class="col-sm-12">

                            <!-- Widget ID (each widget will need unique ID)-->
                            <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-0-{{ $name }}"
                                 data-widget-editbutton="false" data-widget-custombutton="false">
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

                                    <h2>{{ $name }} </h2>

                                </header>

                                <!-- widget div-->
                                <div>

                                    <!-- widget edit box -->
                                    <div class="jarviswidget-editbox">
                                        <!-- This area used as dropdown edit box -->

                                    </div>
                                    <!-- end widget edit box -->

                                    <!-- widget content -->
                                    <div class="widget-body">
                                        <div class="widget-body-toolbar">


                                        </div>
                                        <form >
                                            <table class="table table-bordered table-striped" style="clear: both">
                                                <tbody>
                                                @foreach($lang as $key => $val)
                                                    @if( !is_array($val) )
                                                        <tr>
                                                            <td style="width:35%;">{{ $val }}</td>
                                                            <td style="width:65%">
                                                                <a href="#"
                                                                   style="{{ (!isset($translation['current'][$name][$key]))?'font-style: italic; color: #D14;':'' }}"
                                                                   class="translate" id="{{ $name . $key }}"
                                                                   data-name="{{ $name . $key }}"
                                                                   data-lang="{{ $name }}" data-lang-key="{{ $key }}"
                                                                   data-type="text" data-pk="1"
                                                                   data-original-title="Enter {{ $key }}">{{ isset($translation['current'][$name][$key])?$translation['current'][$name][$key]: $val }}</a>
                                                            </td>
                                                        </tr>
                                                    @elseif( $key == 'custom')
                                                        @foreach($val as $attrName => $attribute)
                                                            @foreach($attribute as $rule => $msg)
                                                                <tr>
                                                                    <td style="width:35%;">{{ $msg }}</td>
                                                                    <td style="width:65%">
                                                                        <a href="#"
                                                                           style="{{ (!isset($translation['current'][$name][$key][$attrName][$rule]))?'font-style: italic; color: #D14;':'' }}"
                                                                           class="translate"
                                                                           id="{{ $attrName . $rule }}"
                                                                           data-name="{{ $attrName . $rule }}"
                                                                           data-lang="{{ $key }}"
                                                                           data-lang-key="{{ $attrName }}"
                                                                           data-rule="{{ $rule }}" data-type="text"
                                                                           data-pk="1"
                                                                           data-original-title="Enter {{ $attrName . ' =>' . $rule }}">{{  isset($translation['current'][$name][$key][$attrName][$rule])?$translation['current'][$name][$key][$attrName][$rule]:$msg }}</a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                                </tbody>
                                            </table>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <button class="btn btn-default" type="submit">
                                                            Cancel
                                                        </button>
                                                        <button class="btn btn-primary lang-submit" type="submit"
                                                                data-lang="{{ $name }}">
                                                            <i class="fa fa-save"></i>
                                                            Submit
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
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
               @else
               <section>
                   <!-- row -->
                   <div class="row">

                       <!-- NEW COL START -->
                       <article class="col-sm-12">

                           <!-- Widget ID (each widget will need unique ID)-->
                           <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-0-{{ $name }}"
                                data-widget-editbutton="false" data-widget-custombutton="false">
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

                                   <h2>{{ $name }} </h2>

                               </header>

                               <!-- widget div-->
                               <div>

                                   <!-- widget edit box -->
                                   <div class="jarviswidget-editbox">
                                       <!-- This area used as dropdown edit box -->

                                   </div>
                                   <!-- end widget edit box -->

                                   <!-- widget content -->
                                   <div class="widget-body">
                                       <div class="widget-body-toolbar">

                                       <form >
                                           <table class="table table-bordered table-striped" style="clear: both">
                                               <tbody>
                                               @foreach($lang as $key => $val)
                                                   @if( !is_array($val) )
                                                       <tr>
                                                           <td style="width:49%;">
                                                              {{ Form::textarea("html_en_$key", $val, $attributes = array('class'=>'form-control ckeditorHtmldi','id'=>"en_".$key,'disabled'=>"disabled"))}}
                                                           </td>
                                                           <td style="width:49%">
                                                                {{ Form::textarea("html_$key",  isset($translation['current'][$name][$key])?$translation['current'][$name][$key]: $val, $attributes = array('class'=>'form-control ckeditorHtml',"data-lang"=>"page","data-lang-key"=>$key,'id'=>$key))}}
                                                           </td>
                                                       </tr>
                                                   @endif
                                               @endforeach
                                               </tbody>
                                           </table>
                                           <div class="form-actions">
                                               <div class="row">
                                                   <div class="col-md-12">
                                                       <button class="btn btn-default" type="submit">
                                                           Cancel
                                                       </button>
                                                       <button class="btn btn-primary lang-submit" type="submit"
                                                               data-lang="{{ $name }}">
                                                           <i class="fa fa-save"></i>
                                                           Submit
                                                       </button>
                                                   </div>
                                               </div>
                                           </div>
                                      </form>         
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
               @endif
            @endforeach
        @elseif(isset($translation['auth']))
              @foreach($translation as $name => $lang)
              @if($name != "page")
                <section>
                    <!-- row -->
                    <div class="row">

                        <!-- NEW COL START -->
                        <article class="col-sm-12">

                            <!-- Widget ID (each widget will need unique ID)-->
                            <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-0-{{ $name }}"
                                 data-widget-editbutton="false" data-widget-custombutton="false">
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

                                    <h2>{{ $name }} </h2>

                                </header>

                                <!-- widget div-->
                                <div>

                                    <!-- widget edit box -->
                                    <div class="jarviswidget-editbox">
                                        <!-- This area used as dropdown edit box -->

                                    </div>
                                    <!-- end widget edit box -->

                                    <!-- widget content -->
                                    <div class="widget-body">
                                        <div class="widget-body-toolbar">


                                        </div>
                                        <form class="">

                                            <table class="table table-bordered table-striped" style="clear: both">
                                                <tbody>
                                                @foreach($lang as $key => $val)
                                                    @if( !is_array($val) )
                                                        <tr>
                                                            <td style="width:35%;">{{ $key }}</td>
                                                            <td style="width:65%">
                                                                <a href="#" class="translate" id="{{ $name . $key }}"
                                                                   data-name="{{ $name . $key }}"
                                                                   data-lang="{{ $name }}" data-lang-key="{{ $key }}"
                                                                   data-type="text" data-pk="1"
                                                                   data-original-title="Enter {{ $key }}">{{ $val }}</a>
                                                            </td>
                                                        </tr>
                                                    @elseif( $key == 'custom')
                                                        @foreach($val as $attrName => $attribute)
                                                            @foreach($attribute as $rule => $msg)
                                                                <tr>
                                                                    <td style="width:35%;">{{ $attrName . '.' . $rule }}</td>
                                                                    <td style="width:65%">
                                                                        <a href="#" class="translate"
                                                                           id="{{ $attrName . $rule }}"
                                                                           data-name="{{ $attrName . $rule }}"
                                                                           data-lang="{{ $key }}"
                                                                           data-lang-key="{{ $attrName }}"
                                                                           data-rule="{{ $rule }}" data-type="text"
                                                                           data-pk="1"
                                                                           data-original-title="Enter {{ $attrName . ' =>' . $rule }}">{{ $msg }}</a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                                </tbody>
                                            </table>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <button class="btn btn-default" type="submit">
                                                            Cancel
                                                        </button>
                                                        <button class="btn btn-primary lang-submit" type="submit"
                                                                data-lang="{{ $name }}">
                                                            <i class="fa fa-save"></i>
                                                            Submit
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
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
             @endif
              @endforeach
        @endif
    </div>

    <!-- end widget grid -->
    @stop
    @section('scripts')
            <!-- PAGE RELATED PLUGIN(S) -->
    <script src="{{asset('assets/back/js/plugin/jquery-form/jquery-form.min.js')}}"></script>
    <script src="{{asset('assets/back/css/bootsrtap-form-helpers/dist/js/bootstrap-formhelpers.min.js')}}"></script>
    <script src="{{asset('assets/back/js/plugin/bootstrap-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
    <script src="{{asset('assets/back/js/plugin/x-editable/moment.min.js') }}"></script>
    <script src="{{asset('assets/back/js/plugin/x-editable/jquery.mockjax.min.js') }}"></script>
    <script src="{{asset('assets/back/js/plugin/x-editable/x-editable.min.js') }}"></script>
    <script src="{{asset('assets/back/js/plugin/typeahead/typeahead.min.js') }}"></script>
    <script src="{{asset('assets/back/js/plugin/typeahead/typeaheadjs.min.js') }}"></script>
    <script src="{{asset('assets/back/css/toastr/toastr.min.js')}}"></script>
    <script src="{{asset('assets/back/js/plugin/ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript">
        var lang = {
            auth: {},
            interface: {},
            validation: {},
            pagination: {},
            password: {},
            page: {},
        };
        function pushTranslation(obj) {
            id = '#' + obj.name;
            console.log("2123");
            console.log(obj);
            var $input = $(id);
            $input.removeAttr('style');
            var title = $input.data('lang');
            var key = $input.data('lang-key');
            var value = obj.value;
            if (title == 'custom') {
                if (typeof lang.validation.custom == 'undefined') {
                    lang.validation.custom = {};
                    lang.validation.custom[key] = {};
                }
                lang.validation.custom[key][$input.data('rule')] = value;
            } else {
                lang[title][key] = value;
            }
        }
        // DO NOT REMOVE : GLOBAL FUNCTIONS!

        $(document).ready(function () {
            pageSetUp();

            // var translated = CKEDITOR.replace( '.ckeditor',  );
           var textarea   = []
           var idTextarea = []
            i = 0;
            $('.ckeditorHtml').each( function () {
              textarea[i]   = CKEDITOR.replace( this.id ,{ height: '300px', startupFocus : true});
              idTextarea[i] = this.id;
              i++;
            });            

            $('.ckeditorHtmldi').each( function () {
              CKEDITOR.replace( this.id ,{ height: '300px', designMode : 'off'});
            });
            /*
             * X-Ediable
             */


            (function (e) {
                "use strict";
                var t = function (e) {
                    this.init("address", e, t.defaults)
                };
                e.fn.editableutils.inherit(t, e.fn.editabletypes.abstractinput);
                e.extend(t.prototype, {
                    render: function () {
                        this.$input = this.$tpl.find("input")
                    },
                    value2html: function (t, n) {
                        if (!t) {
                            e(n).empty();
                            return
                        }
                        var r = e("<div>").text(t.city).html() + ", " + e("<div>").text(t.street).html() +
                                " st., bld. " + e("<div>").text(t.building).html();
                        e(n).html(r)
                    },
                    html2value: function (e) {
                        return null
                    },
                    value2str: function (e) {
                        var t = "";
                        if (e)
                            for (var n in e)
                                t = t + n + ":" + e[n] + ";";
                        return t
                    },
                    str2value: function (e) {
                        return e
                    },
                    value2input: function (e) {
                        if (!e)
                            return;
                        this.$input.filter('[name="city"]').val(e.city);
                        this.$input.filter('[name="street"]').val(e.street);
                        this.$input.filter('[name="building"]').val(e.building)
                    },
                    input2value: function () {
                        return {
                            city: this.$input.filter('[name="city"]').val(),
                            street: this.$input.filter('[name="street"]').val(),
                            building: this.$input.filter('[name="building"]').val()
                        }
                    },
                    activate: function () {
                        this.$input.filter('[name="city"]').focus()
                    },
                    autosubmit: function () {
                        this.$input.keydown(function (t) {
                            t.which === 13 && e(this).closest("form").submit()
                        })
                    }
                });
                t.defaults = e.extend({}, e.fn.editabletypes.abstractinput.defaults, {
                    tpl: '<div class="editable-address"><label><span>City: </span><input type="text" name="city" class="input-small"></label></div><div class="editable-address"><label><span>Street: </span><input type="text" name="street" class="input-small"></label></div><div class="editable-address"><label><span>Building: </span><input type="text" name="building" class="input-mini"></label></div>',
                    inputclass: ""
                });
                e.fn.editabletypes.address = t
            })(window.jQuery);

            //ajax mocks
            $.mockjaxSettings.responseTime = 500;

            $.mockjax({
                url: '/post',
                response: function (settings) {
                    log(settings, this);

                    // push translated columns into array
                    console.log("123");
                    console.log(settings.data);
                    pushTranslation(settings.data);
                }
            });

            $.mockjax({
                url: '/error',
                status: 400,
                statusText: 'Bad Request',
                response: function (settings) {
                    this.responseText = 'Please input correct value';
                    log(settings, this);
                }
            });

            $.mockjax({
                url: '/status',
                status: 500,
                response: function (settings) {
                    this.responseText = 'Internal Server Error';
                    log(settings, this);
                }
            });

            //TODO: add this div to page
            function log(settings, response) {
                var s = [],
                        str;
                s.push(settings.type.toUpperCase() + ' url = "' + settings.url + '"');
                for (var a in settings.data) {
                    if (settings.data[a] && typeof settings.data[a] === 'object') {
                        str = [];
                        for (var j in settings.data[a]) {
                            str.push(j + ': "' + settings.data[a][j] + '"');
                        }
                        str = '{ ' + str.join(', ') + ' }';
                    } else {
                        str = '"' + settings.data[a] + '"';
                    }
                    s.push(a + ' = ' + str);
                }
                s.push('RESPONSE: status = ' + response.status);

                if (response.responseText) {
                    if ($.isArray(response.responseText)) {
                        s.push('[');
                        $.each(response.responseText, function (i, v) {
                            s.push('{value: ' + v.value + ', text: "' + v.text + '"}');
                        });
                        s.push(']');
                    } else {
                        s.push($.trim(response.responseText));
                    }
                }
                s.push('--------------------------------------\n');
                $('#console').val(s.join('\n') + $('#console').val());
            }

            /*
             * X-EDITABLES
             */


            if (window.location.href.indexOf("?mode=inline") > -1) {
                $('#inline').prop('checked', true);
                $.fn.editable.defaults.mode = 'inline';
            } else {
                $('#inline').prop('checked', false);
                $.fn.editable.defaults.mode = 'popup';
            }

            //defaults
            $.fn.editable.defaults.url = '/post';
            //$.fn.editable.defaults.mode = 'inline'; use this to edit inline

            //editables
            $('.translate').editable({
                //   url: '/asd',
                type: 'text',
                pk: 1,
                //  name: $input.data('name'),
                //  title: $input.data('original-title'),
            });

 

            $('.lang-submit').click(function (e) {
                e.preventDefault();
                var $id = $('input[name=id]');
                var code = $id.data('code');
                var id = $id.val();
                var $button = $(this);
                var chapter = $button.data('lang');

                if(chapter == 'page'){
                    var obj =  []
                     i = 0;
                     $('.ckeditorHtml').each( function () {
                         text   =  textarea[i].getData();
                         id_text    = idTextarea[i]
                         $input = $('#'+id_text).parent().children("textarea");
                         title  = $input.data('lang');
                         key    = $input.data('lang-key');
                         // obj[i] =  {text: text, id: id, title: title,key:key}
                       i++; 
                       lang[chapter][key] = text;
                     });
                }
                $.ajax({
                    url: '{{ url("/admin/language/edit") }}',
                    type: 'Post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        language: lang[chapter],
                        code: code,
                        id: id,
                        chapter: chapter,
                    },
                    beforeSend: function () {
                        $button.html('<i class="fa fa-spinner fa-spin"></i> Saving...');
                    },
                    success: function (data) {
                        if (data == 0) {
                            toastr.error('Noting saved!');
                        } else {
                            toastr.success('Saved successfully!');
                            lang[chapter] = {};
                        }
                        $button.html('<i class="fa fa-save"></i> Submit');
                    }
                });
            });

        });
    </script>
@stop