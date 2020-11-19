<script type="text/javascript" src="{THEME_PATH}assets/global/plugins/jquery.min.js" ></script>

<img src="" data-src="{dr_thumb($t.thumb)}">

<script language="javascript" type="text/javascript">
 // 图片懒加载 自定义属性 data-src
    start()
    $(window).on('scroll', function(){
        start()
    })

    function start(){
        $('body img').not('[data-isLoaded]').each(function(){
            var $node = $(this)
            if(isShow($node)){
                loadImg($node)
            }
        })
    }

    //判断一个元素是不是出现在窗口(视野)
    function isShow($node){
        return $node.offset().top <= $(window).height() + $(window).scrollTop()
    }
    //加载图片
    function loadImg(img){
        img.attr('src', img.attr('data-src')) //把data-src的值 赋值给src
        img.attr('data-isLoaded', 1)//已加载的图片做标记
    }
</script>
