<header class="main-header">
	<!-- Logo -->
	<a href="<?php echo site_url('dashboard')?>" class="logo">
		<!-- mini logo for sidebar mini 50x50 pixels -->
		<span class="logo-mini"><b>B</b>K</span>
		<!-- logo for regular state and mobile devices -->
		<span class="logo-lg"><b>Bursa </b>KERJA</span>
	</a>
	<!-- Header Navbar: style can be found in header.less -->
	<nav class="navbar navbar-static-top">
		<!-- Sidebar toggle button-->
		<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
			<span class="sr-only">Toggle navigation</span>
		</a>
		
		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<!-- User Account: style can be found in dropdown.less -->
				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img src="https://raw.githubusercontent.com/Ilhamarl/Bursa-Kerja-AdminLTE/master/assets/dist/img/user2-160x160.png" class="user-image"  alt="User">
						<span class="hidden-xs">
							<?php if( $this->ion_auth->logged_in() === TRUE ): ?>
							<?php echo get_name_by_session(); ?>
							<?php endif; ?>
						</span>
					</a>
					<ul class="dropdown-menu">
						<!-- User image -->
						<li class="user-header">
							<img src="https://raw.githubusercontent.com/Ilhamarl/Bursa-Kerja-AdminLTE/master/assets/dist/img/user2-160x160.png" class="img-circle"  alt="User">
							<p>	
								<?php if( $this->ion_auth->logged_in() === TRUE ): ?>
								<?php echo get_name_by_session(); ?>
								<small>Last login : <?php echo tanggal_waktu(get_last_login()); ?></small>
								<?php endif; ?>
							</p>
						</li>
						<!-- Menu Body --
							<li class="user-body">
							<div class="row">
							<div class="col-xs-4 text-center">
							<a href="#">Followers</a>
							</div>
							<div class="col-xs-4 text-center">
							<a href="#">Sales</a>
							</div>
							<div class="col-xs-4 text-center">
							<a href="#">Friends</a>
							</div>
							</div>
						</li><!-- /.row -->
						<!-- Menu Footer-->
						<li class="user-footer">
							<div class="pull-left">
								<a href="<?php echo site_url('user/data_user')?>" class="btn btn-default btn-flat">Pengaturan</a>
							</div>
							<div class="pull-right">
								
								<a href="<?php echo site_url('auth/logout')?>" class="btn btn-default btn-flat">Log Out</a>
							</div>
						</li>
					</ul>
				</li>
				<!-- Control Sidebar Toggle Button
					<li>
					<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
				</li>  -->
			</ul>
		</div>
	</nav>
</header>