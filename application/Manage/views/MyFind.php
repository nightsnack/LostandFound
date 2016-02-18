<?php $this->load->view("templates/manageheader");?>

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
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
								<th class="with-checkbox">
                                        <input type="checkbox" name="checkedAll" id="checkedAll"/>
                               </th>
                                   <?php foreach ($res[0] as $list_head => $list_item): ?>
                                      <th><?php echo $list_head?></th>
                                   <?php endforeach; ?>
                                </tr>
							</thead>
							<tbody>
                     <?php foreach ($res as $item_detail): ?>
                      <tr>
                        <td class="with-checkbox">  <input type="checkbox" name="checkbox_name[]" value="<?php echo $item_detail["物品编号"]?>">  </td>
                      <?php foreach ($item_detail as $item): ?>
                        <td><?php echo $item?></td>
                        <?php endforeach; ?>
                      </tr>
                      <?php endforeach; ?>
                    </tbody>
						</table>
					</div>
					<!-- /.box-body -->

					<div class="dataTables_paginate"
						id="example1_paginate"   style="float:right;">
                       <?php echo $page;?>
					</div>

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
      