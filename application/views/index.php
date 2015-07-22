<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="华农生活助手">
    <meta name="author" content="zhongshan">
    <!-- <link rel="shortcut icon" href="assets/ico/favicon.png"> -->
	<title>华农生活</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/css/main.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">
    
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    
    <!-- <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic' rel='stylesheet' type='text/css'> -->
    <!-- <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,700' rel='stylesheet' type='text/css'> -->
    
    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/smoothscroll.js"></script> 
    <script src="<?php echo base_url(); ?>assets/js/Chart.js"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
      <script src="assets/js/respond.min.js"></script>
    <![endif]-->
</head>
<body data-spy="scroll" data-offset="0" data-target="#nav">
    <div id="section-topbar">
		<div id="topbar-inner">
			<div class="container">
				<div class="row">
					<div class="dropdown">
						<ul id="nav" class="nav">
							<li class="menu-item"><a class="smoothScroll" href="#about" title="回到顶部"><i class="fa fa-angle-up fa-2x"></i></a></li>
							<li class="menu-item"><a class="smoothScroll" href="#lost-found" title="失物招领"><i class="fa fa-bullhorn fa-2x"></i></a></li>
							<li class="menu-item"><a class="smoothScroll" href="#service" title="生活服务"><i class="fa fa-server fa-2x"></i></a></li>
							<li class="menu-item"><a class="smoothScroll" href="#contact" title="联系我"><i class="fa fa-envelope-o fa-2x"></i></a></li>
						</ul><!--/ uL#nav -->
					</div><!-- /.dropdown -->
					<div class="clear"></div>
				</div><!--/.row -->
			</div><!--/.container -->

			<div class="clear"></div>
		</div><!--/ #topbar-inner -->
	</div><!--/ #section-topbar -->
	
	<section id="about" name="about"></section>
	<div id="headerwrap">
		<div class="container">
			<div class="row centered">
				<!-- <div class="col-lg-12">
					<h1>华农生活</h1>
					<h3>Life in HZAU</h3>
				</div> --><!--/.col-lg-12 -->
			</div><!--/.row -->
		</div><!--/.container -->
	</div><!--/.#headerwrap -->
	

	
	
	<section id="work" name="lost-found"></section>
	<!--失物招领开始 -->
	<div class="container desc">
		<h2><i class="fa fa-bullhorn fa-lg"></i>&nbsp;失物/寻物</h2>
		
		<!-- 发布失物信息开始 -->
		<button type="button" class="release btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#exampleModal">发 布 失 物 招 领 信 息</button>
		<!-- 发布失物信息结束 -->

		<!-- 失物招领内容部分开始 -->
		<div class="lost-found-all">
			<?php foreach($goods as $item): ?>
			<div class="row">
				<div class="lost-item" style="margin:0 auto;">
					<div class="col-lg-2 col-lg-offset-1">
						<span class="lost-title"><b class="lost-title-type"><?php echo $item->type; ?> |</b><?php echo $item->title; ?></span>
					</div>
					<div class="col-lg-6">
						<p><img class="img-responsive" src="<?php if(empty($item->image)){echo base_url().'assets/img/header-bg.jpg';}else{echo base_url().'uploads/'.$item->image;} ?>" alt="<?php echo $item->title; ?>"></p>
					</div>
					<div class="col-lg-3 lost-content">
						<p>
							<b class="lost-content-title">#<?php echo $item->type; ?>#</b>
						</p>
						<p>
							<more >
								<p class="lost-content-article">
									<?php echo $item->content; ?>
								</p>
								<br/>
								<p class="lost-content-phone">
									<i class="fa fa-mobile-phone fa-lg"></i>
									<a href="tel://<?php echo $item->tel; ?>"><?php echo $item->tel; ?></a>
								</p>
								<p class="lost-content-time">
									<i class="fa fa-clock-o fa-lg"></i>
									<span><?php echo $item->createtime; ?></span>
								</p>
							</more> 
						</p>
					</div>
					
				</div>
				<hr>
			</div>
			<?php endforeach; ?>
			
		</div>
		<!-- 失物招领内容部分结束 -->
		<!-- 查看更多 -->
		<a class="release btn btn-primary btn-lg btn-block" href="<?php echo site_url('goods/index'); ?>">查 看 更 多 >></a>
		<!-- 查看更多结束 -->
	</div>
	<!-- 失物招领结束 -->
	
	<section id="service" name="service"></section>
	<div class="container desc">
		<h2><i class="fa fa-server fa-lg"></i>&nbsp;生活服务</h2>
		<!-- 自习室查询开始 -->
		<div class="classroom">
			<div class="classroom-title">
				<h4><i class="fa fa-building-o"></i>&nbsp;自习室查询</h4>
			</div>
			<div class="classroom-condition">
				<form class="form-horizontal" role="form" action="<?php echo site_url('jiaowu/roomresult'); ?>" method="get">
		          <div class="form-group">
		            <!-- <label for="start" class="room-label">查询时间</label> -->
		            <select class="form-control" id="start" name="start">
		            	<option value="">查询时间</option>
		              	<!-- 查询时间抓取 -->
		              	<?php echo $roomSearchOption; ?>
		            </select>
		          </div>
		          <div class="form-group">
		            <select class="form-control" id="class" name="class">
		              <option selected="selected" value="'1'|'1','0','0','0','0','0','0','0','0'">第1,2节</option>
		              <option value="'2'|'0','3','0','0','0','0','0','0','0'">第3,4节</option>
		              <option value="'3'|'0','0','5','0','0','0','0','0','0'">第5,6节</option>
		              <option value="'4'|'0','0','0','7','0','0','0','0','0'">第7,8节</option>
		              <option value="'5'|'0','0','0','0','9','0','0','0','0'">第9,10节</option>
		              <option value="'6'|'0','0','0','0','0','11','0','0','0'">第11,12节</option>
		              <option value="'7'|'1','3','0','0','0','0','0','0','0'">上午</option>
		              <option value="'8'|'0','0','5','7','0','0','0','0','0'">下午</option>
		              <option value="'9'|'0','0','0','0','9','11','0','0','0'">晚上</option>
		              <option value="'10'|'1','3','5','7','0','0','0','0','0'">白天</option>
		              <option value="'11'|'1','3','5','7','9','11','0','0','0'">整天</option>
		            </select>
		          </div>
		          <div class="form-group">
		            <center>
		              <button type="submit" class="btn btn-primary btn-lg btn-block release">立即查询</button>
		            </center>
		          </div>
		      </form>
			</div>
		</div>
		<!-- 自习室查询结束 -->
		<!-- 打印课表开始 -->
		<div class="classroom">
			<div class="classroom-title">
				<h4><i class="fa fa-table"></i>&nbsp;打印课表</h4>
			</div>
			<div class="classroom-condition">
				<form class="form-horizontal" role="form" action="<?php echo site_url('jiaowu/classtable'); ?>" method="post">
		          <div class="form-group">
		            <label for="xh">学号</label>
    				<input type="text" name="xh" class="form-control" id="xh" placeholder="请输入你的学号">
		          </div>
		          <div class="form-group">
		            <label for="password">密码</label>
    				<input type="password" name="pwd" class="form-control" id="password" placeholder="请输入你的教务系统密码">
		          </div>
		          <div class="form-group">
		              <button type="submit" class="btn btn-primary btn-lg btn-block release">打 印 课 表（暂时支持PC）</button>
		              <button type="submit" formaction="<?php echo site_url('jiaowu/getTablePhoto'); ?>" class="btn btn-primary btn-lg btn-block release">查 看 课 表</button>
		          </div>
		      </form>
			</div>
		</div>
		<!-- 打印课表结束 -->
		<!-- 课程搜索 -->
		<div class="classsearch classroom">
			<div class="classsearch-title classroom-title">
				<h4><i class="fa fa-search"></i>&nbsp;搜课</h4>
			</div>
			<div class="classsearch-condition">
				<form class="form-horizontal" role="form" method="get">
		          <div class="form-group">
		            <label for="grade">年级</label>
		            <select name="grade" id="grade" class="form-control">
		            	<option value="10">10级</option>
		            	<option value="11">11级</option>
		            	<option value="12">12级</option>
		            	<option value="13">13级</option>
		            	<option value="14">14级</option>
		            </select>
		          </div>
		          <div class="form-group">
		            <label for="major">专业</label>
		            <select name="major" id="major" class="form-control">
		            	<!-- <option value="机械电子工程">机械电子工程</option> -->
		            </select>
		          </div>
		          <div class="form-group">
		              <button type="submit" class="btn btn-primary btn-lg btn-block release" id="classsearch-submit">查 询</button>
		          </div>
		      </form>
			</div>
			<div class="classearch-result">
				<ul class="list-group" id="class-list">
				  
				</ul>
			</div>
		</div>
		<!-- 课程搜索结束 -->
	</div>
	

	
	

	<!-- 页脚部分开始 -->
	<section id="contact" name="contact"></section>
	<div id="c">
		<div class="container" >
			<p>Created by <a href="http://www.cnblogs.com/zhongshanblog/" target="_blank">Zhongshan</a></p>
		</div>
	</div>
	<!-- 页脚部分结束 -->

	<!-- ===============================失物招领信息发布模态框=================================== -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 >发布失物招领信息</h4>
	      </div>
	      <div class="modal-body">
	        <form method="post" action="<?php echo site_url('welcome/message_add') ?>" enctype="multipart/form-data" id="message-form">
	          <div class="form-group"> 
				  	<!-- <label for="message-text" class="control-label">标题:</label> -->
	            	<input type="text" name="title" class="form-control" id="message-title" placeholder="标题">
	          </div>
	          <div class="form-group"> 
	            <div class="input-group">
				  	<select name="type" id="message-type">
				  		<option value="失物招领">失物招领</option>
				  		<option value="寻物启事">寻物启事</option>
				  	</select>
				</div>
	          </div>
	          <div class="form-group">
	            <!-- <label for="message-text" class="control-label">内容:</label> -->
	            <textarea class="form-control" name="content" id="message-text" placeholder="具体内容"></textarea>
	          </div>
	          <div class="form-group">
	            <label for="message-pic">上传图片（可选）</label>
	            <input type="file" name="image" id="message-pic" accept="image/*">
	            
	          </div>
	          <div class="form-group">
	            <!-- <label for="phone-number" class="control-label">联系电话:</label> -->
	            <input type="text" name="tel" class="form-control" id="phone-number" placeholder="联系电话">
	            <span id="progress"></span>
	          </div>
	        </form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
	        <button type="button" class="btn btn-primary modal-enter" id="message-submit">发布</button>
	      </div>
	    </div>
	  </div>
	</div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
    <!--
    <script src="http://blacktie.co/adpacks/demoad.js"></script>
    -->
    <script>
    	$(document).ready(function() {
    		/*失物招领信息发布模态框*/
	    	$('#exampleModal').on('show.bs.modal', function (event) {
				var button = $(event.relatedTarget) // Button that triggered the modal
				var recipient = button.data('whatever') // Extract info from data-* attributes
				// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
				// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
				var modal = $(this)
				modal.find('.modal-title').text('New message to ' + recipient)
				modal.find('.modal-body input').val(recipient)
			})

			/* ajax 表单*/
			

			$('#message-submit').click(function(){
				var image = $("#message-pic").val();
				var title = $("#message-title").val();
				var type = $("#message-type").val();
				var content = $("#message-text").val();
				var tel = $("#phone-number").val();
	            if (title!= "" && type != "" && content != "" && tel != "") {
	            	$('#message-form').submit();
	            }

	        }); 

	        /*课程搜索框*/
			$("#grade").click(function(event) {

                $.ajax({
                    url: "<?php echo site_url('jiaowu/get_major_list') ?>",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        "grade": $("#grade").val()
                    },
                    success:function(data){
                        if (data.success) {
                            $("#major").html(data.msg);
                        }else{
                        	var option = "<option>暂无记录！</option>";
                            $("#major").html(option);
                        }
                    },
                    error:function(jqXHR){
                        alert("发生错误:"+jqXHR.status);
                    }
                })
                return false;
                
            });

            /*课程搜索结果*/
            
            $("#classsearch-submit").click(function(event) {

                $.ajax({
                    url: "<?php echo site_url('jiaowu/class_list') ?>",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        "major": $("#major").val()
                    },
                    success:function(data){
                        if (data.success) {
                            $("#class-list").html(data.msg);
                        }else{
                        	var li = "<li class='list-group-item'>暂无记录~</li>";
                            $("#class-list").html(li);
                        }
                    },
                    error:function(jqXHR){
                        alert("发生错误:"+jqXHR.status);
                    }
                })
                return false;
                
            });
    	});
    </script>
</body>
</html>