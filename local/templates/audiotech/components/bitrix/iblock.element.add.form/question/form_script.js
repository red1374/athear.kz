'use strict';
var SForm    = SForm || {};

SForm = {
    vars : {
        _show   : null,
        send    : true,
        maxFileSize : 10
    },

    onAjaxSuccess : function() {
        BX.addCustomEvent("onAjaxSuccess", SC.setErrorsEvent);
        //BX.addCustomEvent("onAjaxSuccess", SC.set_close_event);

        BX.addCustomEvent('onAjaxSuccess', function(){
            $("div[id^='wait_comp_']").remove();
            // Form.initPlugins();
        });
    },


    initPlugins : function(){
        if ($('.form-phone').length)
            SC.setPhoneInputMask($('.form-phone'));
    },

    init: function () {
        var b = this;

        $(function () {
            b.onAjaxSuccess();
            $("div[id^='wait_comp_']").remove();
            SC.setErrorsEvent();
            //SC.set_close_event();
            //Form.initPlugins();
        });

        return b;
    }
};
SForm = SForm.init();