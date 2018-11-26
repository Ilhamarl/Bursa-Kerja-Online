<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="https://raw.githubusercontent.com/Ilhamarl/Bursa-Kerja-AdminLTE/master/assets/dist/img/user2-160x160.png" class="img-circle"  alt="User Image">
			</div>
			<div class="pull-left info">
				
				<?php if( $this->ion_auth->logged_in() === TRUE ): ?>
				<p><?php echo get_name_by_session(); ?></p>
				<?php endif; ?>
				
				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>
		<!-- search form -->
		<form action="<?php echo site_url('search');?>" method="POST" class="sidebar-form">
			<div class="input-group">
				<input type="text" name="keyword" class="form-control" placeholder="Cari Lowongan..">
				<span class="input-group-btn">
					<button type="submit" value="search" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
					</button>
				</span>
			</div>
		</form>
		<!-- /.search form -->
		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu" data-widget="tree">
			<li class="header">DASHBOARD</li>
			<li class="">
				<a href="<?php echo site_url('dashboard')?>">
					<i class="fa fa-home"></i> <span>Home</span>
					
				</a>
			</li>
			
			<li class="header">USER NAVIGATION</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-clipboard"></i>
					<span>Jobs Info</span>
					<span class="pull-right-container">
						<span class="fa fa-angle-left pull-right"></span>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="<?php echo site_url('jobs')?>"><i class="fa fa-circle-o"></i>Lowongan</a></li>
					<li><a href="#"><i class="fa fa-circle-o"></i>Status</a></li>
				</ul>
			</li>
			
			<li class="">
				<a href="<?php echo site_url('industries')?>">
					<i class="fa fa-industry"></i>
					<span>Daftar Industri</span>
				</a>
			</li>
			
			<li class="">
				<a href="<?php echo site_url('depnaker')?>">
					<i class="fa fa-list"></i>
					<span>Lowongan Depnaker</span>
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