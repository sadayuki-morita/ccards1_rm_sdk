<?php
/**
 * 設定クラス
 *
 * @author Multi touch LLC.
 */

class Config {
	public static $cookieName	= "mt";// 正規アクセス判定用Cookie名
	public static $coocieCheck	= "cc";// Cookie発行チェック用
	public static $cookieEnableDay = 90;// 90日有効なCookide、このcookieがある時のみjsを返却するphpが稼働する
	public static $touchUrl		= "./main.php";// タッチ画面のURL、ファイル名を変更する場合はここも変更
	public static $checkUrl		= "./index.php";// Cookie発行ページ。タッチ画面とは異なるURLにする
	public static $apiUrl		= "";// 公開鍵の有効期限切れ時にカード設定を問合せるAPI
	public static $apiParam		= "apikey";// API問合せ時のパラメータ名
	public static $apiKey		= "";// 契約カード番号	---
	public static $pubKey		= null;// 復号化用公開鍵
	public static function getPubKey() {
		if (self::$pubKey === null) {
			self::$pubKey = dirname(__FILE__)."/server.crt";
		}
		return self::$pubKey;
	}

	// カード設定
	public static $encryptConfigV8 = array(
		'RwKqKJKfslmzWzt3um70Kdqg0dn+ONGkT6f2Mfqj0AIMnAXdQwN0vGgkq0csYwJ11DsSdMmYUEjicNXwdta0vXfJzCwffcgVCBz8WbYioXsF+3ETobqt1UOkF/YQPnWoHPR5hDBuTRaEeLxZesNsRjHw7YnhFG0RBRU7Vkqq0ZVx/tJHioq49oUy9Q7UaEoOfFa/8Kb4t5AhSBSfKWrAQ74CMcQqJqj59s3FtICid4RXLRfM3qwGAlbMpFN1zWvVdY8ChIkn8RzfwFYljfKsBlLaYkQmSJlMMhgfRzcdfUSwDU3B+xmZ3NcmlqMyrSBnWEH/d+IlT/PFQPaPLkVoPQ==',
		'V2ZULZQKujA8DSZQPMxBAxL7addRcve/sI3U9iw9R4mvxgJyYfjoYuSjFNQI/BrfA/KTqLydMzT/nO6dV2Zjbzz54ZBmhF3fxrxT0Pe3bLmdHEAHfGHxkN2jzoRlzOepC/cOznJDL71NoUfdG9LBFFp25ouesa9z/RgcutIhWnDD9I0y1iKREJ4zhCEkCti8DYFo6raOPrhF5jVjX0genGOAJSESkH4otzH2ITSxNG4ptd4BXVqBUjGoC/76aCVvtog51ygb+Aqcvni3rLECzgoWfa+xnx95i7gsyWYpC4TzIHPGL/498S7H3QW3pKZWdBvx0jefgDdH1+RXWlEAiQ==',
	);
	public static $encryptConfigV8r = array(
		'RwKqKJKfslmzWzt3um70Kdqg0dn+ONGkT6f2Mfqj0AIMnAXdQwN0vGgkq0csYwJ11DsSdMmYUEjicNXwdta0vXfJzCwffcgVCBz8WbYioXsF+3ETobqt1UOkF/YQPnWoHPR5hDBuTRaEeLxZesNsRjHw7YnhFG0RBRU7Vkqq0ZVx/tJHioq49oUy9Q7UaEoOfFa/8Kb4t5AhSBSfKWrAQ74CMcQqJqj59s3FtICid4RXLRfM3qwGAlbMpFN1zWvVdY8ChIkn8RzfwFYljfKsBlLaYkQmSJlMMhgfRzcdfUSwDU3B+xmZ3NcmlqMyrSBnWEH/d+IlT/PFQPaPLkVoPQ==',
		'V2ZULZQKujA8DSZQPMxBAxL7addRcve/sI3U9iw9R4mvxgJyYfjoYuSjFNQI/BrfA/KTqLydMzT/nO6dV2Zjbzz54ZBmhF3fxrxT0Pe3bLmdHEAHfGHxkN2jzoRlzOepC/cOznJDL71NoUfdG9LBFFp25ouesa9z/RgcutIhWnDD9I0y1iKREJ4zhCEkCti8DYFo6raOPrhF5jVjX0genGOAJSESkH4otzH2ITSxNG4ptd4BXVqBUjGoC/76aCVvtog51ygb+Aqcvni3rLECzgoWfa+xnx95i7gsyWYpC4TzIHPGL/498S7H3QW3pKZWdBvx0jefgDdH1+RXWlEAiQ==',
	);
}
