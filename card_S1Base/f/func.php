<?php
/**
 * 汎用処理
 *
 * @author Multi touch LLC.
 */

// 設定の読み込み
if (!class_exists("Config", false)) {
	$confPath	= dirname(dirname(__FILE__))."/c/conf.php";
	if (file_exists($confPath)) {
		include($confPath);
	} else {
		header("HTTP/1.1 500 Internal Server Error");
		exit;
	}
}



/**
 * 公開鍵での復号化
 * @param  string $value Base64エンコードされた暗号化データ
 * @return (string|null) 復号化されたデータ
 */
function decrypt($value) {
	$decrypt = null;
	try {
		if (function_exists("openssl_pkey_get_public")) {
			$path = Config::getPubKey();
			if (file_exists($path)) {
				if ($key = file_get_contents($path)) {
					if (openssl_pkey_get_public($key)) {
						$timeZone = date_default_timezone_get();
						$now = time();
						date_default_timezone_set("Asia/Tokyo");
						$nowYmdHis = date("YmdHis", $now);
						date_default_timezone_set("UTC");
						$date = DateTime::createFromFormat("YmdHis", intval($nowYmdHis));
						$now = $date->getTimestamp();
						$validTo = 0;
						$crt = openssl_x509_parse($key);
						if (isset($crt["validTo_time_t"])) {
							$validTo = intval($crt["validTo_time_t"]);
						} else if (isset($crt["validTo"])) {
							$dt = DateTime::createFromFormat("YmdHis", intval($crt["validTo"]));
							$validTo = $dt->getTimestamp();
						}
						if ($now <= $validTo) {
							openssl_public_decrypt(base64_decode($value), $decrypt, $key);
						}
						date_default_timezone_set($timeZone);
					}
				}
			}
		}
	} catch (Exception $e) {
		print basename(__FILE__)." > ".__FUNCTION__."[".__LINE__."] ".$e->getMessage()."\n";
	}
	return $decrypt;
}



/**
 * アクセスチェック
 * リファラとクッキーで正しい手順でのアクセスかを判定
 * @return boolean true:正規アクセス, false:非正規アクセス
 */
function isEnableAccess() {
	$ref = (isset($_SERVER["HTTP_REFERER"])) ? trim($_SERVER["HTTP_REFERER"]) : null;
	if (0 < strlen($ref)) {
		$parse	= parse_url($ref);
		$pattern	= preg_quote($parse["host"]);
		if (!preg_match("/^{$pattern}/", $_SERVER["HTTP_HOST"])) {
			$ref = null;
		}
	}
	if (!$ref || !isset($_COOKIE[Config::$cookieName])) {
		return false;
	}
	return true;
}



/**
 * SSL/TLSアクセス判定
 * @return boolean true:SSL/TLS(443)でのアクセス, true:SSL/TLS以外(80)でのアクセス
 */
function isSecure() {
	$secure = true;
	if (empty($_SERVER["HTTPS"]) || ($_SERVER["HTTPS"] !== "on")) {
		if (isset($_SERVER["HTTP_X_FORWARDED_PROTO"])) {
			if ($_SERVER["HTTP_X_FORWARDED_PROTO"] !== "https") {
				$secure = false;
			}
		} else if (empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
			if (intval($_SERVER["SERVER_PORT"]) !== 443) {
				$secure = false;
			}
		}
	}
	return $secure;
}



/*
 * 各種ヘッダー制御
 */
function exit500() {
	header("HTTP/1.1 500 Internal Server Error");
	exit;
}
function exit404() {
	header("HTTP/1.1 404 Not Found");
	exit;
}
function location($url) {
	header("Location: {$url}");
	exit;
}
