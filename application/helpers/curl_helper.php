<?php  

	/**
	 * 简单对称加密算法之加密
	 * @param String $string 需要加密的字串
	 * @param String $skey 加密EKY
	 * @author Zhongshan <1194567130@qq.com>
	 * @date 2015-03-10 11:30
	 * @return String
	 */
 	function encode($string = '', $skey = 'cxphp'){
		$strArr = str_split(base64_encode($string));
    	$strCount = count($strArr);
    	foreach (str_split($skey) as $key => $value)
        	$key < $strCount && $strArr[$key].=$value;
    	return str_replace(array('=', '+', '/'), array('O0O0O', 'o000o', 'oo00o'), join('', $strArr));
	}
	/**
	 * 简单对称加密算法之解密
	 * @param String $string 需要加密的字串
	 * @param String $skey 加密EKY
	 * @author Zhongshan <1194567130@qq.com>
	 * @date 2015-03-10 11:30
	 * @return String
	 */
	function decode($string = '', $skey = 'cxphp') {
	    $strArr = str_split(str_replace(array('O0O0O', 'o000o', 'oo00o'), array('=', '+', '/'), $string), 2);
	    $strCount = count($strArr);
	    foreach (str_split($skey) as $key => $value)
	        $key <= $strCount && $strArr[$key][1] === $value && $strArr[$key] = $strArr[$key][0];
	    return base64_decode(join('', $strArr));
	}



	//模拟登陆
	function curl_request($url,$post='',$cookie='', $returnCookie=0){
	        $curl = curl_init();
	        curl_setopt($curl, CURLOPT_URL, $url);
	        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)');
	        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
	        curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
	        curl_setopt($curl, CURLOPT_REFERER, "http://jw.hzau.edu.cn"); //填写教务系统url
	        if($post) {
	            curl_setopt($curl, CURLOPT_POST, 1);
	            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));
	        }
	        if($cookie) {
	            curl_setopt($curl, CURLOPT_COOKIE, $cookie);
	        }
	        curl_setopt($curl, CURLOPT_HEADER, $returnCookie);
	        curl_setopt($curl, CURLOPT_TIMEOUT, 20);
	        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	        $data = curl_exec($curl);
	        if (curl_errno($curl)) {
	            return curl_error($curl);
	        }
	        curl_close($curl);
	        if($returnCookie){
	            list($header, $body) = explode("\r\n\r\n", $data, 2);
	            preg_match_all("/Set\-Cookie:([^;]*);/", $header, $matches);
	            $info['cookie']  = substr($matches[1][0], 1);
	            $info['content'] = $body;
	            return $info;
	        }else{
	            return $data;
	        }
    }