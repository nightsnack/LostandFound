
<div class="content-wrapper">
    <section class="content-header">
        <h1>
              我发布的寻物启事
            </h1>
    </section>

    <section class="content"> 
           <div class="row">

            
            <div class="col-md-6 col-md-12">
              <div class="box box-primary">
                <div class="box-body">
                <ul class="products-list product-list-in-box">
                     <?php foreach ($res as $list_item): ?>
                    <li class="item">
                     <a href="<?php echo site_url("Lose/showDetail/{$list_item['item_id']}"); ?>">

                      <div class="product-img">
                        <img class="lazy" src="http://image.aifuwu.org/lostfound/load.gif" data-original="<?php         
        if ($list_item['uploadphotos']) 
            echo 'http://image.aifuwu.org/' . $list_item['uploadphotos'].'@100h_100w_2e';
         else
            echo 'http://image.aifuwu.org/lostfound/default.jpg@100h_100w_2e';
                                  
                                  ?>" alt="物品图片">
                      </div>
                      <div class="product-info">
                        <div class="product-title"><?php echo $list_item['item_name']?></div>
                        <span class="product-description">
                          <?php echo $list_item['detail'].' '?>
                        </span>
                        <br>
                        <span class="product-description">
                          找回状态：
                          <span class="label label-<?php if ($list_item['retrieve']=="已找回")
                                                            echo "info";
                                                            else echo "danger";?> pull-right"><?php echo $list_item['retrieve']?></span>
                        </span>
                      </div>
                        </a>
                    </li><!-- /.item -->
                        <?php endforeach; ?>
                  </ul>
                </div><!-- /.box-body -->
              </div>
            </div>
            
          </div>
    </section>
    <?php echo $page;?>
    
</div>
<script src="<?php echo base_url('assets/js/jquery_lazyload/jquery.lazyload.min.js')?>"></script>
<script>
$(function() {
    $("img.lazy").lazyload();
});
</script>