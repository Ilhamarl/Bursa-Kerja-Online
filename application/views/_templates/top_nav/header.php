<header class="main-header">
	<nav class="navbar navbar-static-top">
		<div class="container">
			<div class="navbar-header">
				<a id="typed-strings" href="<?php echo site_url('dashboard')?>" class="navbar-brand"><span class="SMKMbali_1_png"></span> <b>Bursa Kerja Online</b></a>
				<a id="typed" href="<?php echo site_url('dashboard')?>" class="navbar-brand"></a>
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
					<i class="fa fa-bars"></i>
				</button>
			</div>

			<!--Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="navbar-collapse">
				<ul class="nav navbar-nav navbar-right">
					<li class=""><a href="<?php echo site_url('jobs');?>">Lowongan<span class="sr-only">(current)</span></a></li>

					<li><a href="<?php echo site_url('industries');?>">Industri</a></li>

					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Katagori <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">

							<?php foreach ($katagori as $catagory){?>
								<li><a href="<?php echo site_url('catagories/catagory/'.$catagory->id);?>"><?php echo $catagory->name ;?></a></li>
								<li class="divider"></li>
							<?php } ?>
							<li><a href="<?php echo site_url('catagories');?>">Semua</a></li>
						</ul>
					</li>

					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Depnaker <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="<?php echo site_url('depnaker');?>">Lowongan SMK</a></li>
							<li class="divider"></li>
							<li><a href="<?php echo site_url('depnaker/yogyakarta');?>">Lowongan Yogyakarta</a></li>
						</ul>
					</li>
					<!--
					<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Menu <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
					<?php if ($this->ion_auth->logged_in())
					{
					echo '<li><a href="'. site_url('user') .'"><i class="fa fa-user"></i>Profile</a></li>';
				}
				else
				{
				echo '<li><a href="'. site_url('auth/register_user') .'"><i class="fa fa-user-plus"></i>Register</a></li>';
			}
			?>

			<li class="divider"></li>
			<?php if ($this->ion_auth->logged_in())
			{
			echo '<li><a href="'. site_url('auth/logout') .'"><i class="fa fa-sign-out"></i>Log Out</a></li>';
		}
		else
		{
		echo '<li><a href="'. site_url('auth/login') .'"><i class="fa fa-sign-in"></i> Login</a></li>';
	}
	?>
</ul>
</li>
-->
</ul>
<form action="<?php echo site_url('search');?>" method="POST" class="navbar-form navbar-right" role="search">
	<div class="form-group">
		<input type="text" name="keyword" class="form-control" id="navbar-search-input" placeholder="Cari Lowongan">
	</div>
</form>
</div>
<!-- /.navbar-collapse -->
</div>
<!-- /.container-fluid -->
</nav>
</header>
