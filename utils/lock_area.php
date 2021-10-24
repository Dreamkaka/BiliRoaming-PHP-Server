<?php
// 防止外部破解
if(!defined('SYSTEM')) {exit(BLOCK_RETURN);}

// 锁区、web接口、X-From-Biliroaming
if ($cache_type == "app"){
	if ($type == 1 && LOCK_AREA == 1 && !empty($SERVER_AREA) && !in_array(AREA, $SERVER_AREA)) {
		block(); // 判断服务器锁区
	}
	if (BILIROAMING_VERSION == "" && BILIROAMING == 1) {
		if (WEB_ON == 1 && $path == "/intl/gateway/v2/ogv/view/app/season"){
			// web接口会用到东南亚season，特殊放行
		} else {
			block(); // 没带上 X-From-Biliroaming 的请求头
		}
	}
} elseif ($cache_type == "web" && WEB_ON == 0) {
	block(); // 服务器不开web接口
}
?>