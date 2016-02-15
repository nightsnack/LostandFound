<div data-role="header">
  <h1>我的招领启事</h1>
</div>

<div data-role="main" class="ui-content result_display">
  <form class="ui-filterable">
    <input id="myFilter" data-type="search" placeholder="搜索当前目录下的物品"> <!--It's awesome functional!!! -->
  </form>
  <ul data-role="listview" data-filter="true" data-input="#myFilter" data-inset="true">
  <?php foreach ($res as $list_item): ?>
    <li>
      <a href="<?php echo site_url("LostAndFound/Find/showDetail/{$list_item['item_id']}"); ?>">
        <h2><?php echo $list_item['item_name']?></h2>
        <p><?php echo $list_item['detail']?></p>
        <p><?php echo $list_item['receive']?></p>
      </a>
    </li>
    <?php endforeach; ?>
    </ul>
  </div>
<?php 
  echo $page;
?>