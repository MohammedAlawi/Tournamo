	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Documents</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="?site=Home">Home</a></li>
						<li class="breadcrumb-item active">Documents</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">

		<!-- Default box -->
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">My Documents</h3>
				<div class="float-right">
					<button type="button" class="btn btn-block bg-gradient-info btn-sm" data-toggle="modal" data-target="#upload">Upload File</button>
				</div>
			</div>
			
			<div class="card-body">
			
				<div class="row d-flex align-items-stretch">
					
					<?php
					
					$db = new MySQLDB();
					$sql  = "SELECT * FROM `files` WHERE `user_id` = '".$_SESSION['loginData']['id']."'";
					$stmt = $db->prepare($sql);
					$stmt->setFetchMode(PDO::FETCH_ASSOC);
					$stmt->execute();
					$data = $stmt->fetchAll();
					
					
					
					for($i = 0; $i < count($data); $i++) {
						if(is_file(PATH_UPLOAD.$data[$i]['file_name'])){
							$typeFile = getTypeFile($data[$i]['file_name']);
							if($typeFile == 'img'){
								$type = '<span class="mailbox-attachment-icon has-img"><img src="'.PATH_UPLOAD.$data[$i]['file_name'].'" alt="Attachment" style="max-height: 132.5px;max-width: 100%;"></span>';
							} else {
								$type = '<span class="mailbox-attachment-icon"><i class="far fa-file-'.$typeFile.'"></i></span>';
							}
							echo '
							<div class="col-12 col-sm-6 col-md-3 d-flex align-items-stretch">
								<div class="card bg-light"  style="width: 100%">
									
									<div class="card-body pt-0">
										'.$type.'
										
										 <div class="mailbox-attachment-info">
											'.$data[$i]['file_upload'].'
											<span class="mailbox-attachment-size clearfix mt-1">
												<span>'.formatSizeUnits(filesize(PATH_UPLOAD.$data[$i]['file_name'])).'</span>
											</span>
										</div>
									</div>
									
									<div class="card-footer">
										<div class="text-right">
											<a class="btn btn-sm bg-primary" data-name="'.$data[$i]['file_name'].'" data-dName="'.$data[$i]['file_upload'].'">
												<i class="fas fa-download"></i>
											</a>
											<a class="btn btn-sm btn-danger" style="color: #fff;">
												<i class="fas fa-trash"></i>
											</a>
										</div>
									</div>
								</div>
							</div>
							
							';
							
						}
					}
					?>
					
				</div>
				
			</div>
		</div>
		<!-- /.card -->

	</section>
	<!-- /.content -->
	
	
	<div class="modal fade" id="upload">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Upload</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				
				<div class="modal-body">
					
					<div class="alert alert-success" id="showSucc" style="display: none;">The file has been uploaded successfully</div>
					
					<form role="form">
						<div class="card-body">
							
							<div class="form-group">
								<label for="exampleInputFile">File input</label>
								<div class="input-group">
									<div class="custom-file">
										<input type="file" class="custom-file-input" id="customFile">
										<label class="custom-file-label" for="customFile">Choose file</label>
									</div>
									
									
									<div class="input-group-append">
										<span class="input-group-text" id="uploadBtn">Upload</span>
									</div>
								</div>
							</div>
						</div>
					</form>
					
				</div>
				
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	
	
	<script src="style/js/jquery.min.js"></script>
	<script src="style/js/bs-custom-file-input.min.js"></script>
	<script>
		$(document).ready(function () {
			bsCustomFileInput.init();
		});
		$('.text-right > .btn.btn-sm.bg-primary').on('click', function(){
			var $this = $(this);
			// $.get( '?download='+$this.data('name') );
			document.location = '?download='+$this.data('name')+'&dName='+$this.data('dname');
		});
		
		
		
		$('#uploadBtn').click(function(){
			$("#showSucc").hide();
			var file_data = $('#customFile').prop('files')[0];   
			var form_data = new FormData();                  
			form_data.append('file', file_data);
			form_data.append('type', 'uploadFile');
			
			$.ajax({
				url: '?site=Home', // point to server-side PHP script 
				dataType: 'text',  // what to expect back from the PHP script, if anything
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,                         
				type: 'post',
				success: function(response){
					if(response == 'True')
						$("#showSucc").show();
				}
			 });
		});
		
	</script>