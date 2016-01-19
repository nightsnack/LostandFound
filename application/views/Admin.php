<div data-role="header">
  <h1>我的失物招领</h1>
</div>

<div data-role="main" class="ui-content result_display">
  <form class="ui-filterable">
    <input id="myFilter" data-type="search" placeholder="搜索当前目录下的物品"> <!--It's awesome functional!!! -->
  </form>
  <ul data-role="listview" data-filter="true" data-input="#myFilter" data-inset="true">
    <li>
      <a href="<?php echo view_url(); ?>FindDetails">
        <img src="<?php echo asset_url(); ?>imgs/noimage.png">
        <h2>物品名称</h2>
        <p>物品描述</p>
      </a>
      <a href="#deleteConfirm" data-transition="pop" data-icon="delete">Delete</a>
    </li>
    <li>
      <a href="#">
        <img src="<?php echo base_url(); ?>uploads/example.jpg">  <!-- You may delete uploads directory and save uploaded pictures to database -->
        <h2>MacBook</h2>
        <p>银色 256G存储 Intel 1.1GHz双核处理器 </p>
      </a>
      <a href="#deleteConfirm" data-transition="pop" data-icon="delete">Delete</a>
    </li>
    <li>
      <a href="#">
        <img src="<?php echo asset_url(); ?>imgs/noimage.png">
        <h2>balbala</h2>
        <p>lalalalalal
          lalalalala example here </p>
        </a>
        <a href="#deleteConfirm" data-transition="pop" data-icon="delete">Delete</a>
      </li>
    </ul>
  </div>