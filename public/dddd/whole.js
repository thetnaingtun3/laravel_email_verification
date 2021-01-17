
(function ($) {
    'use strict';
    $(function () {
        if ($('#editable-form').length) {
            $.fn.editable.defaults.mode = 'inline';
            $.fn.editableform.buttons =
                '<button type="submit" class="btn btn-primary btn-sm editable-submit">' +
                '<i class="fa fa-fw fa-check"></i>' +
                '</button>' +
                '<button type="button" class="btn btn-default btn-sm editable-cancel">' +
                '<i class="fa fa-fw fa-times"></i>' +
                '</button>';

            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#payment_status').editable({
                url: '/backend/update-order',
                type: 'select',
                pk: 1,
                name: 'status',
                source: [
                    {value: 'pending', text: 'pending'},
                    {value: 'approved', text: 'approved'},
                    {value: 'rejected', text: 'rejected'}
                ]
            });
        }
    });
})(jQuery);
