//问路走势
//_this  问路表格 game_type 游戏类型1 百家乐 2龙虎斗   data 问路数据
function draw_road(_this, game_type, data) {
   // console.log(data);
    var x = 0;
    var y = 0;
    var p_x = 0;
    //var p_y=0;
    var is_right = 0;
    var eq_value = 0;
    for (var m in data) {
        // console.log(data[k]['game_id']);
        if (m == 0) {
            x = 0;
            y = 0;
        } else {
            if (data[m]['trade_reslut'] == data[m - 1]['trade_reslut']) {
                if (is_right > 0) {
                    x++;
                    p_x++;
                } else {
                    y++;
                    if (y > 5) {
                        y = 5;
                        x++;
                        p_x++;
                    }
                }
            } else {
                x++;
                //x=x-p_x;
                y = 0;
                is_right = 0;
                if (p_x != 0) {
                    x = x - p_x;
                    p_x = 0;
                }
            }
            eq_value_a = (y + 1) * 20 + x;
            if ($("#" + _this + " td:eq(" + eq_value_a + ")").text() != "") {
                is_right++;
            } else {}
        }
        eq_value = y * 20 + x;
        if (game_type == 1) { //百家乐
            // $("#trade_list_" + k + " td:eq(101)").text('闲');
            //console.log(data[k]['trade_list'][m]['trade_reslut']);
            if (data[m]['trade_reslut'] == "zhuang") {
                //$("#trade_list_"+k:eq(0)).text('some text');
                $("#" + _this + " td:eq(" + eq_value + ")").text('庄');
                // console.log($("#trade_list_"+k+" td:eq(0)"))
                // console.log(k)
            } else if (data[m]['trade_reslut'] == "xian") {
                $("#" + _this + " td:eq(" + eq_value + ")").text('闲');
            } else if (data[m]['trade_reslut'] == "bjl_he") {
                $("#" + _this + " td:eq(" + eq_value + ")").text('和');
            } else if (data[m]['trade_reslut'] == "zhuangdui") {
                $("#" + _this + " td:eq(" + eq_value + ")").text('庄对');
            } else if (data[m]['trade_reslut'] == "xiandui") {
                $("#" + _this + " td:eq(" + eq_value + ")").text('闲对');
            } else {}
        } else if (game_type == 2) {
            if (data[m]['trade_reslut'] == "long") {
                $("#" + _this + " td:eq(" + eq_value + ")").text('龙');
            } else if (data[m]['trade_reslut'] == "hu") {
                $("#" + _this + " td:eq(" + eq_value + ")").text('虎');
            } else if (data[m]['trade_reslut'] == "lh_he") {
                $("#" + _this + " td:eq(" + eq_value + ")").text('和');
            } else {}
        } else {}
    }
}

/*
function time_down(time_down_this, count_time) {
    setTime = setInterval(function() {
        if (count_time <= 0) {
            // clearInterval(setTime);
            //  return;
            $("#time_down_status_" + time_down_this).text("停止下注");
        }
        count_time--;
        // console.log(count_time);
        if (count_time <= 0) {
            count_time = "000";
        } else if (count_time < 10) {
            count_time = "00" + count_time;
        } else if (count_time >= 10 && count_time < 100) {
            count_time = "0" + count_time;
        } else if (count_time >= 100 && count_time < 999) {
            count_time = count_time;
        } else if (count_time > 999) {
            count_time = 999;
        }

        $("#time_down_" + time_down_this).text(count_time);
    }, 1000);

}

function table_list_info_show(info_this, data) {
    //台桌状态  
}
*/