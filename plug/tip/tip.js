/**
 * Created by fu.
 * Date: 14-5-14
 * Time: 下午5:07
 */
/**
 *
 * @param html
 * @param status  ok or error
 * @param timeout
 */
var Tip = function (html,status, timeout) {
    var background='#3F84FF';
    var $tip_widget = $('body').find('.tip_widget');
    var pl = 0,
        pt = 0,
        eleWidth = 350;
    if(status == 'error'){
        background = '#FF7979';
    }
    if(!$tip_widget.length){
        $tip_widget = $('<div class="tip_widget"></div>')
            .css({
                position:'absolute',
                padding:'10px 20px',
                right:0,
                top:0,
                boxShadow:'5px 5px 13px rgba(0,0,0,.8)',
                minHeight:30,
                fontSize:16,
                zIndex:1234,background:background,color:'#fff', width:300
            }
        );
        $tip_widget.appendTo('body');
    }
    $tip_widget.css({background:background}).html(html);
    timeout = timeout || 1500;

    pl = ($(window).width() - eleWidth) / 2;
    pt = ($(window).height()) / 2;
    pt =  $(document).scrollTop()/ 2 + pt;
    $tip_widget.css({opacity:0}).show();
    $tip_widget.css({left:pl, top:pt}).stop().animate({top:pt-30,opacity:1},300,function () {
        setTimeout(function () {
            $tip_widget.animate({top:pt+30,opacity:0},300,function(){
                $tip_widget.hide();
            });
        }, timeout);
    });

    return $tip_widget;
};