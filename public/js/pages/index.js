var IndexPage = function () {
    var ins = {};

    var datePickerConfig = {
        format: "dd/mm/yyyy"
    };

    ins.init = function () {
        $(".dateFrom").datepicker(datePickerConfig);
        $(".dateTo").datepicker(datePickerConfig);
    };

    return ins;
}();

$(document).ready(IndexPage.init);