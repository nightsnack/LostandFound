
<div class="content-wrapper">
         <section class="content">
          <div class="row">
            <div class="col-md-6">
              <div class="box box-info">
            
                <div class="box-body">
                 
                  <form role="form" id="insertForm" method="post">
                    <!-- text input -->
                    <div class="form-group has-warning">
                      <label>物品名称(必填)：</label>
                      <input type="text" class="form-control" name="item_name" placeholder="请填写物品名称" required>
                    </div>
                    <div class="form-group has-warning">
                      <label>物品种类(一旦填写不能更改)：</label>
                      <select class="form-control" name="type_id">
                        <option value=1>校园卡/证件</option>
                        <option value=2>U盘/存储设备</option>
                        <option value=3>手机/数码产品</option>
                        <option value=4>眼镜/生活用品</option>
                        <option value=5>钱包/箱包</option>
                        <option value=6>图书/书刊</option>
                        <option value=7>衣服/鞋帽</option>
                        <option value=8>自行车/代步工具</option>
                        <option value=9>其它</option>
                      </select>
                    </div>
                    <div class="form-group has-warning">
                      <label>发布人电话(必填)：</label>
                      <input type="text" class="form-control" name="tel" placeholder="请填写发布人电话" number="true" required>
                    </div>
                    <div class="form-group">
                      <label>丢失时间：</label>
                      <input type="text" class="form-control" name="time" placeholder="请填写捡到时间">
                    </div>
                    <div class="form-group">
                      <label>丢失地点：</label>
                      <input type="text" class="form-control" name="position" placeholder="请填写捡到地点">
                    </div>

                    <!-- textarea -->
                    <div class="form-group">
                      <label>物品详情</label>
                      <textarea class="form-control" name="detail" rows="3" placeholder="请填写物品详情"></textarea>
                    </div>

                    <div class="form-group">
                      <label>上传图片</label>
                      <p>请上传小于5M的横版图片文件，部分机型暂时不兼容，正努力解决中…</p>
                      <input type="text" class="form-control" name="uploadphotos" id="uploadphotos" value="" style="display:none">
                    <div id="ossfile">你的浏览器不支持flash,Silverlight或者HTML5！</div>

                <div id="container">
                    <a id="selectfiles" href="javascript:void(0);" class='btn btn-sm btn-default'><i class="fa fa-file-image-o"></i> 选择图片</a>
                    <a id="postfiles" href="javascript:void(0);" class='btn btn-sm btn-default pull-right'><i class="fa fa-cloud-upload"></i> 开始上传</a>
                </div>
                 <br>
                  </div>
                  
                    <div class="form-group">
                      <button class="btn btn-block btn-default btn-flat" type="submit">提交</button>
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
        $("#insertForm").validate({
            submitHandler: function() {
                $("#insertForm").ajaxSubmit({
                    type: "post",
                    url: "<?php echo site_url('Lose/insertItem')?>",
                    dataType: "json",
                    success: function(result) {
                        //返回提示信息       
                        if(result.errno==0)
                        {
                            alert("添加成功!");
                             window.location.href="<?php echo site_url('Lose/showDetail')."/"?>"+result.item_id; 
                        }
                        else
                            alert(result.error);
                        
                    }
                });
            }
        });
    });
</script>



