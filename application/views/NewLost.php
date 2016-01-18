  <div data-role="header">
    <h1>发布寻物启事</h1>
  </div>

<div data-role="main" class="ui-content">
<form method="post" action="#">
	<fieldset class="ui-field-contain">
		<input type="text" name="name" id="name" placeholder="姓名" required>
		<input type="text" name="studentID" id="studentID" placeholder="学号" required>
		<input type="text" name="cellphone" id="cellphone" placeholder="联系方式"required>
		<select name="category" id="category">
				<option value="Cards">校园卡/其他证件</option>
				<option value="StorageDevices">U盘/其他存储设备</option>
				<option value="Cellphones">手机/平板/笔记本</option>
				<option value="CamerasAndOthers">相机/其他数码产品</option>
				<option value="Cards">校园卡/其他证件</option>
				<option value="Bags">钱包/书包/其他箱包</option>
				<option value="Books">书刊杂志</option>
				<option value="Clothes">衣物鞋帽</option>
				<option value="Others">其他</option>
		</select>
		<input type="text" name="propertyName" id="propertyName" placeholder="物品名称" required>
		<input type="text" name="pickupLocation" id="pickupLocation" placeholder="丢失地点（可不填）">
		<input type="text" name="pickupTime" id="pickupTime" placeholder="丢失时间（可不填）">
		<textarea name="propertyinfo" id="propertyinfo" placeholder="物品描述（颜色/体积/重量/形状... 或在下方上传照片）" ></textarea>
		<input type="file" name="uploadPhotos">
	</fieldset>
	<input type="submit" value="发布">
</form>
</div>

