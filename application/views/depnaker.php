<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo $title;?> <small></small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active"><?php echo $title;?></li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->


		<?php
			function bacaHTML($url){
				// inisialisasi CURL
				$data = curl_init();
				// setting CURL
				curl_setopt($data, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($data, CURLOPT_URL, $url);
				// menjalankan CURL untuk membaca isi file
				$hasil = curl_exec($data);
				curl_close($data);
				return $hasil;
			}

			//mengambil data dari kompas
			$bacaHTML = bacaHTML("http://bursakerjadepnaker.com/category/smk");

			//membuat dom dokumen
			$dom = new DomDocument();

			//mengambil html dari kompas untuk di parse
			@$dom->loadHTML($bacaHTML);

			//nama class yang akan dicari
			$classname="blog-post";

			//mencari class memakai dom query
			$finder = new DomXPath($dom);
			$spaner = $finder->query("//*[contains(@class, '$classname')]");

			//mengambil data dari class yang pertama
			$span = $spaner->item(0);

			//dari class pertama mengambil 2 elemen yaitu a yang menyimpan judul dan link dan span yang menyimpan tanggal
			$link =  $span->getElementsByTagName('h2');
			$tanggal = $span->getElementsByTagName('span');
			$no = 0;

			//persiapkan array untuk diambil datanya
			$data =array();
			foreach ($link as $val){
				$data[] = array(
				'judul' => $link->item($no)->nodeValue,
				'tanggal' => $tanggal->item($no)->nodeValue,
				);
				$no++;
			}
		?>
		<div class="row">
			<div class="col-xs-12">
				<div id="infoMessage">
					<h4></h4>
				</div>
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Data Lowongan</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<div class="table-responsive no-padding">
							<table id="example1" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th>No.</th>
										<th>Daftar Lowongan</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no=1;
									foreach($data as $val)
									{
										?>
										<tr>
											<td><?php echo $no;?></td>
											<td><a href="http://bursakerjadepnaker.com/category/smk" target="_blank"><?php echo $val['judul'];?><a></td>

													</tr>
													<?php
													$no++;
												}
												?>
											</tbody>
										</table>
										<!--<p><?php echo anchor('auth/create_user', lang('index_create_user_link'))?> | <?php echo anchor('auth/create_group', lang('index_create_group_link'))?></p>
										<p><?php echo anchor('auth/logout', 'Log out')?></p>-->
									</div>
								</div>
								<!-- /.box-body -->
								<div class="box-footer clearfix">
								</div>
							</div>
							<!-- /.box -->
						</div>
					</div>


					<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
				</section>
				<!-- /.content -->
			</div>
			<!-- /.content-wrapper -->
