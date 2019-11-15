define([
    'jquery',
    'uiRegistry',
    'Magento_Ui/js/form/components/button'
    ], function ($, uiRegistry, button) {
    'use strict';

    var mydata = uiRegistry.get("events_grid_edit.events_grid_edit");
    var mydataSource = uiRegistry.get("events_grid_edit.events_grid_edit_data_source");
    return button.extend({
         action: function () {
             mydata.validate();

             if (!mydata.additionalInvalid && !mydata.source.get('params.invalid')) {
                 $('.events-popup').trigger('processStart');
                 $.ajax({
                        url: 'frontend/events/frontsave',
                        data: mydataSource.data,
                        dataType: 'json',

                        success: function (newData) {
                            $('.events-popup').trigger('processStop');
                            $('.events-popup .success, .events-popup .error').remove();
                            $('.events-popup').append('<span class="success">'+ newData.messages +'</span>')
                            setTimeout(function () {
                                $('.events-popup .success, .events-popup .error').remove();
                                $('.events-popup').modal('closeModal');
                                $('.events-popup input').attr('value', '');
                            }, 2300);
                        },
                        error: function(newData) {
                            $('.events-popup').trigger('processStop');
                            $('.events-popup .success, .events-popup .error').remove();
                            $('.events-popup').append('<span class="error">'+ newData.error +'</span>')
                        }
                    });

             } else {
                 mydata.focusInvalid();
             }


         }
    });
});