<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="https://raw.githubusercontent.com/Ilhamarl/Bursa-Kerja-AdminLTE/master/assets/images/SMKMbali.png" class="img" height="50" width="50" alt="Admininstrator">
			</div>
			<div class="pull-left info">
				<p>Admininstrator</p>
				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>

			</div>
		</div>

		<ul class="sidebar-menu" data-widget="tree">
			<li class="header">DASHBOARD</li>
			<li class="">
				<a href="<?php echo site_url('dashboard')?>">
					<i class="fa fa-home"></i> <span>Home</span>

				</a>
			</li>
			<li class="header">ADMIN NAVIGATION</li>

			<li class="treeview">
				<a href="">
					<i class="fa fa-clipboard"></i>
					<span>Lowongan</span>
					<span class="pull-right-container">
						<span class="fa fa-angle-left pull-right"></span>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="<?php echo site_url('job')?>"><i class="fa fa-circle-o"></i>Lowongan Terbaru</a></li>
					<li><a href="<?php echo site_url('depnaker')?>"><i class="fa fa-circle-o"></i>Lowongan Depnaker</a></li>
				</ul>
			</li>

			<li class="treeview">
				<a href="">
					<i class="fa fa-flag"></i>
					<span>Katagori</span>
					<span class="pull-right-container">
						<span class="fa fa-angle-left pull-right"></span>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="<?php echo site_url('catagories')?>"><i class="fa fa-circle-o"></i>Daftar katagori</a></li>
					<li><a href="<?php echo site_url('admin/catagories')?>"><i class="fa fa-circle-o"></i>Katagori Lowongan</a></li>
				</ul>
			</li>

			<li class="treeview">
				<a href="">
					<i class="fa fa-industry"></i>
					<span>Industri</span>
					<span class="pull-right-container">
						<span class="fa fa-angle-left pull-right"></span>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="<?php echo site_url('industries')?>"><i class="fa fa-circle-o"></i>Daftar Industri</a></li>
					<li><a href="<?php echo site_url('industries/add'); ?>"><i class="fa fa-circle-o"></i>Tambah Industri</a></li>
				</ul>
			</li>

			<li class="treeview">
				<a href="#">
					<i class="fa fa-user"></i>
					<span>Siswa</span>
					<span class="pull-right-container">
						<span class="fa fa-angle-left pull-right"></span>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="<?php echo site_url('admin/users')?>"><i class="fa fa-circle-o"></i>Daftar Siswa</a></li>
					<li><a href="<?php echo site_url('admin/create_user')?>"><i class="fa fa-circle-o"></i>Buat Akun Baru</a></li>
				</ul>
			</li>

			<li class="">
				<a href="<?php echo site_url('admin/list_groups')?>">
					<i class="fa fa-group"></i>
					<span>Jenis Pengguna</span>
				</a>
			</li>

			<li class="header">SETTINGS</li>
			<li class="">
				<a href="<?php echo site_url('admin/settings')?>">
					<i class="fa fa-gear"></i>
					<span>Pengaturan</span>
				</a>
			</li>

			<li>
				<a href="<?php echo site_url('auth/logout')?>">
					<i class="fa fa-sign-out"></i> <span>Log Out</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- /.sidebar -->
</aside>
