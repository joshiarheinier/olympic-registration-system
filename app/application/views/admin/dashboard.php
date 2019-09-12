<div class="page-container">
	<div id="profile" class="excluded">
		<h1><u>Admin Dashboard</u></h1>
		<div class="row">
			<div class="col-lg-4 col-md-4">
				<div class="card" id="entry-number-prompt" style="">
					<h4>Lihat Entry Number</h4>
					<form action="<?= base_url();?>admin/official/entry/number/view" method="post">
						<select name="faculty">
							<?php
							foreach ($faculties->result() as $row) {
								echo "<option value='".$row->name."'>".$row->name."</option>";
							}
							?>
						</select>
						<br>
						<br>
						<br>
						<button type="submit" class="btn btn-info btn-lg">Lihat Data</button>
					</form>
				</div>
			</div>
			<div class="col-lg-4 col-md-4">
				<div class="card" id="entry-name-prompt" style="">
					<h4>Lihat Entry Name</h4>
					<form action="<?= base_url();?>admin/official/entry/name/view" method="post">
						<select name="faculty">
							<?php
							foreach ($faculties->result() as $row) {
								echo "<option value='".$row->name."'>".$row->name."</option>";
							}
							?>
						</select>
						<select name="sport_name">
							<?php
							foreach ($sports->result() as $row) {
								echo "<option value='".$row->name."'>".$row->name."</option>";
							}
							?>
						</select>
						<br>
						<br>
						<button type="submit" class="btn btn-info btn-lg">Lihat Data</button>
					</form>
				</div>
			</div>
			<div class="col-lg-4 col-md-4">
				<div class="card" id="entry-official-prompt" style="">
					<h4>Lihat Entry Name (Official)</h4>
					<form action="<?= base_url();?>admin/official/entry/official/view" method="post">
						<select name="faculty">
							<?php
							foreach ($faculties->result() as $row) {
								echo "<option value='".$row->name."'>".$row->name."</option>";
							}
							?>
						</select>
						<select name="category">
							<?php
							foreach ($categories->result() as $row) {
								echo "<option value='".$row->category."'>".$row->category."</option>";
							}
							?>
						</select>
						<br>
						<br>
						<button type="submit" class="btn btn-info btn-lg">Lihat Data</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<link href="<?= base_url();?>public/assets/css/profile.css" rel="stylesheet">