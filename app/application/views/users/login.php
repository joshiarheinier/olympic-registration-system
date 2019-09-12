<div class="page-container">
	<div id="login">
		<div class="card credential-form" id="login-form">
			<h2>Halo Kontingen!</h2>
			<h4>Kontingen Login</h4>
			<div id="error-msg">
			<?php
			if (isset($_SESSION["err_msg"])) {
				echo "<p>".$_SESSION["err_msg"]."</p>";
				unset($_SESSION['err_msg']);
			}
			?>
			</div>
			<form action="<?= base_url();?>user/login/process" method="post">
				<h4>Username</h4>
				<input type="text" name="username">
				<h4>Password</h4>
				<input type="password" name="password">
				<input type="submit" value="MASUK">
			</form>
		</div>
	</div>
</div>
<link href="<?= base_url();?>public/assets/css/credential.css" rel="stylesheet">