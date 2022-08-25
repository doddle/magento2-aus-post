define([
    'jquery',
    'mage/translate'
], function ($) {
    'use strict';

    $.widget('australiapost.orderBackfill', {
        options: {
            buttonId: '',
            buttonLabel: '',
            successMessage: '',
            failMessage: ''
        },
        _create: function () {
            this._checkCanDisplay();
            this._on($('button', this.element), {
                'click': $.proxy(this._backfillOrders, this)
            });
        },
        _backfillOrders: function () {
            var url = this.options.backfillUrl + '?limit=' + parseInt($('.backfill-days-limit').val());
            window.location.assign(url);
        },
        _checkCanDisplay: function () {
            var apiKey = $('#australiapost_returns_api_key').val();
            var apiSecret = $('#australiapost_returns_api_secret').val();
            var basicString = btoa(apiKey + ':' + apiSecret);
            var apiMode = $('#australiapost_returns_api_mode').val();
            var apiUrlSelector = apiMode == 'live' ? '#australiapost_returns_api_live_url' : '#australiapost_returns_api_test_url';
            var apiUrl = $(apiUrlSelector).val();

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.access_token) {
                            $('button', this.element).attr('disabled', false);
                            $('.note', this.element).html(
                                $.mage.__('Clicking this button will queue all existing unsynched orders to be synched with Australia Post (limited to a set number of days back from today if supplied).')
                            );
                        }
                    }
                }
            }.bind(this);

            xhr.open('POST', apiUrl + '/v1/oauth/token?api_key=' + apiKey, true);
            xhr.setRequestHeader('Authorization', 'Basic ' + basicString);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('grant_type=client_credentials');
        }
    });

    return $.australiapost.orderBackfill;
});
