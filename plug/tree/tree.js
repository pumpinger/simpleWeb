/**
 * Created by Administrator on 2015/5/14.
 */




/**
 * 命名
 * item   data的每一条
 * child  树的叶子;子元素;成员
 * node   树的节点;文件夹;部门
 * layer  树的层级,能同时包含node,child;
 *
 *
 *
 */
(function ($) {


    var defOpt = {
        has_search:false,
        only_child:true,//是否只要 child
        zIndex:1,
        is_node_first:false,//是否需要节点排在前面  否则按照data的顺序
        is_multi:true,//是否多选
        expand:false,
        rootId:0,
        width:null,
        maxHeight:null,
        data:[],
        onInit: function () {},
        onOpen: function () {},
        onBeforeOpen: function () {},
        onClose: function () {},
        onChange: function () {}
        //事件的命名空间 应该有配置项
        //data  单个的class icon
    };

    var searchTimer;


    $.fn.extend({
        tree:function(opt){

            var obj =new tree(opt);
            //局部刷新后   绑定在之前页面元素上的  这个obj  是否还存在

            if(obj.init($(this))){

                $(this).off('click.tree');
                $(this).on('click.tree', function (e) {
                    obj.start();
                    e.stopPropagation();
                });


//                    $('body').off('click.tree');
                $(document).on('click.tree', function () {
                    obj.end();
                });

                return obj;
            }

            return false;
        }
    });


    var tree=function(opt){
        this.opt = $.extend({},defOpt,opt);
    };



    tree.prototype={
        init:function(dom){
            this.dom = dom;

            this.data=this.opt.data;

            var res=checkData(this.data);
            if(!res){
                return false;
            }

//                this.prototype.html=this.makePanel(); //todo
//                this.html;
            this.html=this.makePanel();
//                this.start();

//                this.dom.css('position','relative');

            this.onChange=this.opt.onChange;
            this.onClose=this.opt.onClose;
            this.onBeforeOpen=this.opt.onBeforeOpen;
            this.onOpen=this.opt.onOpen;
            this.onInit=this.opt.onInit;

            this.originId=this.getId();
            this.onInit(this.getName(), this.originId,this.getItem());

            this.is_open=false;
            return true;
        },
        start:function(){
            this.onBeforeOpen();
            this.showPanel();
            this.showData();
            this.is_open=true;
            this.html.find('.search_ipt_s').focus();
            this.onOpen();
        },
        end:function(){
            if(this.is_open){
                this.html.hide();
                this.dom.val(this.getName());
                var ids=this.getId();
                this.is_open=false;
                this.onClose(!(ids==this.originId),this.getId(),this.getItem());
                this.originId=ids;
            }
        },
        getName:function(){
            var text=[];
            var data=this.data;
            if(this.opt.only_child){
                $.each(data,function(i,n){
                    if(n.is_check && !n.is_node){
                        text.push( n.name);
                    }
                });
            }else{
                var node=[];
                $.each(data,function(i,n){
                    if(n.is_check && n.is_node){
                        node.push( n.id);
//                            text.push( n.name);  //nodefirst
                    }
                });

                var clone= $.extend(true,[],data);
                $.each(clone,function(i,n){
                    if(    (n.is_check  &&  $.inArray(n.nodeId,node) != -1) || !n.is_check  ){
                        clone[i]=null;
                    }
                });

                $.each(clone,function(i,n){
                    if(n){
                        text.push( n.name);
                    }
                });

            }

            return text.join();
        },
        getId:function(){
            var id=[];
            var data=this.data;

            if(this.opt.only_child){
                $.each(data,function(i,n){
                    if(n.is_check && !n.is_node){
                        id.push( data[i].id);
                    }
                });
            }else{
                $.each(data,function(i,n){
                    if(n.is_check ){
                        id.push( data[i].id);
                    }
                });
            }

            return id.join();
        },
        getItem:function(){
            var arr=[];
            var data=this.data;
            if(this.opt.only_child) {
                $.each(data, function (i, n) {
                    if (n.is_check && !n.is_node) {
                        arr.push(n);
                    }
                });
            }else{
                $.each(data, function (i, n) {
                    if (n.is_check) {
                        arr.push(n);
                    }
                });
            }
            return arr;
        },
        showPanel:function(){
            this.html.css({
                top:this.dom.position().top+this.dom.outerHeight(),
                left:this.dom.position().left,
                minWidth:250
            });

            this.html.on('click', function (e) {
                e.stopPropagation();
            });

            this.dom.after(this.html);
        },
        showData:function(){
            if( ! this.html.find('input[type="checkbox"]').length){
                this.showLayer(this.opt.rootId);
            }else{
                this.html.show();
            }
        },
        showLayer:function(layer){
            var showData=getLayerData(this.data,layer);
            var itemDiv=makeLayer();


            //这里 0节点的结构 和 子节点的结构 没有处理好    以后尽量让node-id 和  itemdiv 分开
            if(layer===this.opt.rootId){
                itemDiv=$(itemDiv).attr('node-id',this.opt.rootId);
                this.html.append(itemDiv);
                //itemDiv.parent().attr('node-id',0);

            }else{
                this.html.find('div[node-id="'+layer+'"]').append(itemDiv);
                this.html.find('div[node-id="'+layer+'"] span:first').html(makeDown());
            }

            for(var i in showData){
                itemDiv.append(this.makeItem(showData[i]));
            }
        },
        removeLayer:function(layer){
            this.html.find('div[node-id="'+layer+'"]>div').remove();
            this.html.find('div[node-id="'+layer+'"] span:first').html(makeRight());

        },
        search:function(val){
            this.removeLayer(this.opt.rootId);

            if(val===''){
                this.html.find('div[node-id="'+this.opt.rootId+'"]').remove();
                this.showLayer(this.opt.rootId);
            }else{
                for(var i in this.data){
                    if(  !this.data[i].is_node &&   this.data[i].name.indexOf(val) != -1){
                        this.html.find('div[node-id="'+this.opt.rootId+'"]').append(this.makeItem(this.data[i]));
                    }
                }
            }
        },
        makePanel:function(){
            var html='<div></div>';

            if(this.opt.has_search){
                html=this.makeSearch(html);
            }

            return $(html).css({
                'z-index':this.opt.zIndex,
                border:'1px solid #5d5d5d',
                'background':'#fff',
                position:'absolute',
                maxHeight:300,
                'white-space':'nowrap',
                'overflow':'auto'
            });
        },
        makeSearch:function(html){
            var search='<input class="search_ipt_s" type="text" placeholder="搜索"/></div>';
            search=$(search).css({
                'border':'none',
                'padding':'4px 0',
                'margin':'5px 0 0 0'
            });

            var obj=this;
            $(search).on('keyup paste',function(){
                var dom=this;
                clearTimeout(searchTimer);
                searchTimer=setTimeout(function(){
                    obj.search(dom.value);
                },100);
            });

            return  $(html).append(search);

        },
        makeNode: function (item) {
            var $html=$('<div node-id="'+item.id+'"><span>'+makeRight()+'</span><input type="checkbox" data-isNode="1" data-id="'+item.id+'"  '+(item.is_check?'checked':'')+' data-name="'+item.name+'"/><span>'+item.name+'</span></div>');
            $html.find('span').css({
                'cursor':'pointer',
                'user-select':'none',
                '-webkit-user-select':'none',
                '-moz-user-select':'none',
                '-ms-user-select':'none'
            });
            var obj=this;
            $html.find('span').on('click',function(){
                if(!$html.find('div')[0]){
                    obj.showLayer(item.id);
                }else{
                    obj.removeLayer(item.id);
                }
            });

            return $html;
        },
        makeChild:function(item){
            var $html=$('<div><span></span><label><input type="checkbox" data-id="'+item.id+'" data-isNode="0" data-name="'+item.name+'" '+(item.is_check?'checked':'') +'/>'+item.name+'</label><br></div>');
            $html.find('span').css({
                'width':'13px',
                'user-select':'none',
                '-webkit-user-select':'none',
                '-moz-user-select':'none',
                '-ms-user-select':'none',
                'display':'inline-block'
            });
            return $html;
        },
        makeItem:function(item){
            var $html;
            if(item.is_node){
                $html= this.makeNode(item);
            }else{
                $html= this.makeChild(item);
            }

            var obj=this;
            $html.find('input').on('click',function(){
                obj.chgItem(item,$(this));
            });

            return $html;
        },
        chgItem:function(item,dom){
            item.is_check=!item.is_check;

            if(item.is_node){
                dom.parent().find('input').prop('checked',item.is_check);
                this.chgNode(item.id,item.is_check);
            }

            if(!item.is_check){
                this.cancelCheck(item.nodeId);
            }

            this.onChange(this.getName(),this.getItem(),item);
        },
        cancelCheck:function(id){
            var obj=this;
            $.each(obj.data,function(i,n){
                if(n.id ==id && n.is_check && n.is_node){
                    n.is_check=false;
                    obj.html.find('input[data-isNode="1"][data-id="'+id+'"]').prop('checked',false);
                    obj.cancelCheck(n.nodeId);
                }
            })
        },
        chgNode:function(nodeid,bol){
            var obj=this;
            $.each($.extend(true,[], this.data),function(i,n){
                if(n.nodeId == nodeid){
                    obj.data[i].is_check=bol;
                    if(n.is_node){
                        obj.chgNode(n.id,bol);
                    }
                }
            });
        },
        x:0
    };




    function makeLayer(){
        var html='<div></div>';

        return $(html).css({
            'margin-left':'10px'
        });
    }

    function makeRight(){
        var html='<i class="iconfont icon-xiangyou"></i>';

        return $(html).css({
            'font-size':'12px',
            'padding-right':'1px'

        })[0].outerHTML;
    }

    function makeDown(){
        var html='<i class="iconfont icon-xiangxia"></i>';

        return $(html).css({
            'font-size':'12px',
            'padding-right':'1px'
        })[0].outerHTML;
    }


    function getLayerData(data,parent){
        var res=[];
        for(var i in data){
            if(data[i].nodeId==parent){
//                if(data[i].is_node){
//                    res.unshift(data[i])
//                }else{
//                    res.push(data[i]);
//                }

                res.push(data[i]);  //原序
            }
        }
        return res;
    }

    function checkData(data){
        for(var i in data){
            return typeof data[i] =='object';
        }
        return false;
    }



})($);

$(function(){
    //$('.member_tree').tree({
    //    only_child:true,
    //    has_search:true,
    //    data:[
    //        {id:1,name:'行政部',nodeId:0,is_node:true,is_check:false},
    //        {id:3,name:'财务部',nodeId:1,is_node:true,is_check:false},
    //        {id:5,name:'财务部2',nodeId:3,is_node:true,is_check:false},
    //        {id:6,name:'财务部3',nodeId:5,is_node:true,is_check:false},
    //        {id:7,name:'财务部4',nodeId:6,is_node:true,is_check:false},
    //        {id:8,name:'财务部5',nodeId:7,is_node:true,is_check:false},
    //        {id:9,name:'财务部6',nodeId:8,is_node:true,is_check:false},
    //        {id:5,name:'李职员',nodeId:9,is_node:false,is_check:false},
    //        {id:6,name:'孙职员',nodeId:8,is_node:false,is_check:false},
    //        {id:2,name:'张部长',nodeId:1,is_node:false,is_check:false},
    //        {id:4,name:'刘职员',nodeId:3,is_node:false,is_check:false},
    //        {id:1,name:'王经理',nodeId:0,is_node:false,is_check:true}
    //    ],
    //    onInit: function (name,ids,item) {
    //        //this.dom.val(name);
    //    },
    //    onOpen: function () {
    //    },
    //    onBeforeOpen: function () {
    //    },
    //    onClose: function (hasChange,ids,item) {
    //        //console.log(hasChange);
    //        //console.log(ids);
    //        console.log(item);
    //    },
    //    onChange: function (name,item,target) {
    //    }
    //});

    //
//var tree2=$('.member_test').tree({
//    only_child:false,
//    has_search:false,
//    data:[
//        {id:2,name:'四川',nodeId:0,is_node:true,is_check:false},
//        {id:3,name:'成都',nodeId:2,is_node:false,is_check:false},
//        {id:4,name:'湖北',nodeId:0,is_node:true,is_check:false},
//        {id:5,name:'武汉',nodeId:4,is_node:false,is_check:false},
//        {id:6,name:'北京',nodeId:0,is_node:false,is_check:false}
//    ],
//    onInit: function (name,ids,item) {
//    },
//    onOpen: function () {
//    },
//    onBeforeOpen: function () {
//    },
//    onClose: function (hasChange,ids,item) {
//    },
//    onChange: function (item) {
//    }
//});
});

