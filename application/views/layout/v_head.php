<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>SENDANG MULYA</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?= base_url() ?>template/plugins/fontawesome-free/css/all.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="<?= base_url() ?>template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet"
		href="<?= base_url() ?>template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<!-- SweetAlert2 -->
	<link rel="stylesheet" href="<?= base_url() ?>template/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= base_url() ?>template/dist/css/adminlte.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

	<!-- Modern UI Styles -->
	<style>
		:root {
			--primary: #dc3545;
			--secondary: #343a40;
			--accent: #28a745;
			--light: #f8f9fa;
			--dark: #212529;
		}

		body {
			font-family: 'Source Sans Pro', sans-serif;
			background-color: var(--light);
		}

		/* Layout */
		.modern-container {
			max-width: 1280px;
			margin: 0 auto;
			padding: 0 15px;
		}

		/* Components */
		.modern-navbar {
			background-color: white;
			box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
			padding: 0.5rem 1rem;
		}

		.modern-navbar .navbar-brand {
			font-weight: 700;
			color: var(--primary);
		}

		.modern-navbar .nav-link {
			color: var(--dark);
			transition: color 0.3s;
			font-weight: 500;
		}

		.modern-navbar .nav-link:hover {
			color: var(--primary);
		}

		.modern-navbar .dropdown-menu {
			border: none;
			box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
			border-radius: 8px;
		}

		.modern-navbar .navbar-collapse {
			align-items: center;
		}

		.modern-navbar .navbar-nav .nav-link {
			padding: 1rem 1rem;
			font-weight: 500;
		}

		.modern-navbar .form-inline .input-group {
			width: 100%;
			max-width: 300px;
		}

		.modern-card {
			border: none;
			border-radius: 12px;
			box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
			overflow: hidden;
			transition: transform 0.3s, box-shadow 0.3s;
		}

		.modern-card:hover {
			transform: translateY(-5px);
			box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
		}

		.modern-btn {
			border-radius: 6px;
			font-weight: 500;
			transition: transform 0.2s, box-shadow 0.2s;
		}

		.modern-btn:hover {
			transform: translateY(-2px);
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
		}

		/* Product Cards */
		.product-card {
			height: 100%;
		}

		.product-img-container {
			height: 220px;
			overflow: hidden;
		}

		.product-img {
			width: 100%;
			height: 100%;
			object-fit: cover;
		}

		.product-title {
			font-weight: 600;
			margin: 10px 0;
			height: 48px;
			overflow: hidden;
			display: -webkit-box;
			-webkit-line-clamp: 2;
			-webkit-box-orient: vertical;
		}

		.product-price {
			font-weight: 700;
			color: var(--dark);
			font-size: 1.25rem;
		}

		.product-category {
			position: absolute;
			top: 10px;
			right: 10px;
			background-color: var(--primary);
			color: white;
			padding: 5px 10px;
			border-radius: 30px;
			font-size: 0.8rem;
		}

		/* Hero Section */
		.hero-carousel .carousel-item img {
			height: 500px;
			object-fit: cover;
			width: 100%;
		}

		@media (max-width: 768px) {
			.hero-carousel .carousel-item img {
				height: 300px;
			}
		}

		/* Responsive */
		@media (max-width: 992px) {
			.modern-container {
				max-width: 100%;
			}
		}

		/* Additional modern components */
		.brand-logo {
			display: flex;
			align-items: center;
			justify-content: center;
			width: 40px;
			height: 40px;
		}

		.section-header {
			margin-bottom: 1.5rem;
			padding-bottom: 0.5rem;
			border-bottom: 1px solid rgba(0, 0, 0, 0.1);
		}

		.feature-icon {
			color: var(--primary);
			margin-bottom: 1rem;
		}

		.testimonial-section {
			background-color: var(--light);
			padding: 2rem 0;
			border-radius: 12px;
		}

		.category-header {
			background-color: var(--light);
			border-left: 4px solid var(--primary);
		}

		/* Improved carousel */
		.carousel-caption {
			background: rgba(0, 0, 0, 0.4);
			border-radius: 10px;
			padding: 20px;
		}

		.carousel-item img {
			object-position: center;
		}

		/* Search bar */
		.form-control:focus {
			box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
			border-color: var(--primary);
		}

		/* Responsive adjustments */
		@media (max-width: 991.98px) {
			.modern-navbar .navbar-collapse {
				padding: 1rem 0;
			}

			.modern-navbar .form-inline {
				width: 100%;
				margin: 0.5rem 0;
			}

			.modern-navbar .form-inline .input-group {
				width: 100%;
				max-width: none;
			}

			.modern-navbar .navbar-nav .nav-item {
				margin-bottom: 0.5rem;
			}
		}

		/* Search results page */
		.search-header {
			background-color: var(--light);
			border-left: 4px solid var(--primary);
		}
	</style>

	<!-- jQuery -->
	<script src="<?= base_url() ?>template/plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="<?= base_url() ?>template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- DataTables -->
	<script src="<?= base_url() ?>template/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url() ?>template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="<?= base_url() ?>template/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
	<script src="<?= base_url() ?>template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
	<!-- AdminLTE App -->
	<script src="<?= base_url() ?>template/dist/js/adminlte.min.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="<?= base_url() ?>template/dist/js/demo.js"></script>

</head>