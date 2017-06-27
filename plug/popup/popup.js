/**
 * Created by fu.
 * Date: 2015/4/21
 * Time: 20:37
 */
/**
 *
 * @return
 *
 * {
 *      setTitle(title),
 *      close(),
 *      setContent(data),
 *      $open_widget,
 *      showLoad(),
 *      hideLoad(),
 *      disabledCo
 *
 *      nfirm(),
 *      undisabledConfirm(),
 *
 * }
 */
;(function(){
    var $win = $(window);
    var $doc = $(document);
    var defaultOptions = {
        hideConfirm: false,
        width: 600,
        height: 400,
        confirm: function () {
        },
        title: '提示',
        url: '',
        content: '',
        btnString:'',
        closestats:'close', //close
        closefn:function(){},
        success: function () {
        }
    };
    /**
     this.setTitle()
     this.setContent()
     this.hide()
     this.show()
     this.close()
     this.$open_widget
     this.$ow_open_tit
     this.$ow_open_cont
     this.$ow_open_box
     this.$ow_open_close
     this.$lw_opening
     *
     * @param o
     * @constructor
     */
    window.C = function(o)
    {
        var id = '#c'+new Date().getTime();
        C.zIndex += 50;
        this.options = $.extend({},defaultOptions,o);
        this.options['id'] = id;
        this.options['zIndex'] = C.zIndex;
        this.init();
    };
    C.zIndex = 1000;
    C.prototype.init = function(){
        $('body').css({overflow:'hidden'});
        var m  = {};
        var _this = this;
        m.init = function(){
            this.initstring();
            this.bindEvent();
            this.initPosition();
            _this.setTitle(_this.options.title);
            this.initContent();
        };
        var $open_widget;
        m.initstring = function()
        {
            var max_height = $win.height() - 140;
            $open_widget = $('<div class="open_widget" id="'+_this.options.id+'">' +
                                    '<div class="ow_open_box" style="display: none;">' +
                                        '<div class="ow_open_close close" style="position: absolute;right: 10px;top: 10px;">×</div>' +
                                        '<div class="ow_open_tit" style="height: 50px;line-height: 50px;padding-left: 10px;font-size: 18px;font-weight: bold;border-bottom: 1px solid #eee;"></div>' +
                                        '<div class="ow_open_cont" style="max-height: '+max_height+'px;min-height:70px;overflow: auto;"></div>' +
                                        '<div class="ow_open_btn_w clearfix" style="text-align: right;background: #efefef">' +
                                         m.getBtnString() +
                                        '</div>' +
                                    '</div>' +
                                    '<div class="lw_opening"></div><div class="lw_has_shade"></div>' +
                                 '</div>');
            $('body').append($open_widget);
            _this.$open_widget = $open_widget;
            _this.$ow_open_tit = $open_widget.find('.ow_open_tit');
            _this.$ow_open_cont = $open_widget.find('.ow_open_cont');
            _this.$ow_open_box = $open_widget.find('.ow_open_box');
            _this.$ow_open_close = $open_widget.find('.ow_open_close');
            _this.$lw_opening = $open_widget.find('.lw_opening');

        };
        m.getBtnString = function(){
            return _this.options.btnString;
        };
        m.bindEvent = function(){
            _this.$ow_open_close.click(function(){
                if(_this.options.closestats == 'hide'){
                    _this.hide();
                }else{
                    _this.close();
                    _this.options.closefn();
                }
            });
        };
        m.initPosition = function(){
            var doc_width = $doc.width();
            var doc_height = $doc.height();
            var winhalf = ($win.height()) / 2;
            var pl, pt;
            pl = ($win.width() - 300) / 2;
            pt = $doc.scrollTop() - 40 / 2 + winhalf;
            //外框
            $open_widget.css({
                width: doc_width,
                height: doc_height,
                zIndex: _this.options.zIndex,
                position: 'absolute',
                left: 0,
                top: 0
            }).show();

            //背景阴影
            $open_widget.find('.lw_has_shade').css({
                width: doc_width,
                height: doc_height,
                zIndex: _this.options.zIndex + 1,
                background: '#000',
                position: 'absolute',
                left: 0,
                top: 0,
                opacity: 0.3
            });

            //loading。。
            var $lw_opening = $open_widget.find('.lw_opening');
            $lw_opening.css({
               left: pl,
               top: pt,
               position: 'absolute',
               zIndex: _this.options.zIndex + 2
            });


            //弹窗

            pl = ($win.width() - _this.options.width) / 2;
            var $ow_open_box = $open_widget.find('.ow_open_box').css({
                position: 'absolute',
                left: pl,
                zIndex: _this.options.zIndex + 3,
                width: _this.options.width,
                background: '#fff',
                opacity: 0
            });


        };
        m.initContent = function(){
            if(!_this.options.url){
                _this.$lw_opening.hide();
                _this.setContent(_this.options.content);
                m.anim();
            }else{
                $.ajax({
                    url: _this.options.url,
                    type: 'get',
                    success: function (data) {
                        _this.$lw_opening.hide();
                        _this.setContent(data);
                        m.anim();

                    },
                    error: function () {
                        _this.close();
                        Tip('操作失败!', 'error');
                    }
                });

            }
        };
        m.anim = function(){
            var winhalf = ($win.height()) / 2;
            pt = $doc.scrollTop() - _this.$ow_open_box.height() / 2 + winhalf;
            if(pt < 0){
                pt = 0;
            }
            _this.$ow_open_box.css({top: pt - 90});
            _this.$ow_open_box.show().animate({top: pt, opacity: 1}, 500,  function () {
                if (typeof _this.options.success == 'function') {
                    _this.options.success();
                }
            });
        };
        m.init();
    };
    C.prototype.setTitle = function(title){
        this.$ow_open_tit.html(title);
    };
    C.prototype.setContent = function(content){
        this.$ow_open_cont.html(content);
    };
    C.prototype.close = function(){
        $('body').css({overflow:'auto'});
        this.$open_widget.remove();
    };
    C.prototype.hide = function()
    {
        $('body').css({overflow:'auto'});
        this.$open_widget.hide();
    };
    C.prototype.show = function()
    {
        this.$open_widget.hide();
    };

    function c_confirm(content,fn,cancelfn)
    {
        var c = new C({
            width:300,
            content:'<div style="padding: 10px">'+content+'</div>',
            btnString:'<div style="float: right;">' +
                            '<button class="btn btn-sm cancel" style="float:left;margin: 5px;">取消</button>' +
                            '<button style="margin: 5px;float:left;" class="btn btn-sm btn-primary confirm">确认</button>' +
                        '</div>',
            closefn:cancelfn
        });
        c.$open_widget.find('.cancel').click(function(){
            c.close();
            if(typeof cancelfn == 'function'){
                cancelfn();
            }
        });
        c.$open_widget.find('.confirm').click(function(){
            c.close();
            if(typeof fn == 'function'){
                fn();
            }
        });

    }
    function c_alert(content)
    {
        var c = new C({
            width:300,
            content:'<div style="padding: 10px">'+content+'</div>',
            btnString:'<div style="float: right;">' +
                            '<button style="margin: 5px;float:left;" class="btn btn-sm btn-primary confirm">confirm</button>' +
                        '</div>'
        });
        c.$open_widget.find('.confirm').click(function(){
            c.close();
        });

    }
    function c_editOpen(options)
    {
        var getUrl = window.location.href;
        var dc = $.extend({
                    url:options.url,
                    btnString:'<div style="float: right;">' +
                                    '<span style="float: left;height: 40px; display: none;" class="ow_loading"></span>' +
                                    '<button class="btn btn-sm cancel" style="float:left;margin: 5px;">取消</button>' +
                                    '<button style="margin: 5px;float:left;" class="btn btn-sm btn-primary confirm">确认</button>' +
                                '</div>'
                },options);
        var c = new C(dc);
        var $ow_loading = c.$open_widget.find('.ow_loading');
        c.$open_widget.find('.cancel').click(function(){
            c.close();
        });
        var $confirm = c.$open_widget.find('.confirm');
        c.$open_widget.delegate('.part_form input','keydown',function(e){
            if(e.keyCode == 13){
                return false;
            }
        });
        $confirm.click(function(){
            if(typeof options.beforefn == 'function'){
                if(!options.beforefn()){
                    return false;
                }
            }

            $ow_loading.show();
            $confirm.addClass('disabled');
            $.ajax({
                url: options.url,
                type: 'post',
                data: c.$open_widget.find('.part_form').serialize(),
                success: function (data) {
                    if (data == 'ok') {
                        $.get(getUrl, function (data) {
                            c.close();
                            Tip('操作成功!');
                            $('.table-responsive').html($(data).find('.table-responsive').html());
                        });
                    } else {
                        $confirm.removeClass('disabled');
                        $ow_loading.hide();
                        c.setContent(data);
                    }
                },
                error: function () {
                    $ow_loading.hide();
                    $confirm.removeClass('disabled');
                    Tip('操作失败!', 'error');
                }
            });

        });
    }
    function c_view(options)
    {
       return new C(options);
    }
    function c_open(option)
    {
        var defaultoption = {};
        defaultoption.btn1 = {
            name:'cancel',
            color:'',
            fn:function(){c.close();}
        };
        defaultoption.btn2 = {
            name:'confirm',
            color:'primary',
            fn:function(){}
        };
        option = $.extend(true,defaultoption,option);

        option.btnString = '<div style="float: right;">' +
                                    '<span style="float: left;height: 50px; display: none;" class="ow_loading"></span>' +
                                    '<button class="btn btn-sm btn-'+option.btn1.color+' cancel" style="float:left;margin: 5px;">'+option.btn1.name+'</button>' +
                                    '<button style="margin: 5px;float:left;" class="btn btn-sm  btn-'+option.btn2.color+' confirm">'+option.btn2.name+'</button>' +
                                '</div>';
        var c = new C(option);
        c.$open_widget.find('.cancel').click(function(){
            option.btn1.fn();
        });
        c.$open_widget.find('.confirm').click(function(){
            option.btn2.fn();
        });
        return c;
    }

    window.pop = {
        view:function(options){
            return c_view(options);
        },
        confirm:function(content,fn,cancelfn){
            c_confirm(content,fn,cancelfn);
        },
        alert:function(content){
            c_alert(content);
        },
        open:function(option){
             return c_open(option);
        },
        /**
         * beforefn:function(){}
         * @param options
         */
        editOpen:function(options){
            c_editOpen(options);

        }
    };

})();
