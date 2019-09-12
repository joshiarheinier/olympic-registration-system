<div class="page-container">
	<div id="register">
		<div class="card credential-form" id="register-form">
			<h2>Halo Kontingen!</h2>
			<h4>Daftar Kontingen</h4>
			<div id="error-msg">
			<?php
			if (isset($_SESSION["err_msg"])) {
				echo "<p>".$_SESSION["err_msg"]."</p>";
				unset($_SESSION['err_msg']);
			}
			?>
			</div>
			<form action="<?= base_url();?>user/register/process" method="post">
				<h4>Fakultas</h4>
				<select name="faculty">
					<?php
					foreach ($faculties->result() as $row) {
						echo "<option value='".$row->name."'>".$row->name."</option>";
					}
					?>
				</select>
				<h4>Username</h4>
				<input type="text" name="username">
				<h4>Nama Lengkap</h4>
				<input type="text" name="display_name">
				<h4>Password</h4>
				<input type="password" name="password">
				<h4>Email</h4>
				<input type="text" name="email">
				<h4>Nomor HP</h4>
				<input type="text" name="phone">
				<h4>Token Verifikasi</h4>
				<input type="text" name="token">
				<input type="submit" value="MASUK">
			</form>
		</div>
	</div>
</div>
<link href="<?= base_url();?>public/assets/css/credential.css" rel="stylesheet">