<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Goods extends CI_Controller {
	public function __construct(){
		parent::__construct(); //调用父类的构造方法
		header("Content-Type:text/html;charset=utf-8");
		error_reporting(E_ALL^E_NOTICE); //关闭notice提示
		//登陆验证...
		
		//权限验证...
	}

	public function index(){
		$res = $this->db->limit(5,0)->order_by('createtime desc')->get('goods');
		$goods = $res->result();
		$data['goods'] = $goods;
		// $this->load->view('index');
		$this->load->view("goods",$data);
	}

	public function get_more(){
		$start = $_GET['start'];
		$res = $this->db->limit(5,$start)->order_by('createtime desc')->get('goods');
		$goods = $res->result();
		$goods_length = count($goods);
		$html = "";
		for($i = 0; $i < $goods_length; $i++){
			if (empty($goods[$i]->image)) {
				$image = base_url().'assets/img/header-bg.jpg';
			}else{
				$image = base_url().'uploads/'.$item->image;
			}
			$html .= "<div class='row'><div class='lost-item'><div class='col-lg-2 col-lg-offset-1'><span class='lost-title'><b class='lost-title-type'>{$goods[$i]->type}|</b>{$goods[$i]->title}</span></div><div class='col-lg-6'><p><img class='img-responsive' src='{$image}' alt='{$goods[$i]->title}'></p></div><div class='col-lg-3 lost-content'><p><b class='lost-content-title'>#{$goods[$i]->type}#</b></p><p><more><p class='lost-content-article'>{$goods[$i]->content}</p><br/><p class='lost-content-phone'><i class='fa fa-mobile-phone fa-lg'></i><a href='tel://{$goods[$i]->tel}'>{$goods[$i]->tel}</a></p><p class='lost-content-time'><i class='fa fa-clock-o fa-lg'></i><span>{$goods[$i]->createtime}</span></p></more></p></div></div><hr></div>";

		}
		if (empty($html)) {
			echo '{"success":false}';
		}else{
			echo '{"success":true,"msg":"'.$html.'"}';

		}
	}

}
