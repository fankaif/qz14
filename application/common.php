<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
//根据ip获取地址
function ip2addr($ip='')
{
	if (empty($ip)) {
		$ip = getIp();
	}
	$host = "http://saip.market.alicloudapi.com";
    $path = "/ip";
    $method = "GET";
    $appcode = "27d9fe77de7d425eb5fb353bf4fba9ea";
    $headers = array();
    array_push($headers, "Authorization:APPCODE " . $appcode);
    $querys = "ip=".$ip;
    $bodys = "";
    $url = $host . $path . "?" . $querys;

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_FAILONERROR, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, false);
    if (1 == strpos("$".$host, "https://"))
    {
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    }
    $info = json_decode(curl_exec($curl),true);
    if ($info['showapi_res_body']['ret_code']!==0) {
    	return $ip;
    }
    return $info['showapi_res_body']['country'].$info['showapi_res_body']['region'].$info['showapi_res_body']['city'].$info['showapi_res_body']['county'];
}
/*
获取用户ip
 */
function getIp()
{

    if(!empty($_SERVER["HTTP_CLIENT_IP"]))
    {
        $cip = $_SERVER["HTTP_CLIENT_IP"];
    }
    else if(!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
    {
        $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    }
    else if(!empty($_SERVER["REMOTE_ADDR"]))
    {
        $cip = $_SERVER["REMOTE_ADDR"];
    }
    else
    {
        $cip = '';
    }
    preg_match("/[\d\.]{7,15}/", $cip, $cips);
    $cip = isset($cips[0]) ? $cips[0] : 'unknown';
    unset($cips);

    return $cip;
}

/*
封装搜索条件
$field array  字段
$option or/and
$data=[]    数据
return $where 条件字串
 */
// function searWhere($field,$option='and',$data=[])
// {
//     if (empty($field)) {
//        return '';
//     }
//     if (empty($data)) {
//         $data = input('get.');
//     }
//     $where = [];
//     foreach ($field as $k => $v) {
//         if ($v=='like') {
//             $where[$k]=[$v,'%'.$data[$k].'%'];
//         }else{
//             $where[$k]=[$v,$data[$k]];
//         }
//     }
//     return $where;

// }
// 
//树形类别
function type2tree($value)
{
    $arr = explode(',',rtrim($value,','));
    $num = count($arr);
    return str_repeat('-',$num*3);
}