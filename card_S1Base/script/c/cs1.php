<?php
/**
 * V8エンジン設定ファイル
 * JavaScriptとしてヘッダーと内容を出力
 * @var array $configV8  カード設定1
 * @var array $configV8r カード設定2
 *
 * @author Multi touch LLC.
 */

// 必須ファイルの読み込み
$funcPath	= realpath("../../f/func.php");
if (file_exists($funcPath)) {
	include($funcPath);
} else {
	header("HTTP/1.1 500 Internal Server Error");
	exit;
}

// アクセス制限
$enable = isEnableAccess();
if (!$enable) {
	exit404();
}

// カード設定情報の復号化
$configV8 = $configV8r = array();
foreach (Config::$encryptConfigV8 as $row) {
	if ($decrypt = decrypt($row)) {
		$configV8[] = $decrypt;
	}
}
foreach (Config::$encryptConfigV8r as $row) {
	if ($decrypt = decrypt($row)) {
		$configV8r[] = $decrypt;
	}
}

// 復号化できなかった場合は問合せ
if ((count($configV8) < 1) && (count($configV8r) < 1) && strlen(Config::$apiUrl)) {
	$url = Config::$apiUrl."?".Config::$apiParam."=".Config::$apiKey;
	$json = file_get_contents($url);
	$decode = json_decode($json, true);
	if ($decode["result"]) {
		$configV8 = $decode["id"];
	} else {
		print basename(__FILE__)." > ".__FUNCTION__."[".__LINE__."] (".$decode["errorCode"].")".$decode["error"]."\n";
	}
}


/*
 // キャッシュさせない制御をする場合のヘッダー
 $enc = (function_exists("mb_internal_encoding")) ? mb_internal_encoding() : "UTF-8";
 header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
 header("Last-Modified: ".gmdate( "D, d M Y H:i:s")." GMT");
 header("Cache-Control: no-store, no-cache, must-revalidate");
 header("Cache-Control: post-check=0, pre-check=0", false);
 header("Pragma: no-cache");
 */
header("Content-type: application/x-javascript");

print "var CONFV8=".json_encode($configV8).";\n";
print "var CONFV8R=".json_encode($configV8r).";";

