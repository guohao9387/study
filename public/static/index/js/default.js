
//获取下注结果的文字提示
function result_text(txt,audio){
    var now_res = txt;
    audio = audio || false;
    var result_str = '';
    var result_audio = '';
    switch (now_res){
        case 'zhuang':
            result_str = '庄赢';
            result_audio = 'zhuang_jia_ying';
            break;
        case 'zhuang,zhuangdui':
            result_str = '庄赢 庄对';
            result_audio = 'zhuang_zhuangdui';
            break;
        case 'zhuang,xiandui':
            result_str = '庄赢 闲对';
            result_audio = 'zhuang_xiandui';
            break;
        case 'zhuang,zhuangdui,xiandui':
            result_str = '庄赢 庄闲对';
            result_audio = 'zhuang_zhuangxiandui';
            break;
        case 'xian':
            result_str = '闲赢';
            result_audio = 'xian_jia_ying';
            break;
        case 'xian,xiandui':
            result_str = '闲赢 闲对';
            result_audio = 'xian_xiandui';
            break;
        case 'xian,zhuangdui':
            result_str = '闲赢 庄对';
            result_audio = 'xian_zhuangdui';
            break;
        case 'xian,zhuangdui,xiandui':
            result_str = '闲赢 庄闲对';
            result_audio = 'xian_zhuangxiandui';
            break;
        case 'bjl_he':
            result_str = '和赢';
            result_audio = 'ping_shou';
            break;
        case 'bjl_he,zhuangdui':
            result_str = '和赢 庄对';
            result_audio = 'ping_zhuangdui';
            break;
        case 'bjl_he,xiandui':
            result_str = '和赢 闲对';
            result_audio = 'ping_xiandui';
            break;
        case "bjl_he,zhuangdui,xiandui":
            result_str = '和赢 庄闲对';
            result_audio = 'ping_zhuangxiandui';
            break;
        case 'long':
            result_str = "龙赢";
            result_audio = 'long_ying';
            break;
        case 'hu':
            result_str = "虎赢";
            result_audio = 'hu_ying';
            break;
        case 'lh_he':
            result_str = "和赢";
            result_audio = 'ping_shou';
            break;
    }
    if(!audio){
        return result_str;
    }else{
        return [result_str,result_audio];
    }
}

function get_right_html(data){
    var top = '';
    var middle = '';
    if(!data) return;
    if(data.trade_result == undefined){
        return ['',''];
    }
    if(data.trade_result.zhuang != undefined){
        top += '<p>庄：<span id="trade_result_zhuang">'+data.trade_result.zhuang+'</span></p>';
    }
    if(data.trade_result.xian != undefined){
        top += '<p>闲：<span id="trade_result_xian">'+data.trade_result.xian+'</span></p>';
    }
    if(data.trade_result.bjl_he != undefined){
        top += '<p>和：<span id="trade_result_bjl_he">'+data.trade_result.bjl_he+'</span></p>'
    }
    if(data.trade_result.zhuangdui != undefined){
        top += '<p>庄对：<span id="trade_result_zhuangdui">'+data.trade_result.zhuangdui+'</span></p>';
    }
    if(data.trade_result.xiandui != undefined){
        top += '<p>闲对：<span id="trade_result_xiandui">'+data.trade_result.xiandui+'</span></p>';
    }

    if(data.trade_result.long != undefined){
        top += '<p>龙：<span id="trade_result_long">'+data.trade_result.long+'</span></p>';
    }
    if(data.trade_result.hu != undefined){
        top += '<p>虎：<span id="trade_result_hu">'+data.trade_result.hu+'</span></p>';
    }
    if(data.trade_result.lh_he != undefined){
        top += '<p>和：<span id="trade_result_lh_he">'+data.trade_result.lh_he+'</span></p>';
    }


    if(data.trade_limit_zhuang != undefined){
        middle += '<p>庄限红：'+data.trade_min+'/'+data.trade_limit_zhuang+'</p>';
    }
    if(data.trade_limit_xian != undefined){
        middle += '<p>闲限红：'+data.trade_min+'/'+data.trade_limit_xian+'</p>';
    }
    if(data.trade_limit_bjl_he != undefined){
        middle += '<p>和限红：'+data.trade_min+'/'+data.trade_limit_bjl_he+'</p>'
    }
    if(data.trade_limit_zhuangdui != undefined){
        middle += '<p>庄对限：'+data.trade_min+'/'+data.trade_limit_zhuangdui+'</p>';
    }
    if(data.trade_limit_xiandui != undefined){
        middle += '<p>闲对限：'+data.trade_min+'/'+data.trade_limit_xiandui+'</p>';
    }

    if(data.trade_limit_long != undefined){
        middle += '<p>龙限红：'+data.trade_min+'/'+data.trade_limit_long+'</p>';
    }
    if(data.trade_limit_hu != undefined){
        middle += '<p>虎限红：'+data.trade_min+'/'+data.trade_limit_hu+'</p>';
    }
    if(data.trade_limit_lh_he != undefined){
        middle += '<p>和限红：'+data.trade_min+'/'+data.trade_limit_lh_he+'</p>';
    }

    return [top,middle];
}

/**
 * 闪烁效果
 * @param obj
 */
function bulin(obj){
    var obj = obj;
    //每多少秒闪一次
    var st = setInterval(function(){
        litSlash(obj);
    },500);
    //几秒后清除闪烁效果
    setTimeout(function(){
        clearInterval(st);
    },4000);
}


function litSlash(obj){
    obj.animate(
        {opacity:"0"},250
    );
    obj.animate(
        {opacity:"1"},499
    );
}

/**
 *
 * @param data     筹码数据
 * @param obj       下注区域
 */
function pc_set_chip(data,obj){
    if(data){
        //console.log(data);
        var html = '<div class="user-cathectic">'+
            '<p class="cathectic-money">10</p>'+
            '<div class="cathectic-icon"><img src="/static/index/images/7.png" alt=""></div>'+
            '</div>';
        for(v in data){
            //var p = obj.find('li p[class="'+ v.qy+'"]').parent()
            var p = obj.find('li p[class="'+ data[v].qy+'"]').parent();
            if(p.length > 0){
                var node = $(html)
                node.find('.cathectic-money').text( data[v].money);
                p.append(node);
            }
        }
    }
}

/**
 *
 * @param data     筹码数据
 * @param obj       下注区域
 */
function mobile_set_chip(data,obj){
    if(data){
        //console.log(data);
        var html = '<div class="user-cathectic">'+
            '<div class="item">'+
            '<p class="cathectic-money">200</p>'+
            '<div><img src="/static/mobile/images/7.png" alt=""></div>'+
            '</div>'+
            '</div>';
        for(v in data){
            //var p = obj.find('li p[class="'+ v.qy+'"]').parent()
            var p = obj.find('li div[chip-type="'+ data[v].qy+'"]');
            if(p.length > 0){
                var node = $(html)
                node.find('.cathectic-money').text( data[v].money);
                p.append(node);
            }
        }
    }
}