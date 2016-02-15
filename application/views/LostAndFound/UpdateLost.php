<div data-role="header">
<h1>编辑失物招领</h1>
</div>

<div data-role="main" class="ui-content">

		<input type="text" name="release_name" id="release_name" value="<?php echo $release_name;?>" disabled="true">
		<input type="text" name="student_id" id="student_id" value="<?php echo $student_id;?>" disabled="true">
		
		<select name="category" id="category" disabled="true">
				<option value=""><?php echo $type;?></option>
		</select>
		
		
<form method="post" data-ajax="false" action="<?php echo site_url('LostAndFound/Lose/updateLose') ?>">   <!-- ajax -->
		<fieldset class="ui-field-contain">
		<p>联系方式：</p>
		<input type="text" name="tel" id="tel"  value="<?php echo $tel;?>" required>
		<hr>
		<p>物品名称：</p>
		<input type="text" name="item_name" id="item_name" value="<?php echo $item_name;?>" required>
		<p>丢失地点：</p>
		<input type="text" name="position" id="position" placeholder="拾到地点（可不填）" value="<?php echo $position;?>">
		<p>丢失时间：</p>
		<input type="text" name="time" id="time" placeholder="拾到时间（可不填）" value="<?php echo $time;?>">
		<p>物品描述：</p>
		<textarea name="detail" id="detail" placeholder="物品描述（颜色/体积/重量/形状... 或在下方上传照片）"><?php echo $detail;?></textarea>
		<p>图片详情：</p>
		<input type="file" name="uploadphotos">
	</fieldset>
	<input type="hidden" name="item_id" id="item_id" value="<?php echo $item_id; ?>">
	<button type="submit"  id="submit">提交</button>
</form>
</div>

