<?php
/**
 * 初期アクセスページ
 * この画面でCookieを発行した後タッチ画面に遷移する
 *
 * @author Multi touch LLC.
 */

// 必須ファイルの読み込み
$funcPath	= realpath("./f/func.php");
if (file_exists($funcPath)) {
	include($funcPath);
} else {
	header("HTTP/1.1 500 Internal Server Error");
	exit;
}
$coocieCheck	= Config::$coocieCheck;
$touchUrl	= Config::$touchUrl;
$filePath	= realpath($touchUrl);

if (file_exists($filePath)) {
	$now		= time();
	$expire		= $now + (86400 * Config::$cookieEnableDay);
	$path		= trim(dirname($_SERVER["SCRIPT_NAME"]));
	$domain		= (!empty($domain)) ? trim($domain) : $_SERVER["HTTP_HOST"];
	$delimiter	= ":";
	if (strstr($domain, $delimiter)) {
		$tmp = explode($delimiter, $domain);
		$domain = $tmp[0];
	}

	// SSL判定、不必要な場合は$secureに固定値を代入
	$secure = isSecure();

	// Cookieの発行が出来たらタッチ画面に遷移
	if (setcookie(Config::$cookieName, $now, $expire, $path, $domain, $secure, true)) {
		if (!isset($_REQUEST[$coocieCheck])) {
			$touchUrl .= "?{$coocieCheck}=1";
		}
		location($touchUrl);
	}
}

exit404();
