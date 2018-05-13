
var myurl=document.getElementById("urlInput");
var urlbtn=document.getElementById("urlBtn");
var caprst=document.getElementById("captionresult");

//给后端请求ajax
//返回 JSON

alert(111);
//caprst.innerHTML = String(caprst);

$('#urlBtn').click(function(){
    $(document).ready(function(){
        $("#urlBtn").click(function(){
        htmlobj=$.ajax({
            type:'POST',
            //url:"/jquery/test1.txt",
            url:"../develop/AjaxTest.php",//服务器
            data: $('#urlInput'),
            success: function(data){
                console.log(data);
                //data.prc_url;
                var html='<div class="img lazy-img" style="padding-bottom: 60.10738255033557%;"><img data-src=String('+data.prc_url+') alt=""></div>';
                $("#imgout").append(html);
                var html='<p class="indents-2" id="captionresult">'+pic_caption+data.src_text+data.tags;+'</p>';
                $("#captionresult").append(html);
               // data.src_text;
                //data.tags;
            },
        });
        });
    });
})
//请求myurl

//接收返回的东西

//prc_url 图片的url
//pic_caption 图片的caption内容（中文）
//src_text 源文本（中文）
//tags 关键词（中文）


