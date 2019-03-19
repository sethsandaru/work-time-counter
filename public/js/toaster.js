var SethPhatToaster = function () {
    var instance = {};

    var defaultVal = {
        ttl: 3000,
    };

    function buildOption(msg, type, afterClose, customOpts) {
        var option = {
            text: msg,
            type: type,
            timeout: defaultVal.ttl,
            progressBar: true,
        }
        if (_.isFunction(afterClose)) {
            option.callback = {
                afterClose: afterClose
            }
        }
        if (_.isObject(customOpts)) {
            for (var key in customOpts) {
                option[key] = customOpts[key];
            }
        }
        return option;
    };

    instance.hideModal = function () {
        $('#myModal').modal('hide');
    };
    instance.showModal = function () {
        $('#myModal').modal('show');
    };
    instance.isModal = function () {
        return $('#myModal').is(':visible');
    };

    var buildConfirmOption = function (msg, onYes, onNo, hasCancel, onCancel) {
        var option = {
            text: msg,
            type: 'information',
            closeWith: 'button',
            buttons: [
                {
                    addClass: 'btn btn-primary', text: "Có", onClick: function ($noty) {
                        if (_.isFunction(onYes)) {
                            onYes($noty)
                        }
                        // $('#myModal').modal('hide');
                        $noty.close();
                    },
                },
                {
                    addClass: 'btn btn-danger', text: "Không", onClick: function ($noty) {
                        if (_.isFunction(onNo)) {
                            onNo($noty)
                        }
                        if (!hasCancel) {
                            $('#myModal').modal('hide');
                        }
                        $noty.close();
                    },
                }
            ]
        };

        if (hasCancel) {
            option.buttons.push({
                addClass: 'btn btn-default', text: "Hủy bỏ", onClick: function ($noty) {
                    if (_.isFunction(onCancel)) {
                        onCancel($noty)
                    }
                    $('#myModal').modal('hide');
                    $noty.close();
                }
            })
        }
        return option;
    };

    instance.confirmWithCancel = function (msg, onYes, onNo, onCancel) {
        $('#myModal').modal('show');
        if (!msg) {
            msg = "Do you want to process this action?";
        }
        var option = buildConfirmOption(msg, onYes, onNo, true, onCancel);
        noty(option);
    };

    instance.confirm = function (msg, onOk, onNo) {
        if (!msg) {
            msg = "Do you want to process this action?";
        }

        $('#myModal').modal('show');
        var option = buildConfirmOption(msg, onOk, onNo, false);
        noty(option);
    };

    instance.serverNoty = function (response, afterClose, customOpts) {
        if (_.isObject(response) && _.has(response, 'noty')) {
            var message = response['noty']['title'] + ": " + response['noty']['message'];
            if (_.accessStr(response, 'noty.append_msg')) {
                message += ' ' + _.accessStr(response, 'noty.append_msg');
            }
            MPireToaster.show(message, response['noty']['priority'], afterClose, customOpts);
        }
    };

    instance.show = function (msg, type, afterClose, customOpts) {
        var option = buildOption(msg, type, afterClose, customOpts);
        noty(option);
    };

    instance.success = function (msg, afterClose, customOpts) {
        if (_.isEmpty(msg)) {
            msg = "Action processed successfully!";
        }

        instance.show(msg, 'success', afterClose, customOpts);
    };

    instance.info = function (msg, afterClose, customOpts) {
        instance.show(msg, 'information', afterClose, customOpts);
    };
    instance.warning = function (msg, afterClose, customOpts) {
        instance.show(msg, 'warning', afterClose, customOpts);
    };

    instance.error = function (msg, afterClose, customOpts) {
        if (!_.isFunction(afterClose)) {
            afterClose = function () {
                MPireToaster.hideModal();
            };
        }

        if (_.isEmpty(msg)) {
            msg = "Action failed. Please try again.";
        }

        instance.show(msg, 'error', afterClose, customOpts);
    };

    instance.server_error = function (afterClose, customOpts) {
        instance.error("Server error, please try again later or contact to our administrators.", afterClose, customOpts);
    };

    instance.action_success = function (afterClose, customOpts) {
        instance.success('', afterClose, customOpts);
    };


    return instance;
}();