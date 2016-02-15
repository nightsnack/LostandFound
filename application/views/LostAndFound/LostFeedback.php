<div data-role="header">
  <h1>查找结果</h1>
</div>
<div data-role="main" class="ui-content result_display">

  <ul data-role="listview" data-filter="true" data-input="#myFilter" data-inset="true">
  <?php foreach ($res as $list_item): ?>
    <li>
      <a href="<?php echo site_url("LostAndFound/Lose/showDetail/{$list_item['item_id']}"); ?>">
        <h2><?php echo $list_item['item_name']?></h2>
        <p><?php echo $list_item['detail']?></p>
        <p><?php echo $list_item['retrieve']?></p>
      </a>
    </li>
    <?php endforeach; ?>

    </ul>
  </div>
  <?php 
  echo $page;

  ?>
