<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- <link rel="shortcut icon" href="assets/ico/favicon.png"> -->

    <title>华农生活-自习室查询</title>

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
      <h2>自习室查询</h2>
  </nav>
	<?php echo $tip; ?>
  	<!-- 表格部分开始 -->
  	<?php echo $table; ?>
	<!-- 表格部分结束 -->
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
</body>
</html>

