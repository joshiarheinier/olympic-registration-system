<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Olimpiade UI 2018</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBMtXfN1c4OYZ5q2K46ecJKou0WcxQxlk0"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="//netdna.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap-glyphicons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link href="<?= base_url();?>public/assets/css/main.css" rel="stylesheet">
</head>
<body>
<div id="menu" class="visible-sm visible-md visible-lg">
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<a class="navbar-left">
			</a>
			<div class="navbar-header">
  				<a class="navbar-brand" href="/"></a>
			</div>
			<ul class="nav navbar-nav navbar-right">
  				<li><a href="<?= base_url(); ?>#about">Tentang Olimpiade UI</a></li>
            	<?php
            	if (isset($_SESSION["session_hash"])) {
                    if (isset($_SESSION["username"])) {
                        echo '<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Welcome, '.$this->session->userdata('username').'!<span class="caret"></span></a><ul class="dropdown-menu">
                            <li><a href="'.base_url().'user/profile">Dashboard</a></li><li><a href="'.base_url().'user/logout">Logout</a></li></ul></li>';
                    } elseif (isset($_SESSION["adm"])) {
                        echo '<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Welcome, '.$this->session->userdata('adm').'!<span class="caret"></span></a><ul class="dropdown-menu">
                            <li><a href="'.base_url().'admin/official/dashboard">Dashboard</a></li><li><a href="'.base_url().'admin/official/logout">Logout</a></li></ul></li>';
                    }
            	} else {
            		echo '<li><a href="'.base_url().'user/login">Masuk</a></li><li><a href="'.base_url().'user/register">Daftar</a></li>';
            	}
            	?>
			</ul>
		</div>
	</nav>
</div>