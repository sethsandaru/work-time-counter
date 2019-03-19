window.AjaxService = function(){
    function baseAjax(type, url, data, customOptions) {
        var url_request = url;

        //if (url.indexOf(base_url) === 0) {
        //    url_request = url;
        //} else {
        //    url_request = base_url + url;
        //}

        var ajaxOption = {};

        if(_.isObject(customOptions)) {
            for(var option in customOptions) {
                ajaxOption[option] = customOptions[option];
            }
        }

        ajaxOption.type = type;
        ajaxOption.data = data;
        ajaxOption.url = url_request;

        // console.log(ajaxOption)
        var request = $.ajax(ajaxOption);
        return request;
    }

    var instance = {};
    var postAjax = instance.post = function postAjax(apiUrl, data, customOptions) {
        return baseAjax('POST', apiUrl, data, customOptions);
    };

    instance.get = function getAjax(apiUrl, data, customOptions) {
        return baseAjax('GET', apiUrl, data, customOptions);
    };

    instance.put = function(apiUrl, data, customOptions) {
        return baseAjax('PUT', apiUrl, data, customOptions);
    }

    instance.delete = function(apiUrl, data, customOptions) {
        return baseAjax('DELETE', apiUrl, data, customOptions);
    }

    instance.bindAjaxLoading = function() {
        var isHasAjax = false;
        $(document).bind("ajaxSend", function() {
            $('div.shop-system-loading').show();
            isHasAjax = true;
        }).bind("ajaxStop", function() {
            $('div.shop-system-loading').hide();
        }).bind("ajaxError", function() {
            $('div.shop-system-loading').hide();
        });
        setTimeout(function() {
            if (!isHasAjax) {
                $('div.shop-system-loading').hide();
            }
        }, 300);
        setTimeout(function() {
            if (isHasAjax) {
                console.log('OUT OF TIME AJAX')
                $('div.shop-system-loading').hide();
            }
        }, 10000);
    };

    return instance;
}();

$.fn.serializeObject = function() {
    var arrayData, objectData;
    arrayData = this.serializeArray();
    objectData = {};

    $.each(arrayData, function() {
        var value;

        if (this.value != null) {
            value = this.value;
        } else {
            value = '';
        }

        if (objectData[this.name] != null) {
            if (!objectData[this.name].push) {
                objectData[this.name] = [objectData[this.name]];
            }

            objectData[this.name].push(value);
        } else {
            objectData[this.name] = value;
        }
    });

    return objectData;
};