define([
    'jquery',
    'Magento_Ui/js/modal/alert',
    'mage/translate'
], function ($, alert) {
    'use strict';

    $.widget('australiapost.apiTest', {
        options: {
            buttonId: '',
            buttonLabel: '',
            successMessage: '',
            failMessage: ''
        },
        _create: function () {
            this._on({
                'click': $.proxy(this._testApi, this)
            });
        },
        _testApi: function () {
            var apiKey = $('#australiapost_returns_api_key').val();
            var apiSecret = $('#australiapost_returns_api_secret').val();
            var basicString = btoa(apiKey + ':' + apiSecret);

            $('span', this.element).html($.mage.__('Testing Connection...'));

            var apiMode = $('#australiapost_returns_api_mode').val();
            var apiUrlSelector = apiMode == 'live' ? '#australiapost_returns_api_live_url' : '#australiapost_returns_api_test_url';
            var apiUrl = $(apiUrlSelector).val();

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        try {
                            var response = JSON.parse(xhr.responseText);
                            if (response.access_token) {
                                alert({content: this.options.successMessage});
                            } else {
                                alert({content: this.options.failMessage});
                            }
                        } catch(err) {
                            alert({content: this.options.failMessage});
                        }
                    } else {
                        alert({content: this.options.failMessage});
                    }
                    $('span', this.element).html($.mage.__(this.options.buttonLabel));
                }
            }.bind(this);

            xhr.open('POST', apiUrl + '/v1/oauth/token?api_key=' + apiKey, true);
            xhr.setRequestHeader('Authorization', 'Basic ' + basicString);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('grant_type=client_credentials');
        }
    });

    return $.australiapost.apiTest;
});
