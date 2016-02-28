<?php $this->load->view("templates/manageheader");?>
<script type="text/javascript" src="<?php echo base_url("assets/js/table.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/jquery.pagination.js"); ?>"></script>
<link rel="stylesheet" href="<?= base_url('assets/css/pagination.css') ?>">
    
<script id="entry-template" type="text/x-handlebars-template">
<thead>
	<tr>
		<th class="with-checkbox"><input type="checkbox" name="checkedAll" id="checkedAll" /></th>
			{{#each res.[0]}}  {{!-- 这种奇葩的数组访问方式我还是第一次见 --}}
            <th>{{@key}}</th>
            {{/each}}
            <th>操作</th>
	</tr>
</thead>
<tbody>
	{{#each res}}
	<tr>
		<td class="with-checkbox"><input type="checkbox" name="checkbox_name[]" value="{{this.物品编号}}"></td> 
		{{#each this}}
		<td>{{this}}</td>
		{{/each}}
		<td>
		<a href="" data-toggle="modal" data-target="#myModal" data-user="{{this.物品编号}}"><i class="fa fa-edit"></i></a> 
		<a href="javascript:void(0)" class="btn" rel="tooltip" title="Delete" attr="delgoods_{{this.物品编号}}"><i class="fa fa-trash"></i></a>
		</td>
	</tr>
	{{/each}}
</tbody>
</script>

<!-- 模态框（Modal） -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">更改详情</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<input type="text" class="form-control" name="release_name"
						id="release_name" value="" disabled> <input type="text"
						class="form-control" name="student_id" id="student_id" value=""
						disabled> <input type="text" class="form-control" id="type"
						value="" disabled> <label for="tel">联系方式：</label> <input
						class="form-control" type="text" name="tel" id="tel" value=""
						required>
					<hr>
					<label>物品名称：</label> <input class="form-control" type="text"
						name="item_name" id="item_name" value="" required> <label>拾到地点：</label>
					<input class="form-control" type="text" name="position"
						id="position" placeholder="拾到地点（可不填）" value=""> <label>拾到时间：</label>
					<input class="form-control" type="text" name="time" id="time" placeholder="拾到时间（可不填）" value="">
					<label>物品描述：</label>
					<textarea class="form-control" name="detail" id="detail" placeholder="物品描述（颜色/体积/重量/形状... 或在下方上传照片）"></textarea>
					<label>图片详情：</label> 
					<img alt="物品详情" src="http://www.runoob.com/wp-content/themes/runoob/assets/img/runoob-logo@2x.png">
					<input class="form-control" type="hidden" name="item_id" id="item_id" value="">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">关闭
				</button>
				<button type="button" class="btn btn-primary">提交更改</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal -->
</div>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			失物招领 <small>详细列表</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i>控制台</a></li>
			<li><a href="#">失物招领</a></li>
			<li class="active">招领启事</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">

				<div class="box">
					<div class="box-header">
						<h3 class="box-title">我的招领启事</h3>
					</div>

					<!-- /.box-header -->
					<div class="box-body">
						<table id="table1" class="table table-bordered table-striped">

						</table>
					</div>
					<!-- /.box-body -->

						<div class="tcdPageCode"></div>

				</div>
				<!-- /.box -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php $this->load->view("templates/managefooter");?>
      