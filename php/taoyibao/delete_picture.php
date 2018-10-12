<?php

    /**
     * 删除图片
     */
    public function goods_picture_delete(){
        $goods_id = I('goods_id');

        $goods = M('goods')->where(array('id'=>$goods_id))->find();
        $picture = $goods['picture'];
        $thumb = $goods['thumb'];
        $picture_path = $_SERVER['DOCUMENT_ROOT'].$picture;
        $thumb_path   = $_SERVER['DOCUMENT_ROOT'].$thumb;

        if(file_exists($picture_path)){
            $result_1 = unlink($picture_path);
        }
        if(file_exists($thumb_path)){
            $result_2 = unlink($thumb_path);
        }

        if($result_1 && $result_2){
            $result_3 = M('goods')->where(array('id'=>$goods_id))->save(array('picture'=>'', 'thumb'=>'','thumb_w'=>'0.0', 'thumb_h'=>'0.0'));
            if($result_3){
                $this->json('删除成功！', 1);
            }else{
                $this->json('删除失败！', 2);
            }
        }else{
            $this->json('删除失败！', 2);
        }

    }
    
  <script>
      $("#delete_picture").click(function(){
        layer.confirm('确定要删除图片吗?', {
            btn: ['确定','取消'] //按钮
        }, function(){
            var goods_id = $("#delete_picture").attr('data-id');
            $.ajax({
                url:"__APP__/Goods/goods_picture_delete",
                type:"post",
                data:'goods_id='+goods_id,
                success:function(re){
                    var flag = re.flag;
                    var msg = re.msg;
                    if (flag==1) {
                        layer.msg(msg);
                        self.location='/admin.php/Goods/goodsEdit/id/'+goods_id+'.html';
                    }else{
                        layer.msg(msg);
                    }
                }
            })
        }, function(){
			//取消
        });
    });
  </script>
