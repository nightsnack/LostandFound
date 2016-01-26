<div data-role="header">
<h1>发布失物招领</h1>
</div>

<div data-role="main" class="ui-content">
<form method="post" action="#">
	<fieldset class="ui-field-contain">
		<input type="text" name="name" id="name" placeholder="姓名" required>
		<input type="text" name="studentID" id="studentID" placeholder="学号" required>
		<input type="text" name="cellphone" id="cellphone" placeholder="联系方式"required>
		<select name="category" id="category">
		<?php foreach ($view as $item): ?>
				<option value="<?php echo $item['value'];?>"><?php echo $item['name'];?></option>

		<?php endforeach; ?>
		</select>
		<input type="text" name="propertyName" id="propertyName" placeholder="物品名称" required>
		<input type="text" name="pickupLocation" id="pickupLocation" placeholder="拾到地点（可不填）">
		<input type="text" name="pickupTime" id="pickupTime" placeholder="拾到时间（可不填）">
		<textarea name="propertyinfo" id="propertyinfo" placeholder="物品描述（颜色/体积/重量/形状... 或在下方上传照片）" ></textarea>
		<input type="file" name="uploadPhotos">
	</fieldset>
	<input type="submit" value="发布">
</form>
</div>

