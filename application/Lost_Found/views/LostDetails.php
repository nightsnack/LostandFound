<div data-role="header">
	<h1>物品详细信息</h1>
</div>

<div data-role="main" class="ui-content detial_display">

	<h2>物品名称：<?php echo $item_name;?></h2>
	
	<a class="btn btn-default" href="<?php echo site_url("Lose/showUpdateLose/$item_id")?>" role="button"  style="display:<?php echo $display;?>;" >编辑</a>
	
	<hr>
	<p>物品类型：<?php echo $type;?></p>
	<p>拾取人学号：<?php echo $student_id;?></p>
    <p>拾取人姓名：<?php echo $release_name;?></p>
    <p>拾取人电话：<?php echo $tel;?></p>
	<hr>
	<p>拾到地点：<?php echo $position;?></p>
	<p>拾到时间：<?php echo $time?></p>
	<p>物品描述：<?php echo $detail;?></p>
	<hr>
	
	<p>找回状态：<?php echo $retrieve;?></p>
	<p>更改人：<?php echo $retrieve_change_person;?></p>
	<p>更改时间：<?php echo $retrieve_change_time;?></p>
	<form method="post" data-ajax="false" action="<?php echo $action;?>" style="display:<?php echo $display;?>;"> 
		<p>更改为：</p>
		<select name="retrieve_id" id="retrieve_id" >
		<?php foreach ($retrieve_select as $item): ?>
				<option value="<?php echo $item['retrieve_id'];?>"<?php if($item['name']==$retrieve) echo 'disabled=""';?>><?php echo $item['name'];?></option> 
		<?php endforeach; ?>
		</select>
		<input type="hidden" name="item_id" id="item_id" value="<?php echo $item_id; ?>">
        <input type="hidden" name="retrieve_change_person" id="retrieve_change_person" value="<?php echo $release_name; ?>">
        <input type="hidden" name="retrieve_change_time" id="retrieve_change_time" value="<?php echo date('Y-m-d H:i:s'); ?>">
        <button type="submit" id="submit">更新</button>
				
    </form>
	<hr>
	
	<h5>图片详情</h5>
	<img src="<?php echo base_url(); ?>uploads/example.jpg">

</div>

