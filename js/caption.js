
var myurl = document.getElementById("urlInput");
var urlbtn = document.getElementById("urlBtn");
var caprst = document.getElementById("captionresult");

//给后端请求ajax
//返回 JSON

alert(111);
//caprst.innerHTML = String(caprst);

//alert($('#urlInput'));
$(document).ready(function () {
    $("[id='urlBtn']").click(function () {
        //alert(222);
        alert($("[id='urlInput']").val());
        $.post(
            'develop/AjaxTest.php',
            {
                "myurl": $("[id='urlInput']").val()
            },
            function callback (data) {
                alert(333);
                
                var dataObj = JSON.parse(JSON.stringify(data));
                alert(444);
                alert(dataObj.tags);
                var html='<div class="img lazy-img" style="padding-bottom: 60.10738255033557%;"><img data-src='+dataObj.pic_url+' alt=""></div>';
                $("[id='imgout']").replaceWith(html);
                html='<figcaption class="indents-2" id="captionresult1"style="color: #6b0909;">'+dataObj.tags+'</figcaption>';
                $("[id='captionresult1']").replaceWith(html);
                html='<h3 class="indents-2" id="captionresult2"style="color: #6b0909;">'+dataObj.pic_caption+'</h3>';
                $("[id='captionresult2']").replaceWith(html);
                html='<p class="indents-2" id="captionresult3"style="color: #6b0909;">'+dataObj.src_text+'</p>';
                $("[id='captionresult3']").replaceWith(html);
            }
        );
    });
});

//请求myurl

//接收返回的东西

//prc_url 图片的url
//pic_caption 图片的caption内容（中文）
//src_text 源文本（中文）
//tags 关键词（中文）


