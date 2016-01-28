<div data-role="header">
<h1>发布失物招领</h1>
</div>

<div data-role="main" class="ui-content">
<form method="post" data-ajax="false" action="<?php echo site_url('Find/insertNewFind') ?>">   <!-- ajax -->
	<fieldset class="ui-field-contain">
		<input type="text" name="release_name" id="release_name" placeholder="<?php echo $name;?>" disabled="true">
		<input type="text" name="student_id" id="student_id" placeholder="<?php echo $student_id;?>" disabled="true">
		<input type="text" name="tel" id="tel" placeholder="联系方式"required>
		<select name="category" id="category">
		<?php foreach ($view as $item): ?>
				<option value="<?php echo $item['category'];?>"><?php echo $item['name'];?></option>
		<?php endforeach; ?>
		</select>
		<input type="text" name="item_name" id="item_name" placeholder="物品名称" required>
		<input type="text" name="position" id="position" placeholder="拾到地点（可不填）">
		<input type="text" name="time" id="time" placeholder="拾到时间（可不填）">
		<textarea name="detail" id="detail" placeholder="物品描述（颜色/体积/重量/形状... 或在下方上传照片）" ></textarea>
		<input type="file" name="uploadphotos">
	</fieldset>
	<input type="submit"  value="发布">
</form>
</div>

