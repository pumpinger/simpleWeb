

jQuery(function (jQuery) {

    var $body = $('body');

    $body.delegate('.delete_link', 'click', function () {
        var $this = $(this);
        var getUrl = window.location.href;
        pop.confirm('确认删除？', function () {
            $.startLoad();
            $.ajax({
                url: $this.data('href'),
                type: 'get',
                success: function (data) {
                    $.endLoad();
                    if (data == 'ok') {
                        $.get(getUrl, function (data) {
                            Tip('删除成功!');
                            $('.table-responsive').html($(data).find('.table-responsive').html());
                            if (typeof window.tableInit == 'function') {
                                window.tableInit();
                            }
                        });
                    } else {
                        Tip(data, 'error');
                    }
                },
                error: function () {
                    $.endLoad();
                    Tip('删除失败!', 'error');
                }
            });
        });
        return false;
    });

    $body.delegate('.ajax_link', 'click', function () {
        var $this = $(this);
        var getUrl = window.location.href;

        //$.confirm($this.attr('content'), function () {
        $.startLoad();
        $.ajax({
            url: $this.data('href'),
            type: 'get',
            success: function (data) {
                if (data == 'ok') {
                    $.get(getUrl, function (data) {
                        $.endLoad();
                        Tip('操作成功!');
                        $('.table-responsive').html($(data).find('.table-responsive').html());
                    });
                } else {
                    $.endLoad();
                    Tip(data, 'error');
                }
            },
            error: function () {
                $.endLoad();
                Tip('操作失败!', 'error');
            }
        });
        //});
        return false;
    });


    $body.delegate('.edit_link', 'click', function () {
        var $this = $(this);
        pop.editOpen({
            title: $this.data('title'),
            url: $this.data('href'),
            success: function () {
                default_focus();
            },
            beforefn: function () {
                return verifyReq();
            }
        });
        return false;
    });
    $body.delegate('.img_view', 'click', function () {
        var imgs = [];
        var $c = $(this);
        var c_index = 0;
        $('.img_view').each(function (i) {
            var $this = $(this);
            if ($c.attr('src') == $this.attr('src')) {
                c_index = i;
                console.log(i);
            }
            imgs.push($this.data('org') ? $this.data('org') : $this.attr('src'));
        });
        $.imgView({
            "imgs": imgs,
            c_index: c_index
        });
        return false;
    });

    ////分页
    //$body.on('change', '.s_page_size', function () {
    //    window.location.href = $(this).val();
    //});
    //
    //window.refreshList = function (this_e, params) {
    //    var getUrl = '';
    //    if (params && params.hasOwnProperty('url')) {
    //        getUrl = params['url'];
    //    } else {
    //        getUrl = window.location.href;
    //    }
    //    $.get(getUrl, function (data) {
    //        $(this_e).html($(data).find(this_e).html());
    //        if (params && params.hasOwnProperty('callback')) {
    //            tableFrozen.init();
    //            params['callback']();
    //        }
    //    });
    //};

    //开始，结束请求
    var $win = $(window);
    var $doc = $(document);
    var end = false;
    $.startLoad = function (str) {
        end = false;
        setTimeout(function () {
            if (end) {
                return;
            }
            end = false;
            var $load_widget = $body.find('.load_widget');
            if (!$load_widget.length) {
                $body.append('<div class="load_widget">' +
                '<div class="lw_loading" style=" padding-left: 45px;padding-right:10px;border:1px solid #666;box-shadow: 0 0 10px #666;line-height:40px;height: 40px; border-radius: 5px; ">loading...</div></div>');
                $load_widget = $body.find('.load_widget');
            }

            var pl, pt;
            pl = ($win.width() - 300) / 2;
            pt = ($win.height()) / 2;
            pt = $doc.scrollTop() - 40 / 2 + pt;
            str = (typeof str != 'undefined') ? str : 'requesting...';
            $load_widget.show().find('.lw_loading').css({
                left: pl,
                top: pt,
                position: 'absolute',
                zIndex: 1113
            }).html(str);

        }, 100);

    };

    $.endLoad = function () {
        end = true;
        var $load_widget = $body.find('.load_widget');
        $load_widget.hide();
    };
});

function verifyReq() {
    var ok = true;
    $('.req').each(function () {
        var $this = $(this);
        if ($this.val() == '' && ok) {
            ok = false;
            Tip($this.data('name') + 'NOT NULL', 'error');
        }
    });
    return ok;
}

//默认焦点
function default_focus() {
    var textValue = $('.default_focus').val();
    $('.default_focus').focus().val(textValue);
}

//写cookies

function setCookie(name,value)
{
    var exp = new Date();
    exp.setTime(exp.getTime() + 30*24*60*60);
    document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
}

//读取cookies
function getCookie(name)
{
    var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");

    if(arr=document.cookie.match(reg))

        return unescape(arr[2]);
    else
        return null;
}

//删除cookies
function delCookie(name)
{
    var exp = new Date();
    exp.setTime(exp.getTime() - 1);
    var cval=getCookie(name);
    if(cval!=null)
        document.cookie= name + "="+cval+";expires="+exp.toGMTString();
}



