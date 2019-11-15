define([
        'jquery',
        'Magento_Ui/js/modal/modal'
    ],
    function(
        $,
        modal
    ) {
        return function (config, elem) {
            var options = {
                type: 'popup',
                responsive: true,
                innerScroll: true,
                modalClass: 'events-modal',
                buttons: [{
                    text: $.mage.__('Continue'),
                    class: 'hidden',
                    click: function () {
                        this.closeModal();
                    }
                }]
            };

            var popup = modal(options, $('.events-popup')),
                eventBlock = null,
                eventID = null,
                eventName = '';

            $('.js-modal-toggle').on('click', function (e) {
                e.preventDefault();
                eventBlock = this.closest('.event');
                eventID = $(eventBlock).data('id');
                eventName = $(eventBlock).find('.event-title').text();

                $('.events-popup input[name=vaimo_events_event_id]').attr('value', eventID).change();
                $('.events-popup input[name=event_name]').attr('value', eventName);
                $('.events-popup').modal('openModal');
            });
        }
    }
);