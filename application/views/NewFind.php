<div data-role="header">
<h1>发布失物招领</h1>
</div>

<div data-role="main" class="ui-content">
<form method="post" data-ajax="false" action="<?php echo site_url('Find/insertNewFind') ?>">   <!-- ajax -->
	<fieldset class="ui-field-contain">
	    <p>姓名：</p>
		<input type="text" name="release_name" id="release_name" value="<?php echo $name;?>" readonly>
		<p>学号：</p>
		<input type="text" name="student_id" id="student_id" value="<?php echo $student_id;?>" readonly>
		<p>联系方式：</p>
		<input type="text" name="tel" id="tel" placeholder="联系方式"required>
		<p>物品类型：</p>
		<select name="category" id="category">
		<?php foreach ($view as $item): ?>
				<option value="<?php echo $item['category'];?>"><?php echo $item['name'];?></option>
		<?php endforeach; ?>
		</select>
		<p>物品名称：</p>
		<input type="text" name="item_name" id="item_name" placeholder="物品名称" required>
		<p>拾到地点：</p>
		<input type="text" name="position" id="position" placeholder="拾到地点（可不填）">
		<p>拾到时间：</p>
		<input type="text" name="time" id="time" placeholder="拾到时间（可不填）">
		<p>物品描述：</p>
		<textarea name="detail" id="detail" placeholder="物品描述（颜色/体积/重量/形状... 或在下方上传照片）" ></textarea>
		<p>图片详情：</p>
		<input type="file" name="uploadphotos">
	</fieldset>
	<input type="submit"  value="发布">
</form>
</div>

