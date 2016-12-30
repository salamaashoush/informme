    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/froala_editor.min.js')}}"></script>

    <!-- Include Code Mirror. -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/mode/xml/xml.min.js"></script>

    <!-- Include Plugins. -->
    <script type="text/javascript" src="{{asset('js/plugins/align.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/char_counter.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/code_beautifier.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/code_view.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/colors.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/emoticons.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/entities.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/file.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/font_family.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/font_size.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/fullscreen.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/image.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/image_manager.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/inline_style.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/line_breaker.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/link.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/lists.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/paragraph_format.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/paragraph_style.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/quick_insert.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/quote.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/table.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/save.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/url.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/video.min.js')}}"></script>
    <script>
        $(function () {
            $('textarea#articlebody').froalaEditor({
                // Set the image upload parameter.
                imageUploadParam: 'image',

                // Set the image upload URL.
                imageUploadURL: 'http://inform-me.app/ajax_upload',

                // Additional upload params.
                imageUploadParams: {id: 'my_editor'},

                // Set request type.
                imageUploadMethod: 'POST',

                // Set max image size to 5MB.
                imageMaxSize: 5 * 1024 * 1024,

                // Allow to upload PNG and JPG.
                imageAllowedTypes: ['jpeg', 'jpg', 'png'],

                // Set page size.
                imageManagerPageSize: 20,

                // Set a scroll offset (value in pixels).
                imageManagerScrollOffset: 10,

                // Set the load images request URL.
                imageManagerLoadURL: "http://inform-me.app/ajax_index",

                // Set the load images request type.
                imageManagerLoadMethod: "GET",


                // Set the delete image request URL.
                imageManagerDeleteURL: "http://inform-me.app/ajax_delete",

                // Set the delete image request type.
                imageManagerDeleteMethod: "POST",

            })
            $("#indextable").DataTable();
        });
    </script>