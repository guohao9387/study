var ws;
var uuid;
var debug = true;
if ("WebSocket" in window) {
    //alert("您的浏览器支持 WebSocket!");
    // 打开一个 web socket
} else {
    // 浏览器不支持 WebSocket
    alert("请更换新版本浏览器");
    // alert("您的浏览器不支持 WebSocket!");
}
//ws = new WebSocket("ws://" + push_server_addr + "/ws");
function newsocket(push_server_addr) {
    ws = new WebSocket("ws://" + push_server_addr + "/ws");
    //ws.onopen = function() {
    // Web Socket 已连接上，使用 send() 方法发送数据
    //ws.send("发送数据");
    // };
    ws.onmessage = function(evt) {
        var received_msg = evt.data;
        if (debug) {
            console.log(received_msg);
        }
        // alert("数据已接收...");
    };
    ws.onclose = function() {
        // 关闭 websocket
        if (debug) {
            console.log('socket close');
        }
        // alert("连接已关闭...");
    };
}

function ws_send_message(content) {
    if (debug) {
        console.log(content);
    }
    // console.log(ws);
    ws.onopen = function() {
        ws.send(content);
    }
}