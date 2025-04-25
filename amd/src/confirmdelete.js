define([
    'jquery',
    'core/ajax',
    'core/str',
    'core/modal_factory',
    'core/modal_events',
    'core/notification'
], function($,
             Ajax,
             str,
             ModalFactory,
             ModalEvents,
             Notification) {

    $('.delete-btn').on('click', function() {
        let elementId = $(this).attr('id');
        let arr = elementId.split("-");
        let recordId = arr[arr.length - 1];
        // eslint-disable-next-line promise/catch-or-return
        ModalFactory.create({
            type: ModalFactory.types.SAVE_CANCEL,
            title: str.get_string('deletetitle', 'local_gradereport', '', ''),
            body: str.get_string('modalmessage', 'local_gradereport', '', '')
            // eslint-disable-next-line promise/always-return
        }).then(function(modal) {
            modal.setSaveButtonText(str.get_string('delete', 'local_gradereport', '', ''));
            let root = modal.getRoot();
            root.on(ModalEvents.save, function() {
                let wsfunction = 'local_gradereport_delete_record_by_id';
                let params = {
                    'recordid': recordId,
                };
                let request = {
                    methodname: wsfunction,
                    args: params
                };
                Ajax.call([request])[0].done(function() {
                    window.location.href = $(location).attr('href');
                }).fail(Notification.exception);
            });
            modal.show();
        });
    });
});