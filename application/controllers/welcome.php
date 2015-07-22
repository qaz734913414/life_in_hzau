<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function __construct(){
		parent::__construct(); //调用父类的构造方法
		header("Content-Type:text/html;charset=utf-8");
		error_reporting(E_ALL^E_NOTICE); //关闭notice提示
		date_default_timezone_set("PRC");//时区设置
		//登陆验证...
		
		//权限验证...
	}
	/*所有私有成员*/
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
	        $result = $this->curl_request($url,'',$cookie);
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
	//空教室查询结果
    private function roomsearch(){
    	$xh = "2012307200801"; //设置学号
		$pwd = "zs931203";  //学号对应的密码

    	//登录教室查询页面，获取可选的日期
    	$cookie = $this->login($xh,$pwd);
        $url = "http://jw.hzau.edu.cn/xxjsjy.aspx?xh={$xh}";
        $result = curl_request($url,'',$cookie);  //保存的cookies

        preg_match_all('/<select[\w\W]*?id="kssj">([\w\W]*?)<\/select>/',$result,$out);
        $option = trim($out[1][0]);

        return $option;
    }



	
	public function index()
	{
		//空教室查询数据
		$data['roomSearchOption'] = $this->roomsearch();

		$res = $this->db->limit(5,0)->order_by('createtime desc')->get('goods');
		$goods = $res->result();
		$data['goods'] = $goods;
		// $this->load->view('index');
		$this->load->view("index",$data);
	}

	public function message_add(){
		$dataArr['title'] = $this->input->post('title');
		$dataArr['type'] = $this->input->post('type');
		$dataArr['content'] = $this->input->post('content');
		$dataArr['tel'] = $this->input->post('tel');


		$cratetime = time(); //发布时间

		//上传目录需要手工创建
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|png|jpg|jpeg';
		$config['max_size'] = '100000';
		//生成新的文件名
		$config['file_name'] = uniqid();
		//装载文件上传类
		$this->load->library('upload',$config);
		if($this->upload->do_upload('image')){
			// var_dump($this->upload->data());
			//获取上传之后的数据
			$data = $this->upload->data();

			$dataArr['image'] = $data['file_name'];
		}

		
		
		$bool = $this->db->insert('goods',$dataArr);	
		if ($bool) {
			$url = site_url('welcome/index');
			echo "<script>window.location='$url';</script>";
		}else{
			echo "<script>alert('发布失败，请重试！');location.href = 'javascript:history.go(-1)';</script>";
		}
	}

	//个人专业查询
    public function major($xh = "2012307200801",$pwd = "zs931203"){
       
        $result = $this->information($xh, $pwd);
      	preg_match_all('/<span id="Label(\d)">([\w\W]*?)<\/span>/', $result, $out);
		$data['name'] = end(explode('：', $out[2][3])); //姓名
		// var_dump($data['name']);
		$data['college'] = end(explode('：', $out[2][4])); //学院
		$data['major'] = end(explode('：', $out[2][5])); //专业
		$data['class'] = substr($out[2][6], -4); //班级

		return $data;
	}

	public function information($xh = "2012307200801",$pwd = "zs931203"){

    	header("Content-Type:text/html;charset=utf-8");
	    $cookie = $this->login($xh,$pwd);
	    $url = "http://jw.hzau.edu.cn/xskbcx.aspx?xh={$xh}";
	    $result = curl_request($url,'',$cookie);  //保存的cookies
	    // print($result);
	    $result = iconv('GB2312','UTF-8',$result);
	    return $result;
	}
}
