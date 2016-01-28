<div data-role="header">
	<h1>物品详细信息</h1>
</div>

<div data-role="main" class="ui-content detial_display">

	<h2>物品名称：<?php echo $item_name;?></h2>
	
	<a class="btn btn-default" href="<?php echo site_url("Find/showUpdateFind/$item_id")?>" role="button"  style="display:<?php echo $display;?>;" >编辑</a>
	
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
	
	<p>通知状态：<?php echo $inform;?></p>
	<p>更改人：<?php echo $inform_change_person;?></p>
	<p>更改时间：<?php echo $inform_change_time;?></p>
	<form method="post" data-ajax="false" action="<?php echo $action;?>" style="display:<?php echo $display;?>;"> 
		<select name="inform_id" id="inform_id" >
		<?php foreach ($inform_select as $item): ?>
				<option value="<?php echo $item['inform_id'];?>"<?php if($item['name']==$inform) echo 'selected = "selected" disabled=""';?>><?php echo $item['name'];?></option> 
		<?php endforeach; ?>
		</select>
		<input type="hidden" name="item_id" id="item_id" value="<?php echo $item_id; ?>">
        <button type="submit" id="submit" <?php if ($receive !== '未领取')  echo ' disabled=""';?>>更新</button>
    </form>
	<hr>
	
	<p>领取状态：<?php echo $receive;?></p>
	<p>更改人：<?php echo $receive_change_person;?></p>
	<p>更改时间：<?php echo $receive_change_time;?></p>
	<form method="post" data-ajax="false" action="<?php echo $action;?>" style="display:<?php echo $display;?>;"> 
		<select name="receive_id" id="receive_id" >
		<?php foreach ($receive_select as $item): ?>
				<option value="<?php echo $item['receive_id'];?>"<?php if($item['name']==$receive) echo 'selected = "selected" disabled=""';?>><?php echo $item['name'];?></option> 
		<?php endforeach; ?>
		</select>
				<input type="hidden" name="item_id" id="item_id" value="<?php echo $item_id; ?>">
            <button type="submit" id="submit" <?php if ($inform === '未通知')  echo ' disabled=""';?>>
           <?php if ($inform === '未通知')  echo '请先通知'; else echo "更新";?>
           </button>
    </form>
	<hr>
	
	<h5>图片详情</h5>
	<img src="<?php echo base_url(); ?>uploads/example.jpg">

</div>

