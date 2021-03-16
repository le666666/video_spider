<?php 
header('Access-Control-Allow-Origin:*');
header('Content-type: application/json');
ini_set('display_errors','off');
error_reporting(E_ALL || ~E_NOTICE);
require 'src/video_spider.php';
$url = $_REQUEST['url'];
if (strstr($url,"t.cn")) {
$url = getrealurl($url);
};
$id = $_REQUEST['id']; //微视 isee
$vid = $_REQUEST['vid']; //全民
$basai_id = $_REQUEST['data']; //巴塞电影
use Video_spider\Video;
$api = new Video;
if (strpos($url,'pipix') !== false){
    $arr = $api->pipixia($url);
} elseif (strpos($url, 'douyin') !== false){
    $arr = $api->douyin($url);
} elseif (strpos($url, 'huoshan') !== false){
    $arr = $api->huoshan($url);
} elseif (strpos($url, 'h5.weishi') !== false){
    $arr = $api->weishi($url);
} elseif (strpos($url, 'isee.weishi') !== false){
    $arr = $api->weishi($id);
} elseif (strpos($url, 'weibo.com') !== false){
    $arr = $api->weibo($url);
} elseif (strpos($url, 'oasis.weibo') !== false){
    $arr = $api->lvzhou($url);
} elseif (strpos($url, 'zuiyou') !== false){
    $arr = $api->zuiyou($url);
} elseif (strpos($url, 'bbq.bilibili') !== false){
    $arr = $api->bbq($url);
} elseif (strpos($url, 'kuaishou') !== false){
    $arr = $api->kuaishou($url);
} elseif (strpos($url, 'quanmin') !== false){
    $arr = $api->quanmin($vid);
} elseif (strpos($url, 'moviebase') !== false){
    $arr = $api->basai($basai_id);
} elseif (strpos($url, 'hanyuhl') !== false){
    $arr = $api->before($url);
} elseif (strpos($url, 'eyepetizer') !== false){
    $arr = $api->kaiyan($url);
} elseif (strpos($url, 'immomo') !== false){
    $arr = $api->momo($url);
} elseif (strpos($url, 'vuevideo') !== false){
    $arr = $api->vuevlog($url);
} elseif (strpos($url, 'xiaokaxiu') !== false){
    $arr = $api->xiaokaxiu($url);
} elseif (strpos($url, 'ippzone') !== false){
    $arr = $api->pipigaoxiao($url);
} elseif (strpos($url, 'qq.com') !== false){
    $arr = $api->quanminkge($url);
} elseif (strpos($url, 'mparticle.uc.cn') !== false){
    $arr = $api->uca($url);
} elseif (strpos($url, 'v.uc.cn') !== false){
    $arr = $api->ucv($url);
}else {
    $arr = array(
        'code'  => 201,
        'msg' => '不支持您输入的链接'
    );
}
if (!empty($arr)){
    echo json_encode($arr, JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}
//获取301跳转真实地址   
function getrealurl($url){
	$header = get_headers($url,1);
	if (strpos($header[0],'301') || strpos($header[0],'302')) {
		if(is_array($header['Location'])) {
			return $header['Location'][count($header['Location'])-1];
		}else{
			return $header['Location'];
		}
	}else {
		return $url;
	}
}
?>