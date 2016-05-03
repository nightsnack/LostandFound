<style>
    /* FROM HTTP://WWW.GETBOOTSTRAP.COM
        * Glyphicons
        *
        * Special styles for displaying the icons and their classes in the docs.
        */
    
    .bs-glyphicons {
        padding-left: 0;
        padding-bottom: 1px;
        margin-bottom: 20px;
        list-style: none;
        overflow: hidden;
    }
    
    .bs-glyphicons li {
        color: #333;
        float: left;
        width: 33.3333%;
        height: 125px;
        padding: 4%;
        margin: 0 -1px -1px 0;
        font-size: 16px;
        line-height: 1.3;
        text-align: center;
        border: 1px solid #ddd;
    }
    
    .bs-glyphicons .glyphicon {
        margin-top: 5px;
        margin-bottom: 10px;
        font-size: 30px;
    }
    
    .bs-glyphicons .glyphicon-class {
        display: block;
        text-align: center;
        word-wrap: break-word;
        /* Help out IE10+ with class names */
    }
    
    .bs-glyphicons li:hover {
        background-color: rgba(86, 61, 124, .1);
    }
    
    @media (min-width: 768px) {
        .bs-glyphicons li {
            width: 12.5%;
        }
    }
</style>


<div class="content-wrapper">
    <section class="content-header">
        <h1>
              请选择物品类别
            </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="nav-tabs-custom">

                    <div class="tab-content">


                        <!-- glyphicons-->
                        <div class="tab-pane active">

                            <ul class="bs-glyphicons">
                                <a href="<?php echo site_url('Find/showItems/1')?>">
                                    <li><span class="glyphicon glyphicon-credit-card"></span> <span class="glyphicon-class">校园卡/证件</span></li>
                                </a>
                                <a href="<?php echo site_url('Find/showItems/2')?>">
                                    <li><span class="glyphicon glyphicon-floppy-disk"></span> <span class="glyphicon-class">U盘/存储设备</span></li>
                                </a>
                                <a href="<?php echo site_url('Find/showItems/3')?>">
                                    <li><span class="glyphicon glyphicon-phone"></span> <span class="glyphicon-class">手机/数码产品</span></li>
                                </a>
                                <a href="<?php echo site_url('Find/showItems/4')?>">
                                    <li><span class="glyphicon glyphicon-sunglasses"></span> <span class="glyphicon-class">眼镜/生活用品</span></li>
                                </a>
                                <a href="<?php echo site_url('Find/showItems/5')?>">
                                    <li><span class="glyphicon glyphicon-briefcase"></span> <span class="glyphicon-class">钱包/箱包</span></li>
                                </a>
                                <a href="<?php echo site_url('Find/showItems/6')?>">
                                    <li><span class="glyphicon glyphicon-book"></span> <span class="glyphicon-class">图书/书刊</span></li>
                                </a>
                                <a href="<?php echo site_url('Find/showItems/7')?>">
                                    <li><span class="glyphicon"><i class="fa fa-user-secret"></i></span> <span class="glyphicon-class">衣服/鞋帽</span></li>
                                </a>
                                <a href="<?php echo site_url('Find/showItems/8')?>">
                                    <li><span class="glyphicon"><i class="fa fa-space-shuttle"></i></span> <span class="glyphicon-class">代步/交通工具</span></li>
                                </a>
                                <a href="<?php echo site_url('Find/showItems/9')?>">
                                    <li><span class="glyphicon glyphicon-option-horizontal"></span> <span class="glyphicon-class">其它</span></li>
                                </a>
                            </ul>
                        </div>
                        <!-- /#ion-icons -->

                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
        </div>
    </section>
</div>