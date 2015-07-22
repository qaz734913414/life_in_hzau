<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jiaowu extends CI_Controller {
	public function __construct(){
		parent::__construct(); //调用父类的构造方法
		header("Content-Type:text/html;charset=utf-8");
		error_reporting(E_ALL^E_NOTICE); //关闭notice提示
		//登陆验证...
		
		//权限验证...
	}

	public function index(){
		echo "hello!";
	}
	private  function getView(){
	    $url = 'http://jw.hzau.edu.cn/default2.aspx';
	    $result = curl_request($url);
	    $pattern = '/<input type="hidden" name="__VIEWSTATE" value="(.*?)" \/>/is';
	    preg_match_all($pattern, $result, $matches);
	    $res[0] = $matches[1][0];
	         
	    return $res[0] ;
	}
	//返回教室查询页面的隐藏值
	private  function getViewJs($cookie,$xh){
        $url = "http://jw.hzau.edu.cn/xxjsjy.aspx?xh={$xh}";
        $result = curl_request($url,'',$cookie);
        $pattern = '/<input type="hidden" name="__VIEWSTATE" value="(.*?)" \/>/is';
        preg_match_all($pattern, $result, $matches);
        $res[0] = $matches[1][0];
        return $res[0] ;
	}
	private  function login($xh,$pwd){
	    $url = 'http://jw.hzau.edu.cn/default2.aspx';
	    $post['__VIEWSTATE'] = $this->getView();
	    $post['txtUserName'] = $xh; //填写学号
	    $post['TextBox2'] = $pwd;  //填写密码
	    $post['txtSecretCode'] = '';
	    $post['lbLanguage'] = '';
	    $post['hidPdrs'] = '';
	    $post['hidsc'] = '';
	    $post['RadioButtonList1'] = iconv('utf-8', 'gb2312', '学生');
	    $post['Button1'] = iconv('utf-8', 'gb2312', '登录');
	    $result = curl_request($url,$post,'', 1);
	    return $result['cookie'];
	}
	//返回课表字符串
	private function classresult($xh,$pwd){
    	date_default_timezone_set("PRC"); //时区设置
    	$classList = "";//声明课表变量

    	$cookie = $this->login($xh,$pwd);
    	$view = $this->getViewJs($cookie,$xh);//验证密码是否正确

    	//如果密码正确
        if (!empty($view)) {
        	$url = "http://jw.hzau.edu.cn/xskbcx.aspx?xh={$xh}";
	        $result = curl_request($url,'',$cookie);  //保存的cookies
			preg_match_all('/<table id="Table1"[\w\W]*?>([\w\W]*?)<\/table>/',$result,$out);
	        $table = $out[0][0]; //获取整个课表

	        preg_match_all('/<td [\w\W]*?>([\w\W]*?)<\/td>/',$table,$out);
	        $td = $out[1];
	        $length = count($td);

	    	//获得课程列表
	    	for ($i=0; $i < $length; $i++) { 
	    		$td[$i] = str_replace("<br>", "", $td[$i]);

	    		$reg = "/{(.*)}/";
	    	
	    		if (!preg_match_all($reg, $td[$i], $matches)) {
	    			unset($td[$i]);
	    		}
			}

			$td = array_values($td); //将课程列表数组重新索引
			$tdLength = count($td);
			for ($i=0; $i < $tdLength; $i++) { 
				$td[$i] = iconv('GB2312','UTF-8',$td[$i]);
			}

			//将课表转换成数组形式
			function converttoTable($table){
				$list = array(
					'sun' => array(
						'1,2' => '',
						'3,4' => '',
						'5,6' => '',
						'7,8' => '',
						'9,10' => ''
					),
					'mon' => array(
						'1,2' => '',
						'3,4' => '',
						'5,6' => '',
						'7,8' => '',
						'9,10' => ''
					),
					'tues' => array(
						'1,2' => '',
						'3,4' => '',
						'5,6' => '',
						'7,8' => '',
						'9,10' => ''
					),
					'wed' => array(
						'1,2' => '',
						'3,4' => '',
						'5,6' => '',
						'7,8' => '',
						'9,10' => ''
					),
					'thur' => array(
						'1,2' => '',
						'3,4' => '',
						'5,6' => '',
						'7,8' => '',
						'9,10' => ''
					),
					'fri' => array(
						'1,2' => '',
						'3,4' => '',
						'5,6' => '',
						'7,8' => '',
						'9,10' => ''
					),
					'sat' => array(
						'1,2' => '',
						'3,4' => '',
						'5,6' => '',
						'7,8' => '',
						'9,10' => ''
					)
				);
				$week = array("sun"=>"周日","mon"=>"周一","tues"=>"周二","wed"=>"周三","thur"=>"周四","fri"=>"周五","sat"=>"周六");
				$order = array('1,2','3,4','5,6','7,8','9,10');
				foreach ($table as $key => $value) {
					$class = $value;
					foreach ($week as $key => $weekDay) {
						$pos = strpos($class,$weekDay);
						// echo $pos;
						if ($pos) {
							$weekArrayDay = $key; //获取list数组中的第一维key 
							foreach ($order as $key => $orderClass) {
								$pos = strpos($class,$orderClass);
								if ($pos) {
									$weekArrayOrder = $orderClass; //获取该课程是第几节
									break;
								}
							}
							break;
						}
					}
					$list[$weekArrayDay][$weekArrayOrder] = $class;
				}
				return $list;
			}
					
			//调用函数
			return converttoTable($td);
        }else{
        	return 0;
        }
	}




	
	//空教室查询结果
	public function roomresult(){
		$xh = ""; //设置学号
		$pwd = "";  //学号对应的密码

		$cookie = $this->login($xh,$pwd);
        $url = "http://jw.hzau.edu.cn/xs_main.aspx?xh={$xh}";
        $result = curl_request($url,'',$cookie);  //保存的cookies

        $url="http://jw.hzau.edu.cn/xxjsjy.aspx?xh={$xh}";
        $post['Button2'] = iconv('utf-8', 'gb2312', '空教室查询');
        $post['__EVENTARGUMENT']='';
        $post['__EVENTTARGET']='';
        $post['__VIEWSTATE'] = $this->getViewJs($cookie,$xh);
        $post['ddlDsz'] = iconv('utf-8', 'gb2312', '单');
        $post['ddlSyXn'] = '2014-2015'; //学年
        $post['ddlSyxq'] = '1'; 
        $post['jslb'] = '';
        $post['xiaoq'] = '';

        $post['kssj']=$_GET['start'];  //提交的开始查询时间  
        $post['sjd']=$_GET['class'];//提交的课程节次

        $post['xn']='2014-2015';//所在学年
        $post['xq']='2';//所在学期
        $post['xqj']='6';//当天星期几
        $post['dpDataGrid1:txtPageSize']=90;//每页显示条数

        $result = curl_request($url,$post,$cookie,0);
		
		preg_match_all('/<span[^>]+>[^>]+span>/',$result,$out);
        $tip = iconv('gb2312', 'utf-8', $out[0][3]);//获取页面前部的提示内容
        preg_match_all('/<table[\w\W]*?>([\w\W]*?)<\/table>/',$result,$out);
        $table = iconv('gb2312', 'utf-8', $out[0][0]); //获取查询列表
		
		$this->load->view("classroom",array('tip'=>$tip,'table'=>$table));
    }

    //个人专业查询
    private function major($xh = "2012307200801",$pwd = "zs931203"){
       
        $result = $this->information($xh, $pwd);
      	preg_match_all('/<span id="Label(\d)">([\w\W]*?)<\/span>/', $result, $out);
		$data['name'] = end(explode('：', $out[2][3])); //姓名
		// var_dump($data['name']);
		$data['college'] = end(explode('：', $out[2][4])); //学院
		$data['major'] = end(explode('：', $out[2][5])); //专业
		$data['class'] = substr($out[2][6], -4); //班级

		return $data;
	}

	private function information($xh = "2012307200801",$pwd = "zs931203"){

    	header("Content-Type:text/html;charset=utf-8");
	    $cookie = $this->login($xh,$pwd);
	    $url = "http://jw.hzau.edu.cn/xskbcx.aspx?xh={$xh}";
	    $result = curl_request($url,'',$cookie);  //保存的cookies
	    // print($result);
	    $result = iconv('GB2312','UTF-8',$result);
	    return $result;
	}

	private function insert_major($list, $xh, $pwd){
		$data = $this->major($xh, $pwd);
		$major = $data['major'];
		$grade = substr($data['class'], 0, 2);
		$res = $this->db->where(array('name'=>$major, 'grade'=>$grade))->get('major');
		$resArr = $res->result();

		if (empty($resArr)) {
			$query = $this->db->insert('major',array('name'=>$major, 'grade'=>$grade));
			$majorId = $this->db->insert_id();
			$sql = "INSERT INTO `lost_class`(`id`, `content`, `majorid`) VALUES";
			foreach ($list as $list_day) {
				if (!empty($list_day)) {
					foreach ($list_day as $list_class) {
						if (!empty($list_class) && !strpos($list_class, '通识')) {
							$sql .= "(null, '".$list_class."',".$majorId."),";
						}
					}
				}
			}
			$sql = substr($sql,0,strlen($sql)-1); 
			$bool = $this->db->query($sql);
			return $bool;
		}

		
	}




    //excel 课表输出结果
    public function classtable(){
		$xh = $this->input->post("xh");//获得学号
		$pwd = $this->input->post("pwd");//获得密码

		$list = $this->classresult($xh,$pwd);// 如果密码正确返回数组，错误返回0
		
		if (!$list) {
			echo "<script>alert('学号或密码输入错误！');location.href = 'javascript:history.go(-1)';</script>";
		}else{
			header ( "Content-type:application/vnd.ms-excel" );
			header ( "Content-Disposition:attachment;filename=myclasstable(PleaseRunOnPC).xls" );
			/*将数据插入数据库*/
			$bool = $this->insert_major($list, $xh, $pwd);
			$data = $this->major($xh, $pwd);
			echo "
				<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
				<html xmlns='http://www.w3.org/1999/xhtml'>
				<head>
				<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
				<title>无标题文档</title>
				<style>
				table{
					border:#000 1px solid;
				}
				td{
				    text-align:center;
				    font-size:12px;
				    font-family:Arial, Helvetica, sans-serif;
				    border:#000 1px solid;
				    color:#152122;
					
				}
				</style>
				</head>
				 
				<body>
				<table  border='0' > 
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
				     <td >第1节</td> 
				     
				     <td align='Center' rowspan='2' width='120' padding-top='20'>{$list['mon']['1,2']}</td> 
				     <td align='Center' rowspan='2' width='120' padding-top='20'>{$list['tues']['1,2']}</td> 
				     <td align='Center' rowspan='2' width='120' padding-top='20'>{$list['wed']['1,2']}</td> 
				     <td align='Center' rowspan='2' width='120' padding-top='20'>{$list['thur']['1,2']}</td>
				     <td align='Center' rowspan='2' width='120' padding-top='20'>{$list['fri']['1,2']}</td> 
				     <td align='Center' rowspan='2' width='120' padding-top='20'>{$list['sat']['1,2']}</td> 
				     <td align='Center' rowspan='2' width='120' padding-top='20'>{$list['sun']['1,2']}</td> 
				    </tr>
				    <tr> 
				     <td>第2节</td>
				    </tr>
				    <tr> 
				     <td>第3节</td>
				     <td align='Center' rowspan='2'>{$list['mon']['3,4']}</td> 
				     <td align='Center' rowspan='2'>{$list['tues']['3,4']}</td> 
				     <td align='Center' rowspan='2'>{$list['wed']['3,4']}</td> 
				     <td align='Center' rowspan='2'>{$list['thur']['3,4']}</td>
				     <td align='Center' rowspan='2'>{$list['fri']['3,4']}</td> 
				     <td align='Center' rowspan='2'>{$list['sat']['3,4']}</td>
				     <td align='Center' rowspan='2'>{$list['sun']['3,4']}</td> 

				    </tr>
				    <tr> 
				     <td>第4节</td>
				     
				    </tr>
				    <tr> 
				     <td rowspan='4' >下午</td>
				     <td>第5节</td>
				     <td align='Center' rowspan='2'>{$list['mon']['5,6']}</td> 
				     <td align='Center' rowspan='2'>{$list['tues']['5,6']}</td> 
				     <td align='Center' rowspan='2'>{$list['wed']['5,6']}</td> 
				     <td align='Center' rowspan='2'>{$list['thur']['5,6']}</td>
				     <td align='Center' rowspan='2'>{$list['fri']['5,6']}</td> 
				     <td align='Center' rowspan='2'>{$list['sat']['5,6']}</td>
				     <td align='Center' rowspan='2'>{$list['sun']['5,6']}</td> 

				    </tr>
				    <tr> 
				     <td>第6节</td>
				    </tr>
				    <tr> 
				     <td>第7节</td>
				     <td align='Center' rowspan='2'>{$list['mon']['7,8']}</td> 
				     <td align='Center' rowspan='2'>{$list['tues']['7,8']}</td> 
				     <td align='Center' rowspan='2'>{$list['wed']['7,8']}</td> 
				     <td align='Center' rowspan='2'>{$list['thur']['7,8']}</td>
				     <td align='Center' rowspan='2'>{$list['fri']['7,8']}</td> 
				     <td align='Center' rowspan='2'>{$list['sat']['7,8']}</td>
				     <td align='Center' rowspan='2'>{$list['sun']['7,8']}</td> 

				    </tr>
				    <tr> 
				     <td>第8节</td>
				    </tr>
				    <tr> 
				     <td rowspan='4' >晚上</td>
				     <td>第9节</td>
				     <td align='Center' rowspan='4'>{$list['mon']['9,10']}</td> 
				     <td align='Center' rowspan='4'>{$list['tues']['9,10']}</td> 
				     <td align='Center' rowspan='4'>{$list['wed']['9,10']}</td> 
				     <td align='Center' rowspan='4'>{$list['thur']['9,10']}</td>
				     <td align='Center' rowspan='4'>{$list['fri']['9,10']}</td> 
				     <td align='Center' rowspan='4'>{$list['sat']['9,10']}</td>
				     <td align='Center' rowspan='4'>{$list['sun']['9,10']}</td> 

				    </tr>
				    <tr> 
				     <td>第10节</td>
				    </tr>
				    <tr> 
				     <td>第11节</td>
				    </tr>
				    <tr> 
				     <td>第12节</td>
				    </tr> 
				    <tr>
				     <td align='right' colspan='9'>@{$data['name']}</td>
				    </tr>
				   </tbody>
				  </table>
				</body>
				</html>
				";
		}
		

	}

	//图片课表展示
	public function classtablephoto(){
		$xh = $this->uri->segment(3);//获得学号
		$pwd = $this->uri->segment(4);//获得密码

		$list = $this->classresult($xh,$pwd);// 如果密码正确返回数组，错误返回0
		if (!$list) {
			echo "<script>alert('学号或密码输入错误！');location.href = 'javascript:history.go(-1)';</script>";
		}else{
			$xh = encode($xh);
			$pwd = encode($pwd);
			$this->load->view("classtablephoto",array('list'=>$list,'xh'=>$xh,'pwd'=>$pwd));
		}
	}
	//生成课表的图片
	public function getTablePhoto(){
		if (empty($_GET)) {
			/*处理来自主页的表单*/
			$xh = $this->input->post("xh");
			$pwd = $this->input->post("pwd");
			$url = base_url()."index.php/jiaowu/classtablephoto/{$xh}/{$pwd}";
			$html = file_get_contents($url);
			echo $html;
		} else {
			$xh = decode($_GET['xh']);
			$pwd = decode($_GET['pwd']);
			$bodyHeight = $_GET['bodyHeight']; //图片高
			$bodyWidth = $_GET['bodyWidth']; //图片宽

			$url = "http://0907.org/screenshot/screenshot_it.php?site=www.yangguang520.cn/lost/index.php/jiaowu/classtablephoto/{$xh}/{$pwd}&x={$bodyWidth}&y={$bodyHeight}&format=PNG&preview=生成截图";
			echo curl_request($url);
		}
		
		
		

	}


	//专业选择列表
	public function get_major_list(){
		$grade = $_GET['grade'];
		$majorArr = $this->db->where('grade', $grade)->get('major');
		$majorList = $majorArr->result();
		if (!empty($majorList)) {
			$option = "";
			foreach ($majorList as $majorOption) {
				$option .= "<option value='".$majorOption->id."'>".$majorOption->name."</option>";
			}
			echo '{"success":true,"msg":"'.$option.'"}';
		}else{
		    echo '{"success":false,"msg":"暂无记录！"}';
		}
	}

	//课程列表
	public function class_list(){
		$majorId = $_GET['major']; //专业id
		$classArr = $this->db->where('majorid', $majorId)->get('class');
		$classList = $classArr->result();
		if (!empty($classList)) {
			$list = "";
			foreach ($classList as $classLi) {
				$list .= "<li class='list-group-item'>".$classLi->content."</li>";
			}
			echo '{"success":true,"msg":"'.$list.'"}';
		}else{
			echo '{"success":false,"msg":"暂无记录！"}';
		}
	}




	
}
