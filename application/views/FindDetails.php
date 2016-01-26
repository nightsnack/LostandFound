<div data-role="header">
	<h1>物品详细信息</h1>
</div>

<div data-role="main" class="ui-content detial_display">

	<h2>物品名称：<?php echo $item_name;?></h2>
	<hr>
	<p>物品类型：<?php echo $type;?></p>
	<p>拾取人学号：<?php echo $student_id;?></p>
    <p>拾取人姓名：<?php echo $release_name;?></p>
    <p>拾取人电话：<?php echo $tel;?></p>
	<hr>
	<p>拾到地点：<?php echo $position;?></p>
	<p>拾到时间：<?php echo substr($time, 0,-3);?></p>
	<p>物品描述：<?php echo $detail;?></p>
	<hr>
	<p>通知状态：<?php echo $inform;?></p>
	<p>更改人：<?php echo $inform_change_person;?></p>
	<p>更改时间：<?php echo $inform_change_time;?></p>
	<hr>
	
	<p>领取状态：<?php echo $receive;?></p>
	<p>更改人：<?php echo $receive_change_person;?></p>
	<p>更改时间：<?php echo $receive_change_time;?></p>
	
	<hr>
	<h5>图片详情</h5>
	<img src="<?php echo base_url(); ?>uploads/example.jpg">

</div>