
<div class="content-wrapper">


    <section class="content"> 
           <div class="row">
             

            <div class="col-md-4">
              <!-- Widget: user widget style 1 -->
              <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-black" style="background: url('<?php echo $uploadphotos;?>'); 
                 background-size:100% 100%;
background-repeat:no-repeat;
                 center center;">
                  
                </div>
<div class="box-footer no-padding">
                  <ul class="nav nav-stacked">
                    <li><a>物品名称 <strong><span class="pull-right"><?php echo $item_name;?></span></strong></a></li>
                    <li><a>类别 <span class="pull-right badge bg-aqua"><?php echo $type;?></span></a></li>
                  </ul>
                </div>
              </div><!-- /.widget-user -->
            </div>
            <?php if ($is_mine): ?>
            <div class="col-md-4">
              <!-- Widget: user widget style 1 -->
              <div class="box box-widget widget-user">

<div class="box-footer no-padding">
                  <ul class="nav nav-stacked">
                      <li><a href="<?php echo site_url('/Lose/showUpdateLose').'/'.$item_id?>"><strong>编辑</strong> <i class="fa fa-angle-right pull-right"></i></a></li>
                  </ul>
                </div>
              </div><!-- /.widget-user -->
            </div>
            <?php endif; ?>
            <div class="col-md-4">
              <!-- Widget: user widget style 1 -->
              <div class="box box-widget widget-user">

<div class="box-footer no-padding">
                  <ul class="nav nav-stacked">
                    <li><a>发布人学号：<strong><span class="pull-right"><?php echo $student_id;?></span></strong></a></li>
                    <li><a>发布人姓名：<strong><span class="pull-right"><?php echo $release_name;?></span></strong></a></li>
                    <li><a>联系方式：<strong><span class="pull-right"><?php echo $tel;?></span></strong></a></li>
                    <li></li>
                  </ul>
                <div class="box-body1">
                 <p>丢失时间：</p>
                  <strong class="pull-right"><p><?php echo $time?></p></strong>
                  <br>
    </div>
                <div class="box-body1">
                <p>丢失地点：</p>
                  <strong class="pull-right"><p><?php echo $position;?></p></strong>
                   <br>
                    </div>
                    <div class="box-body1">
                <p>物品描述：</p>
                  <p><?php echo $detail;?></p>
                </div><!-- /.box-body -->

                </div>
                
              </div><!-- /.widget-user -->
            </div>
            
            <div class="col-md-12">
              <!-- The time line -->
              <ul class="timeline">
                <li class="time-label">
                  <span class="bg-red">
                    <?php echo $create_time;?>
                  </span>
                </li>
                <li>
                  <i class="fa fa-user bg-aqua"></i>
                  <div class="timeline-item">
                    <h3 class="timeline-header no-border"><a><?php echo $release_name;?></a> 上传了这个物品的记录</h3>
                  </div>
                </li>
                
                
                <li class="time-label">
                  <span class="bg-green">
                    <?php echo $retrieve_change_time;?>
                  </span>
                </li>
                <li>
                  <i class="fa fa-user bg-aqua"></i>
                  <div class="timeline-item">
                     <h3 class="timeline-header no-border"><a><?php echo $retrieve_change_person;?></a> 更改了该物品的通知状态为 <a><?php echo $retrieve;?></a></h3>
                  </div>
                </li>
                               
               
                <li>
                  <i class="fa fa-clock-o bg-gray"></i>
                </li>
              </ul>
            </div>
            
        </div>
    </section>
</div>

