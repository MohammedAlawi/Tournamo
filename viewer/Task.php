
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Tasks</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="?site=Home">Home</a></li>
						<li class="breadcrumb-item active">Tasks</li>
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
				<h3 class="card-title">Required tasks</h3>
			</div>
			
			<div class="card-body">
				
				
				
                <ul class="todo-list" data-widget="todo-list">
					<?php
					$db = new MySQLDB();
					$sql  = "SELECT * FROM `task` WHERE `user_id` = '".$_SESSION['loginData']['id']."' order by time desc , order_task asc";
					$stmt = $db->prepare($sql);
					$stmt->setFetchMode(PDO::FETCH_ASSOC);
					$stmt->execute();
					$data = $stmt->fetchAll();
					
					for($i = 0; $i < count($data); $i++) {
						
						echo '
						
						<li>
							
							<span class="handle">
								<i class="fas fa-ellipsis-v"></i>
								<i class="fas fa-ellipsis-v"></i>
							</span>
							
							
							<div  class="icheck-primary d-inline ml-2">
								<input type="checkbox" id="task_'.$data[$i]['id'].'" data-task-id="'.$data[$i]['id'].'" '.($data[$i]['done'] == 1 ? 'checked' : '') .'>
								<label for="task_'.$data[$i]['id'].'"></label>
							</div>
							
							
							<span class="text">'.$data[$i]['title'].'</span>
							
							<small class="badge badge-primary"><i class="far fa-clock"></i> '.Time::time_left($data[$i]['time']).'</small>
							
							<div class="tools">
								<i data-task-id="'.$data[$i]['id'].'" class="fas fa-edit"></i>
								<i data-task-id="'.$data[$i]['id'].'" class="fas fa-trash"></i>
							</div>
						</li>
					  
						
						';
					}
					?>
                </ul>
              
				
				
			</div>
		</div>
		<!-- /.card -->

	</section>
	<!-- /.content -->
	
	<div class="modal fade" id="editModal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Show Task</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
				<h4>Title Task</h4>
				<p id="titleTask"></p>
				
				<h4>From</h4>
				<p id="fromTask"></p>
				
				<h4>Description Task</h4>
				<p id="descTask"></p>
				
				<h4>Time</h4>
				<p id="timeTask"></p>
				<!--<textarea class="textarea" placeholder="Place some text here"></textarea>-->
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
	
	<script src="style/js/jquery.min.js"></script>
	<script>
		$(function () {
			$('.textarea').summernote()
		})
	
		$('input:checkbox').on('click', function(){
			var $this = $(this);
			$.post( '?site=Home' , { type : 'updateTaskStatus', task_id : $this.data('taskId'), status: $this.prop('checked') }, 
				function( response ) {
					
				}
			);
		});
		
		$('.tools > .fas.fa-edit').on('click', function(){
			var $this = $(this);
			$.get('?ajax=getTaskById&id='+$this.data('taskId'),function(data){
				$("#titleTask").text(data['title']);
				$("#fromTask").text(data['from']);
				$("#descTask").text(data['desc']);
				$("#timeTask").text(data['time']);
			},'json');
			$('#editModal').modal('show');
			
		});
		
		$('.tools > .fas.fa-trash').on('click', function(){
			var $this = $(this);
			
		});
	</script>