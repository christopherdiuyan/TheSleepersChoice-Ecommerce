(function ($) {
    "use strict";

    $(function () {
        /* ------------------------------------------------------------------------- *
         * SUMMERNOTE
         * ------------------------------------------------------------------------- */
        var $summerNote = $('[data-trigger="summernote"]');

        if ( $summerNote.length ) {
            $summerNote.summernote({
                height: 200,
                toolbar: [
                [ 'style', [ 'style' ] ],
                [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
                [ 'fontname', [ 'fontname' ] ],
                [ 'fontsize', [ 'fontsize' ] ],
                [ 'color', [ 'color' ] ],
                [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
                [ 'insert', [ 'link'] ],
                [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
            ]
            });
        }
    });
}(jQuery));