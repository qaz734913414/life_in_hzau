<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	<meta name="viewport" content="width=1200, initial-scale=1.0">
	<title>我的课表</title>

	<style>
		body{
			background: rgb(242,242,242);
			margin:0;
		}
		table{
			/*border:#000 1px solid;*/
			width: 1200px;
			/*height: 800px;*/
			margin: 0 auto;
		}
		td{
		    text-align:center;
		    font-size:12px;
		    font-family:Arial, Helvetica, sans-serif;
		    /*border:#000 1px solid;*/
		    font-size: 20px;
			font-family: '微软雅黑';
			
		}
		.color-td{
			color: #fff;
			padding: 10px;
			border-radius: 2px;
			
		}
		span#bodyHeight{
			display: none;
		}
		#submit{
			width: 200px;
			height: 35px;
			background: #867A7A;
			color: #fff;
			/*font-weight: bold;*/
			font-size: 22px;
			font-family: '微软雅黑';
			border: 0;
			border-radius: 4px;
		}
	</style>
    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
	<script>
	$(document).ready(function() {
		/*var color = new Array("#FF0000","#00FF00","#5C3317","#D98719","#9932CD","#00009C","#007FFF","#9932CD");// 随机颜色数组*/
		var color = new Array("rgba(18,202,152,.9)","rgba(227,119,194,.9)","rgba(145,198,6,.9)","rgba(0,179,237,.9)","rgba(186,138,222,.9)","rgba(109,159,244,.9)","rgba(254,141,63,.9)","rgba(247,125,136,.9)","rgba(255,186,5,.9)"); // 随机颜色数组
		var colorLength = color.length;var tds = $(".color-td"); //所有的有课表的 td 标签
		var tdsLength = tds.length;
		for(var i = 0; i < tdsLength; i++){
			var td = tds[i];
			var random = Math.floor(colorLength*Math.random());
			if( td.innerHTML != ""){
				td.style.backgroundColor = color[random];
				// td.css('background', color[random]);
			}
		}

		var bodyHeight = $("html").height();
		var bodyWidth = $("html").width();
		// $("#bodyHeight").val(bodyHeight-35-74);
		// $("#bodyWidth").val(bodyWidth);
	});
	</script>
</head>
				 
<body>
	<table  border='0' cellpadding="0" > 
	   <tbody> 
	    <tr> 
	     <td colspan='2' rowspan='1'>时间</td> 
	     <td align='Center'> 星期一 </td> 
	     <td align='Center'> 星期二 </td> 
	     <td align='Center'> 星期三 </td> 
	     <td align='Center'> 星期四 </td> 
	     <td align='Center'> 星期五 </td> 
	     <td align='Center'> 星期六 </td> 
	     <td align='Center'> 星期日 </td> 
	    </tr> 
	    <tr> 
	     <td colspan='2'>早晨</td> 
	     <td align='Center'></td> 
	     <td align='Center'></td> 
	     <td align='Center'></td> 
	     <td align='Center'></td> 
	     <td align='Center'></td> 
	     <td align='Center'></td> 
	     <td align='Center'></td> 
	    </tr> 
	    <tr> 
	     <td rowspan='4' >上午</td> 
	     <td >1</td> 
	     
	     <td align='Center' rowspan='2'  class="color-td"><?php echo $list['mon']['1,2']; ?></td> 
	     <td align='Center' rowspan='2'  class="color-td"><?php echo $list['tues']['1,2']; ?></td> 
	     <td align='Center' rowspan='2'  class="color-td"><?php echo $list['wed']['1,2']; ?></td> 
	     <td align='Center' rowspan='2'  class="color-td"><?php echo $list['thur']['1,2']; ?></td>
	     <td align='Center' rowspan='2'  class="color-td"><?php echo $list['fri']['1,2']; ?></td> 
	     <td align='Center' rowspan='2'  class="color-td"><?php echo $list['sat']['1,2']; ?></td> 
	     <td align='Center' rowspan='2'  class="color-td"><?php echo $list['sun']['1,2']; ?></td> 
	    </tr>
	    <tr> 
	     <td>2</td>
	    </tr>
	    <tr> 
	     <td>3</td>
	     <td align='Center' rowspan='2' class="color-td"><?php echo $list['mon']['3,4']; ?></td> 
	     <td align='Center' rowspan='2' class="color-td"><?php echo $list['tues']['3,4']; ?></td> 
	     <td align='Center' rowspan='2' class="color-td"><?php echo $list['wed']['3,4']; ?></td> 
	     <td align='Center' rowspan='2' class="color-td"><?php echo $list['thur']['3,4']; ?></td>
	     <td align='Center' rowspan='2' class="color-td"><?php echo $list['fri']['3,4']; ?></td> 
	     <td align='Center' rowspan='2' class="color-td"><?php echo $list['sat']['3,4']; ?></td>
	     <td align='Center' rowspan='2' class="color-td"><?php echo $list['sun']['3,4']; ?></td> 

	    </tr>
	    <tr> 
	     <td>4</td>
	     
	    </tr>
	    <tr> 
	     <td rowspan='4' >下午</td>
	     <td>5</td>
	     <td align='Center' rowspan='2' class="color-td"><?php echo $list['mon']['5,6']; ?></td> 
	     <td align='Center' rowspan='2' class="color-td"><?php echo $list['tues']['5,6']; ?></td> 
	     <td align='Center' rowspan='2' class="color-td"><?php echo $list['wed']['5,6']; ?></td> 
	     <td align='Center' rowspan='2' class="color-td"><?php echo $list['thur']['5,6']; ?></td>
	     <td align='Center' rowspan='2' class="color-td"><?php echo $list['fri']['5,6']; ?></td> 
	     <td align='Center' rowspan='2' class="color-td"><?php echo $list['sat']['5,6']; ?></td>
	     <td align='Center' rowspan='2' class="color-td"><?php echo $list['sun']['5,6']; ?></td> 

	    </tr>
	    <tr> 
	     <td>6</td>
	    </tr>
	    <tr> 
	     <td>7</td>
	     <td align='Center' rowspan='2' class="color-td"><?php echo $list['mon']['7,8']; ?></td> 
	     <td align='Center' rowspan='2' class="color-td"><?php echo $list['tues']['7,8']; ?></td> 
	     <td align='Center' rowspan='2' class="color-td"><?php echo $list['wed']['7,8']; ?></td> 
	     <td align='Center' rowspan='2' class="color-td"><?php echo $list['thur']['7,8']; ?></td>
	     <td align='Center' rowspan='2' class="color-td"><?php echo $list['fri']['7,8']; ?></td> 
	     <td align='Center' rowspan='2' class="color-td"><?php echo $list['sat']['7,8']; ?></td>
	     <td align='Center' rowspan='2' class="color-td"><?php echo $list['sun']['7,8']; ?></td> 

	    </tr>
	    <tr> 
	     <td>8</td>
	    </tr>
	    <tr> 
	     <td rowspan='4' >晚上</td>
	     <td>9</td>
	     <td align='Center' rowspan='4' class="color-td"><?php echo $list['mon']['9,10']; ?></td> 
	     <td align='Center' rowspan='4' class="color-td"><?php echo $list['tues']['9,10']; ?></td> 
	     <td align='Center' rowspan='4' class="color-td"><?php echo $list['wed']['9,10']; ?></td> 
	     <td align='Center' rowspan='4' class="color-td"><?php echo $list['thur']['9,10']; ?></td>
	     <td align='Center' rowspan='4' class="color-td"><?php echo $list['fri']['9,10']; ?></td> 
	     <td align='Center' rowspan='4' class="color-td"><?php echo $list['sat']['9,10']; ?></td>
	     <td align='Center' rowspan='4' class="color-td"><?php echo $list['sun']['9,10']; ?></td> 

	    </tr>
	    <tr> 
	     <td>10</td>
	    </tr>
	    <tr> 
	     <td>11</td>
	    </tr>
	    <tr> 
	     <td>12</td>
	    </tr> 
	    <tr>
	     <td align='right' colspan='9'>Created by Zhongshan(imzhongshan@126.com)</td>
	    </tr>
	   </tbody>
	</table>
	<!-- <center>
		<form action="<?php echo site_url('jiaowu/getTablePhoto'); ?>" method="get">
			<input type='hidden' name='bodyHeight' id='bodyHeight' value='1200px'>
			<input type='hidden' name='bodyWidth' id='bodyWidth' value='800px'>
			<input type="hidden" name="xh" value="<?php echo $xh; ?>">
			<input type="hidden" name="pwd" value="<?php echo $pwd; ?>">
			<input type='submit' name='submit' value='下载图片' id='submit'>
		</form>
	</center> -->
</body>
</body>
</html>