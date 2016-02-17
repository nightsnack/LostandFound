<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
	<div class="row">
		<?php if (validation_errors()) : ?>
			<div class="col-md-12">
				<div class="alert alert-danger" role="alert">
					<?= validation_errors() ?>
				</div>
			</div>
		<?php endif; ?>
		<?php if (isset($error)) : ?>
			<div class="col-md-12">
				<div class="alert alert-danger" role="alert">
					<?= $error ?>
				</div>
			</div>
		<?php endif; ?>
		<div class="col-md-12">
			<div class="page-header">
				<h1>注册</h1>
			</div>
			<?= form_open() ?>
				<div class="form-group">
					<label for="username">用户名</label>
					<input type="text" class="form-control" id="username" name="username" >
					<p class="help-block">至少4个字符，仅限数字和字母</p>
				</div>
				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" class="form-control" id="email" name="email" >
					<p class="help-block">明确的邮箱地址</p>
				</div>
				<div class="form-group">
					<label for="password">密码</label>
					<input type="password" class="form-control" id="password" name="password" >
					<p class="help-block">至少6个字符</p>
				</div>
				<div class="form-group">
					<label for="password_confirm">确认密码</label>
					<input type="password" class="form-control" id="password_confirm" name="password_confirm" >
					<p class="help-block">必须与你输入的密码一致</p>
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-default" value="注册">
				</div>
			</form>
		</div>
	</div><!-- .row -->
</div><!-- .container -->