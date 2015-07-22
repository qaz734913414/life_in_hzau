<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="华农生活助手">
    <meta name="author" content="zhongshan">
    <!-- <link rel="shortcut icon" href="assets/ico/favicon.png"> -->
	<title>失物招领</title>

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
    <nav class="navbar navbar-inverse goods_nav">
  		<h2>失物招领</h2>
	</nav>
	
	<!--失物招领开始 -->
	<div class="container desc">
	<!-- 失物招领内容部分开始 -->
		<div class="lost-found-all">
			<?php foreach($goods as $item): ?>
			<div class="row">
				<div class="lost-item">
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
		<h5 class="tips"></h5>
	</div>
	<!-- 失物招领结束 -->

	<!-- 页脚部分开始 -->
	<section id="contact" name="contact"></section>
	<div id="c">
		<div class="container" >
			<p>Created by <a href="http://www.cnblogs.com/zhongshanblog/" target="_blank">Zhongshan</a></p>
		</div>
	</div>
	<!-- 页脚部分结束 -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
    <!--
    <script src="http://blacktie.co/adpacks/demoad.js"></script>
    -->
    <script>
    	$(document).ready(function() {
    		var arrvedAtBottom = function () {
		        return $(document).scrollTop() + $(window).height() == $(document).height();
		    };
    		$(window).scroll(function(){
		        if(arrvedAtBottom()) {
		        	var start = $(".row").length; //已经显示的数据条数
		        	$(".tips").html("加载中...");
		            $.ajax({
	                    url: "<?php echo site_url('goods/get_more') ?>",
	                    type: 'GET',
	                    dataType: 'json',
	                    data: {
	                        "start": start
	                    },
	                    success:function(data){
	                        if (data.success) {
	                            $(".lost-found-all").append(data.msg);
	                            $(".tips").html("");
	                        }else{
	                            $(".tips").html("没有更多了~");
	                        }
	                    },
	                    error:function(jqXHR){
	                        alert("发生错误:"+jqXHR.status);
	                    }
	                })
		        }
		    });

		    
    	});
    		
    </script>
</body>
</html>