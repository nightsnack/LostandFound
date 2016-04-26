
<div class="content-wrapper">
         <section class="content">
          <div class="row">
            <div class="col-md-6">
              <div class="box box-warning">
            
                <div class="box-body">
                 <div class="form-group has-success">
                      <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i>学号：</label>
                      <input type="text" class="form-control" id="inputSuccess" value="<?php echo $student_id;?>" disabled>
                    </div>
                 <div class="form-group has-success">
                      <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i>发布人姓名：</label>
                      <input type="text" class="form-control" id="inputSuccess" value="<?php echo $release_name;?>" disabled>
                 </div>
                 
                  <form role="form" id="updateForm" action="" method="post">
                    <!-- text input -->
                    <input type="text" class="form-control" name="item_id" value="<?php echo $item_id;?>" style="display:none" diasbled>
                    <div class="form-group">
                      <label>物品名称：</label>
                      <input type="text" class="form-control" name="item_name" value="<?php echo $item_name;?>" placeholder="Enter ..." required>
                    </div>
                    <div class="form-group">
                      <label>发布人电话：</label>
                      <input type="text" class="form-control" name="tel" value="<?php echo $tel;?>" placeholder="Enter ..." number="true" required>
                    </div>
                    <div class="form-group">
                      <label>捡到时间：</label>
                      <input type="text" class="form-control" name="time" value="<?php echo $time;?>" placeholder="Enter ...">
                    </div>
                    <div class="form-group">
                      <label>捡到地点：</label>
                      <input type="text" class="form-control" name="position" value="<?php echo $position;?>" placeholder="Enter ...">
                    </div>

                    <!-- textarea -->
                    <div class="form-group">
                      <label>物品详情</label>
                      <textarea class="form-control" name="detail" rows="3" placeholder="Enter ..."><?php echo $detail;?></textarea>
                    </div>

                    <!-- select -->
                    <div class="form-group">
                      <label>通知状态</label>
                      <select class="form-control" id="inform_id" name="inform_id">
                        <option value=0>未通知</option>
                        <option value=1>已通知</option>
                      </select>
                    </div>
                
                    <div class="form-group">
                      <label>领取状态</label>
                      <select class="form-control" id="receive_id" name="receive_id">
                        <option value="0">未领取</option>
                        <option value="1">已领取</option>
                        <option value="2">已移交</option>
                      </select>
                    </div>
                    
                    <div class="form-group">
                      <label>当前图片</label>
                    <img class="img-responsive pad" src="<?php echo $uploadphotos_img;?>" alt="Photo">
                    </div>

                    <div class="form-group">
                      <label>更新图片</label>
                      <input type="text" class="form-control" name="uploadphotos" id="uploadphotos" value="<?php echo $uploadphotos;?>" style="display:none">
                    <div id="ossfile">你的浏览器不支持flash,Silverlight或者HTML5！</div>

                <div id="container">
                    <a id="selectfiles" href="javascript:void(0);" class='btn btn-sm btn-default'><i class="fa fa-file-image-o"></i> 选择图片</a>
                    <a id="postfiles" href="javascript:void(0);" class='btn btn-sm btn-default pull-right'><i class="fa fa-cloud-upload"></i> 开始上传</a>
                </div>
                 <br>
                  </div>
                  
                    <div class="form-group">
                      <button class="btn btn-block btn-default btn-flat" type="submit">提交更新</button>
                    </div>
                  </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>   <!-- /.row -->
        </section>
</div>
<script type="text/javascript" src="<?php echo base_url('assets/js/plupload-2.1.2/js/plupload.full.min.js')?>"></script>

<script src="<?php echo base_url('assets/js/upload.js')?>"></script>
<script src="<?php echo base_url('assets/js/jquery_validation/jquery.validate.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/jquery_validation//messages_zh.min.js')?>"></script>

<script src="<?php echo base_url('assets/js/jquery.form.js')?>"></script>

<script>
    $().ready(function() {
            
    $("#inform_id").val("<?php echo $inform_id?>");
        $("#receive_id").val("<?php echo $receive_id?>");
        $("#updateForm").validate({
            submitHandler: function() {
                $("#updateForm").ajaxSubmit({
                    type: "post",
                    url: "<?php echo site_url('Find/updateItem')?>",
                    dataType: "json",
                    success: function(result) {
                        //返回提示信息       
                        if(result.errno==0)
                        {
                            alert("更新成功!");
                             window.location.href="<?php echo site_url('Find/showDetail')."/".$item_id?>"; 
                        }
                        else
                            alert(result.error);
                        
                    }
                });
            }
        });
    });
</script>



