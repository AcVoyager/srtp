//给后端请求ajax
//返回 JSON

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
                var dataObj = JSON.parse(JSON.stringify(data));;
                var html='<img src='+dataObj.pic_url.substring(3)+ ' id="imgout" position:absolut; left:50%; top:50%; transform:translateX(-50%) translateY(-50%);  ></img>';
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


