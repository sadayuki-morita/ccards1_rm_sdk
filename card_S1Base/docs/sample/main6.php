<?php
/**
 * カードタッチページ　タッチ方向判定、動作判定認証バージョン
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

// 許可Cookie無し
if (!isset($_COOKIE[Config::$cookieName])) {
	// 発行確認パラメータ無し
	if (!isset($_REQUEST[$coocieCheck])) {
		$checkUrl	= Config::$checkUrl;
		$filePath	= realpath($checkUrl);
		if (file_exists($filePath)) {
			// Cookieを再発行する為に遷移
			location($checkUrl);
		} else {
			exit500();
		}
	} else {
		// Cookieが無くパラメータがあったらCookieが無効と判断し終了
		header("HTTP/1.1 404 Not Found");
		print "Disable cookie...";
		exit;
	}
} else if (isset($_REQUEST[$coocieCheck])) {
	// 発行時に付加したパラメータを除去
	$path = $_SERVER["SCRIPT_NAME"];
	location($path);
}

/**
 * S1カード(SDK)用サンプルスクリプト
 */
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1" />
    <title>C-Card SDK sample6</title>
    <!-- ↓↓↓ 必須ファイルの読込 ↓↓↓ -->
	<script type="text/javascript" src="./script/ctrlrm.js" defer></script>
    <script type="text/javascript" src="./script/analyzerm-s1t4u3-ob.js" defer></script>
    <link rel="stylesheet" href="./css/style.css" />
    <!-- ↑↑↑ 必須ファイルの読込 ↑↑↑ -->
    <script>
        var analyzer = null;// カード解析処理

        /****************************************************************
         * カード解析処理制御設定
         * この設定値は初期値です。必要に応じて有効化して値を設定して下さい
         ****************************************************************/
        var cardConf = {
        /*
            'touchElement': 'touch',						// タッチを受け付ける要素(ID又は要素で指定)
            'defaultContentsId': 'default_contents',		// 初期表示要素のID
            'variableContentsClass': '.variable_contents',	// 動的表示切替要素のクラス
            'elemIdPrefix': 'i',							// カード識別後、遷移ではなくコンテンツを表示する際に使用。表示要素のID属性値に指定する接頭辞で「i」を指定したなら「id="i*"」の設定された要素が表示される(*の中は1〜3の数値でカードの上側持ち手から下に向けて1,2,3となる)、HTMLパートと合わせて実装を確認して下さい
            'willStartCollbackKey': 'start',				// カード解析処理実行直前に呼ばれるコールバックに指定するキー名
            'onErrorCallbackKey': 'error',					// カード解析処理失敗に呼ばれるコールバックに指定するキー名
            'okSoundElemId': 'beep_ok',						// カードタッチ成功時効果音要素のID
            'ngSoundElemId': 'beep_ng',						// カードタッチ失敗時効果音要素のID
            'playSound': true,								// カードタッチ後に効果音を鳴らすか否かの設定(true:鳴らす、false:鳴らさない)
            'motionDetectNum' : [0,0,0,0,0,0,0,0,0,0],      // motion制御指定配列（配列の要素番号 0:motion制御有、1:設定なし(0 or -1固定)、2～9:判定動作の指定、の値を 4条件閾値制御の場合 1、 疑似アナログ制御の場合 2、 8条件動作閾値判定の場合 3 にする。例えば、上下を閾値制御、左右をアナログ制御したい場合は、[2,-1,1,1,2,2,0,0,0,0]と指定する）
            'rotationDetect' : 0,                           // rotation判定指定配列（0:rotation判定無、1:rotation判定有、{判定有の場合、タッチパネルX座標軸の＋方向ベクトルと基準電極原点側から遠端側に向かうベクトルのなす角0°：callback.point=1、90°：2、180°：3、270°：4}とする。）
            'fixPosition' : false,                          // 動作判定、タッチ方向判定時のpositionの戻り値制御、false : position=analyze.point , true : position=1 cardId = cardId + "-" + analyze.point　＊動作判定、タッチ方向判定無しの場合、true/false関係なく callbacks['1']で、cardId = ID番号となる。
            'cardIdNum' : [],                               // 認証判定するID = CONFV8 の全ての場合、HTMLのコールバック関数内でID一致判定すること
            'touchWaitTime': 700,							// カード識別成功時に次のタッチを受け付けるまでのインターバル(msec)
	        'touchedClearInterval : 200,					// タッチイベント終了後に蓄積している座標を初期化するまでのインターバル(msec)
            'transitTouchWaitTime': 25,						// motion制御カード移動中の識別成功時に次のタッチを受け付けるまでのインターバル(msec)
            'motionAnalogOut : [0,0,0,0],                   // 動作変化のデルタ値(=変化量/閾値)格納 motionAnalogOut = [deltaX,deltaÝ,deltaangle,deltaTime]
            'touchAngleDeg : 0,                             // タッチ方向判定回転角		20250630
            'showErrorAlert : true,							// エラーアラート表示フラグ
            'initModalElemId : 'init_modal',				// メディア読込用モーダルの要素のID
            'initModalDoneElemId : 'init_modal_done',		// メディア読込用モーダルを閉じる(ボタン)要素のID
            'commonErrorMsg : 'カードが認識出来ませんでした。', // 汎用エラーメッセージ
        */
            'motionDetectNum' : [3,-1,1,1,1,1,1,1,1,1],     // motion制御指定配列（配列の要素番号 0:motion制御有、1:設定なし(0 or -1固定)、2～9:判定動作の指定、の値を 4条件閾値制御の場合 1、 疑似アナログ制御の場合 2、 8条件動作閾値判定の場合 3 にする。例えば、上下を閾値制御、左右をアナログ制御したい場合は、[2,-1,1,1,2,2,0,0,0,0]と指定する）
            'fixPosition' : false,                          // 動作判定、タッチ方向判定時のpositionの戻り値制御、false : position=analyze.point , true : position=1 cardId = cardId + "-" + analyze.point　＊動作判定、タッチ方向判定無しの場合、true/false関係なく callbacks['1']で、cardId = ID番号となる。
            'rotationDetect' : 1,                           // rotation判定指定配列（0:rotation判定無、1:rotation判定有、{判定有の場合、タッチパネルX座標軸の＋方向ベクトルと基準電極原点側から遠端側に向かうベクトルのなす角0°：callback.point=1、90°：2、180°：3、270°：4}とする。）
        };
        /*/ ↑↑↑ この変数は必要に応じて有効化して下さい ↑↑↑ */

        /****************************************************************
         * カード解析時に呼ばれる処理群
         * 実装時は下記スクリプトを編集してご利用下さい
         ****************************************************************/
        var callbacks = {
            /* カード解析開始直前に呼ばれる処理 */
            'start': function() { // cardConf.willStartCollbackKey: function() {
                /* 必要に応じて処理を実装 */
                document.getElementById('name').style.backgroundColor = "#baffab";           //5point揃って解析中は、表題の背景色を変える

                console.log('start_analyze');

                setTimeout(() => { document.getElementById('name').style.backgroundColor = "transparent"; }, _cardConf.touchWaitTime);

            },
        
            /* S1系カードでタッチした時に呼ばれる処理 */
/*
            // ID認証 'position番号' = '1'　設定：cardConf.rotationDetect = 0, cardConf.motionDetectNum[0] = 0 (デフォルト設定)
            '1': function(cardId) {                                     //ID認証した場合
                console.log('RN=1, ',cardId,", r=",parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))," , X= ",parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))," , Y= ",parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))," , A= ",parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1)));
                document.getElementById('name').style.backgroundColor = "#baffab";           //5point揃って解析中は、表題の背景色を変える
                document.getElementById('i1message').style.color = "#f90505ff";
                document.getElementById("i1text").innerHTML+="RN=1, " + cardId + ", r="+ parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))+", X="+parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))+", Y="+parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))+", A="+parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1))+ "<br>";
                setTimeout(() => { document.getElementById('name').style.backgroundColor = "transparent"; }, _cardConf.touchWaitTime);
		        return true;
            },
            //

            // タッチ方向判定 'position番号' = '10'〜'40'　設定：cardConf.rotationDetect = 1, cardConf.motionDetectNum[0] = 0
            '10': function(cardId) {                                     //タッチ方向：前向き(0度)　でID認証した場合
                console.log('RN=10, ',cardId,", r=",parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))," , X= ",parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))," , Y= ",parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))," , A= ",parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1)));
                document.getElementById('name').style.backgroundColor = "#baffab";           //5point揃って解析中は、表題の背景色を変える
                document.getElementById('i1message').style.color = "#f90505ff";
                document.getElementById("i1text").innerHTML+="RN=10, " + cardId + ", r="+ parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))+", X="+parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))+", Y="+parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))+", A="+parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1))+ "<br>";
                setTimeout(() => { document.getElementById('name').style.backgroundColor = "transparent"; }, _cardConf.touchWaitTime);
		        return true;
            },
            '20': function(cardId) {                                     //タッチ方向：右向き(90度)　でID認証した場合
                console.log('RN=20, ',cardId,", r=",parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))," , X= ",parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))," , Y= ",parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))," , A= ",parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1)));
                document.getElementById('name').style.backgroundColor = "#baffab";           //5point揃って解析中は、表題の背景色を変える
                document.getElementById('i1message').style.color = "#36fa05dd";
                document.getElementById("i1text").innerHTML+="RN=20, " + cardId + ", r="+ parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))+", X="+parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))+", Y="+parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))+", A="+parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1))+ "<br>";
                setTimeout(() => { document.getElementById('name').style.backgroundColor = "transparent"; }, _cardConf.touchWaitTime);
		        return true;
            },
            '30': function(cardId) {                                     //タッチ方向：後向き(180度)　でID認証した場合
                console.log('RN=30, ',cardId,", r=",parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))," , X= ",parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))," , Y= ",parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))," , A= ",parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1)));
                document.getElementById('name').style.backgroundColor = "#baffab";           //5point揃って解析中は、表題の背景色を変える
                document.getElementById('i1message').style.color = "#0c1edfbb";
                document.getElementById("i1text").innerHTML+="RN=30, " + cardId + ", r="+ parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))+", X="+parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))+", Y="+parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))+", A="+parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1))+ "<br>";
                setTimeout(() => { document.getElementById('name').style.backgroundColor = "transparent"; }, _cardConf.touchWaitTime);
		        return true;
            },
            '40': function(cardId) {                                     //タッチ方向：左向き(270度)　でID認証した場合
                console.log('RN=40, ',cardId,", r=",parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))," , X= ",parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))," , Y= ",parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))," , A= ",parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1)));
                document.getElementById('name').style.backgroundColor = "#baffab";           //5point揃って解析中は、表題の背景色を変える
                document.getElementById('i1message').style.color = "#f0900aff";
                document.getElementById("i1text").innerHTML+="RN=40, " + cardId + ", r="+ parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))+", X="+parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))+", Y="+parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))+", A="+parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1))+ "<br>";
                setTimeout(() => { document.getElementById('name').style.backgroundColor = "transparent"; }, _cardConf.touchWaitTime);
		        return true;
            },
            //

            // 動作判定 'position番号' = '2'〜'9'　設定：cardConf.rotationDetect = 0, cardConf.motionDetectNum[0] = 1 又は 2
            '2': function(cardId) {                                     //画面右方向に10mm程度移動検知　でID認証した場合
                console.log('RN=2, ',cardId,", r=",parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))," , X= ",parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))," , Y= ",parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))," , A= ",parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1)));
                document.getElementById('name').style.backgroundColor = "#baffab";           //5point揃って解析中は、表題の背景色を変える
                document.getElementById('i1message').style.color = "#f9e905ff";
                document.getElementById("i1text").innerHTML+="RN=2, " + cardId + ", r="+ parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))+", X="+parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))+", Y="+parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))+", A="+parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1))+ "<br>";
                setTimeout(() => { document.getElementById('name').style.backgroundColor = "transparent"; }, _cardConf.touchWaitTime);
		        return true;
            },
            '3': function(cardId) {                                     //画面右上方向に10mm程度移動検知　でID認証した場合
                console.log('RN=3, ',cardId,", r=",parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))," , X= ",parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))," , Y= ",parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))," , A= ",parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1)));
                document.getElementById('name').style.backgroundColor = "#baffab";           //5point揃って解析中は、表題の背景色を変える
                document.getElementById('i1message').style.color = "#05e9f9ff";
                document.getElementById("i1text").innerHTML+="RN=3, " + cardId + ", r="+ parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))+", X="+parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))+", Y="+parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))+", A="+parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1))+ "<br>";
                setTimeout(() => { document.getElementById('name').style.backgroundColor = "transparent"; }, _cardConf.touchWaitTime);
		        return true;
            },
            '4': function(cardId) {                                     //画面上方向に10mm程度移動検知　でID認証した場合
                console.log('RN=4, ',cardId,", r=",parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))," , X= ",parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))," , Y= ",parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))," , A= ",parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1)));
                document.getElementById('name').style.backgroundColor = "#baffab";           //5point揃って解析中は、表題の背景色を変える
                document.getElementById('i1message').style.color = "#e005f9ff";
                document.getElementById("i1text").innerHTML+="RN=4, " + cardId + ", r="+ parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))+", X="+parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))+", Y="+parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))+", A="+parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1))+ "<br>";
                setTimeout(() => { document.getElementById('name').style.backgroundColor = "transparent"; }, _cardConf.touchWaitTime);
		        return true;
            },
            '5': function(cardId) {                                     //画面左上方向に10mm程度移動検知　でID認証した場合
                console.log('RN=5, ',cardId,", r=",parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))," , X= ",parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))," , Y= ",parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))," , A= ",parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1)));
                document.getElementById('name').style.backgroundColor = "#baffab";           //5point揃って解析中は、表題の背景色を変える
                document.getElementById('i1message').style.color = "#9705f9ff";
                document.getElementById("i1text").innerHTML+="RN=5, " + cardId + ", r="+ parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))+", X="+parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))+", Y="+parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))+", A="+parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1))+ "<br>";
                setTimeout(() => { document.getElementById('name').style.backgroundColor = "transparent"; }, _cardConf.touchWaitTime);
		        return true;
            },
            '6': function(cardId) {                                     //画面左方向に10mm程度移動検知　でID認証した場合
                console.log('RN=6, ',cardId,", r=",parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))," , X= ",parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))," , Y= ",parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))," , A= ",parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1)));
                document.getElementById('name').style.backgroundColor = "#baffab";           //5point揃って解析中は、表題の背景色を変える
                document.getElementById('i1message').style.color = "#0521f9";
                document.getElementById("i1text").innerHTML+="RN=6, " + cardId + ", r="+ parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))+", X="+parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))+", Y="+parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))+", A="+parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1))+ "<br>";
                setTimeout(() => { document.getElementById('name').style.backgroundColor = "transparent"; }, _cardConf.touchWaitTime);
		        return true;
            },
            '7': function(cardId) {                                     //画面左下方向に10mm程度移動検知　でID認証した場合
                console.log('RN=7, ',cardId,", r=",parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))," , X= ",parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))," , Y= ",parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))," , A= ",parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1)));
                document.getElementById('name').style.backgroundColor = "#baffab";           //5point揃って解析中は、表題の背景色を変える
                document.getElementById('i1message').style.color = "#14504d";
                document.getElementById("i1text").innerHTML+="RN=7, " + cardId + ", r="+ parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))+", X="+parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))+", Y="+parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))+", A="+parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1))+ "<br>";
                setTimeout(() => { document.getElementById('name').style.backgroundColor = "transparent"; }, _cardConf.touchWaitTime);
		        return true;
            },            
            '8': function(cardId) {                                     //画面下方向に10mm程度移動検知　でID認証した場合
                console.log('RN=8, ',cardId,", r=",parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))," , X= ",parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))," , Y= ",parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))," , A= ",parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1)));
                document.getElementById('name').style.backgroundColor = "#baffab";           //5point揃って解析中は、表題の背景色を変える
                document.getElementById('i1message').style.color = "#f90521";
                document.getElementById("i1text").innerHTML+="RN=8, " + cardId + ", r="+ parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))+", X="+parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))+", Y="+parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))+", A="+parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1))+ "<br>";
		        return true;
            },
            '9': function(cardId) {                                     //画面右下方向に10mm程度移動検知　でID認証した場合
                console.log('RN=9, ',cardId,", r=",parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))," , X= ",parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))," , Y= ",parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))," , A= ",parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1)));
                document.getElementById('name').style.backgroundColor = "#baffab";           //5point揃って解析中は、表題の背景色を変える
                document.getElementById('i1message').style.color = "#05e0f9";
                document.getElementById("i1text").innerHTML+="RN=9, " + cardId + ", r="+ parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))+", X="+parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))+", Y="+parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))+", A="+parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1))+ "<br>";
		        return true;
            },
*/
            // タッチ方向判定×動作判定 'position番号' = '12'〜'49'　設定：cardConf.rotationDetect = 1, cardConf.motionDetectNum[0] = 1 又は 2
            '12': function(cardId) {                                     //タッチ方向：前向き(0度)かつ、画面右方向に10mm程度移動検知　でID認証した場合
                console.log('RN=12, ',cardId,", r=",parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))," , X= ",parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))," , Y= ",parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))," , A= ",parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1)));
                document.getElementById('name').style.backgroundColor = "#baffab";           //5point揃って解析中は、表題の背景色を変える
                document.getElementById('i1message').style.color = "#f7e336ff";
                document.getElementById("i1text").innerHTML+="RN=12, " + cardId + ", r="+ parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))+", X="+parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))+", Y="+parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))+", A="+parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1))+ "<br>";
                setTimeout(() => { document.getElementById('name').style.backgroundColor = "transparent"; }, _cardConf.touchWaitTime);
		        return true;
            },
            '13': function(cardId) {                                     //タッチ方向：前向き(0度)かつ、画面右上方向に10mm程度移動検知　でID認証した場合
                console.log('RN=13, ',cardId,", r=",parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))," , X= ",parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))," , Y= ",parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))," , A= ",parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1)));
                document.getElementById('name').style.backgroundColor = "#baffab";           //5point揃って解析中は、表題の背景色を変える
                document.getElementById('i1message').style.color = "#39dacfff";
                document.getElementById("i1text").innerHTML+="RN=13, " + cardId + ", r="+ parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))+", X="+parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))+", Y="+parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))+", A="+parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1))+ "<br>";
                setTimeout(() => { document.getElementById('name').style.backgroundColor = "transparent"; }, _cardConf.touchWaitTime);
		        return true;
            },
            '14': function(cardId) {                                     //タッチ方向：前向き(0度)かつ、画面上方向に10mm程度移動検知　でID認証した場合
                console.log('RN=14, ',cardId,", r=",parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))," , X= ",parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))," , Y= ",parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))," , A= ",parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1)));
                document.getElementById('name').style.backgroundColor = "#baffab";           //5point揃って解析中は、表題の背景色を変える
                document.getElementById('i1message').style.color = "#06450dff";
                document.getElementById("i1text").innerHTML+="RN=14, " + cardId + ", r="+ parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))+", X="+parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))+", Y="+parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))+", A="+parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1))+ "<br>";
                setTimeout(() => { document.getElementById('name').style.backgroundColor = "transparent"; }, _cardConf.touchWaitTime);
		        return true;
            },
            '15': function(cardId) {                                     //タッチ方向：前向き(0度)かつ、画面左上方向に10mm程度移動検知　でID認証した場合
                console.log('RN=15, ',cardId,", r=",parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))," , X= ",parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))," , Y= ",parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))," , A= ",parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1)));
                document.getElementById('name').style.backgroundColor = "#baffab";           //5point揃って解析中は、表題の背景色を変える
                document.getElementById('i1message').style.color = "#f09041ff";
                document.getElementById("i1text").innerHTML+="RN=15, " + cardId + ", r="+ parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))+", X="+parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))+", Y="+parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))+", A="+parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1))+ "<br>";
                setTimeout(() => { document.getElementById('name').style.backgroundColor = "transparent"; }, _cardConf.touchWaitTime);
		        return true;
            },
            '16': function(cardId) {                                     //タッチ方向：前向き(0度)かつ、画面左方向に10mm程度移動検知　でID認証した場合
                console.log('RN=16, ',cardId,", r=",parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))," , X= ",parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))," , Y= ",parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))," , A= ",parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1)));
                document.getElementById('name').style.backgroundColor = "#baffab";           //5point揃って解析中は、表題の背景色を変える
                document.getElementById('i1message').style.color = "#f7e336ff";
                document.getElementById("i1text").innerHTML+="RN=16, " + cardId + ", r="+ parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))+", X="+parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))+", Y="+parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))+", A="+parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1))+ "<br>";
                setTimeout(() => { document.getElementById('name').style.backgroundColor = "transparent"; }, _cardConf.touchWaitTime);
		        return true;
            },
            '17': function(cardId) {                                     //タッチ方向：前向き(0度)かつ、画面左下方向に10mm程度移動検知　でID認証した場合
                console.log('RN=17, ',cardId,", r=",parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))," , X= ",parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))," , Y= ",parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))," , A= ",parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1)));
                document.getElementById('name').style.backgroundColor = "#baffab";           //5point揃って解析中は、表題の背景色を変える
                document.getElementById('i1message').style.color = "#39dacfff";
                document.getElementById("i1text").innerHTML+="RN=17, " + cardId + ", r="+ parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))+", X="+parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))+", Y="+parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))+", A="+parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1))+ "<br>";
                setTimeout(() => { document.getElementById('name').style.backgroundColor = "transparent"; }, _cardConf.touchWaitTime);
		        return true;
            },
            '18': function(cardId) {                                     //タッチ方向：前向き(0度)かつ、画面下方向に10mm程度移動検知　でID認証した場合
                console.log('RN=18, ',cardId,", r=",parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))," , X= ",parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))," , Y= ",parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))," , A= ",parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1)));
                document.getElementById('name').style.backgroundColor = "#baffab";           //5point揃って解析中は、表題の背景色を変える
                document.getElementById('i1message').style.color = "#06450dff";
                document.getElementById("i1text").innerHTML+="RN=18, " + cardId + ", r="+ parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))+", X="+parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))+", Y="+parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))+", A="+parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1))+ "<br>";
                setTimeout(() => { document.getElementById('name').style.backgroundColor = "transparent"; }, _cardConf.touchWaitTime);
		        return true;
            },
            '19': function(cardId) {                                     //タッチ方向：前向き(0度)かつ、画面右下方向に10mm程度移動検知　でID認証した場合
                console.log('RN=19, ',cardId,", r=",parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))," , X= ",parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))," , Y= ",parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))," , A= ",parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1)));
                document.getElementById('name').style.backgroundColor = "#baffab";           //5point揃って解析中は、表題の背景色を変える
                document.getElementById('i1message').style.color = "#f09041ff";
                document.getElementById("i1text").innerHTML+="RN=19, " + cardId + ", r="+ parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))+", X="+parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))+", Y="+parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))+", A="+parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1))+ "<br>";
                setTimeout(() => { document.getElementById('name').style.backgroundColor = "transparent"; }, _cardConf.touchWaitTime);
		        return true;
            },
            '22': function(cardId) {                                     //タッチ方向：右向き(90度)かつ、画面右方向に10mm程度移動検知　でID認証した場合
                console.log('RN=22, ',cardId,", r=",parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))," , X= ",parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))," , Y= ",parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))," , A= ",parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1)));
                document.getElementById('name').style.backgroundColor = "#baffab";           //5point揃って解析中は、表題の背景色を変える
                document.getElementById('i1message').style.color = "#521111ff";
                document.getElementById("i1text").innerHTML+="RN=22, " + cardId + ", r="+ parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))+", X="+parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))+", Y="+parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))+", A="+parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1))+ "<br>";
                setTimeout(() => { document.getElementById('name').style.backgroundColor = "transparent"; }, _cardConf.touchWaitTime);
		        return true;
            },
            '23': function(cardId) {                                     //タッチ方向：右向き(90度)かつ、画面右上方向に10mm程度移動検知　でID認証した場合
                console.log('RN=23, ',cardId,", r=",parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))," , X= ",parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))," , Y= ",parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))," , A= ",parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1)));
                document.getElementById('name').style.backgroundColor = "#baffab";           //5point揃って解析中は、表題の背景色を変える
                document.getElementById('i1message').style.color = "#ab3535ff";
                document.getElementById("i1text").innerHTML+="RN=23, " + cardId + ", r="+ parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))+", X="+parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))+", Y="+parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))+", A="+parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1))+ "<br>";
                setTimeout(() => { document.getElementById('name').style.backgroundColor = "transparent"; }, _cardConf.touchWaitTime);
		        return true;
            },
            '24': function(cardId) {                                     //タッチ方向：右向き(90度)かつ、画面右方向に10mm程度移動検知　でID認証した場合
                console.log('RN=24, ',cardId,", r=",parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))," , X= ",parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))," , Y= ",parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))," , A= ",parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1)));
                document.getElementById('name').style.backgroundColor = "#baffab";           //5point揃って解析中は、表題の背景色を変える
                document.getElementById('i1message').style.color = "#adf1a2ff";
                document.getElementById("i1text").innerHTML+="RN=24, " + cardId + ", r="+ parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))+", X="+parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))+", Y="+parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))+", A="+parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1))+ "<br>";
                setTimeout(() => { document.getElementById('name').style.backgroundColor = "transparent"; }, _cardConf.touchWaitTime);
		        return true;
            },
            '25': function(cardId) {                                     //タッチ方向：右向き(90度)かつ、画面左上方向に10mm程度移動検知　でID認証した場合
                console.log('RN=25, ',cardId,", r=",parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))," , X= ",parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))," , Y= ",parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))," , A= ",parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1)));
                document.getElementById('name').style.backgroundColor = "#baffab";           //5point揃って解析中は、表題の背景色を変える
                document.getElementById('i1message').style.color = "#6e7089ff";
                document.getElementById("i1text").innerHTML+="RN=25, " + cardId + ", r="+ parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))+", X="+parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))+", Y="+parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))+", A="+parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1))+ "<br>";
                setTimeout(() => { document.getElementById('name').style.backgroundColor = "transparent"; }, _cardConf.touchWaitTime);
		        return true;
            },
            '26': function(cardId) {                                     //タッチ方向：右向き(90度)かつ、画面左方向に10mm程度移動検知　でID認証した場合
                console.log('RN=26, ',cardId,", r=",parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))," , X= ",parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))," , Y= ",parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))," , A= ",parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1)));
                document.getElementById('name').style.backgroundColor = "#baffab";           //5point揃って解析中は、表題の背景色を変える
                document.getElementById('i1message').style.color = "#521111ff";
                document.getElementById("i1text").innerHTML+="RN=26, " + cardId + ", r="+ parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))+", X="+parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))+", Y="+parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))+", A="+parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1))+ "<br>";
                setTimeout(() => { document.getElementById('name').style.backgroundColor = "transparent"; }, _cardConf.touchWaitTime);
		        return true;
            },
            '27': function(cardId) {                                     //タッチ方向：右向き(90度)かつ、画面左下方向に10mm程度移動検知　でID認証した場合
                console.log('RN=27, ',cardId,", r=",parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))," , X= ",parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))," , Y= ",parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))," , A= ",parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1)));
                document.getElementById('name').style.backgroundColor = "#baffab";           //5point揃って解析中は、表題の背景色を変える
                document.getElementById('i1message').style.color = "#ab3535ff";
                document.getElementById("i1text").innerHTML+="RN=27, " + cardId + ", r="+ parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))+", X="+parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))+", Y="+parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))+", A="+parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1))+ "<br>";
                setTimeout(() => { document.getElementById('name').style.backgroundColor = "transparent"; }, _cardConf.touchWaitTime);
		        return true;
            },
            '28': function(cardId) {                                     //タッチ方向：右向き(90度)かつ、画面下方向に10mm程度移動検知　でID認証した場合
                console.log('RN=28, ',cardId,", r=",parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))," , X= ",parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))," , Y= ",parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))," , A= ",parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1)));
                document.getElementById('name').style.backgroundColor = "#baffab";           //5point揃って解析中は、表題の背景色を変える
                document.getElementById('i1message').style.color = "#adf1a2ff";
                document.getElementById("i1text").innerHTML+="RN=28, " + cardId + ", r="+ parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))+", X="+parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))+", Y="+parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))+", A="+parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1))+ "<br>";
                setTimeout(() => { document.getElementById('name').style.backgroundColor = "transparent"; }, _cardConf.touchWaitTime);
		        return true;
            },
            '29': function(cardId) {                                     //タッチ方向：右向き(90度)かつ、画面右下方向に10mm程度移動検知　でID認証した場合
                console.log('RN=29, ',cardId,", r=",parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))," , X= ",parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))," , Y= ",parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))," , A= ",parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1)));
                document.getElementById('name').style.backgroundColor = "#baffab";           //5point揃って解析中は、表題の背景色を変える
                document.getElementById('i1message').style.color = "#6e7089ff";
                document.getElementById("i1text").innerHTML+="RN=29, " + cardId + ", r="+ parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))+", X="+parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))+", Y="+parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))+", A="+parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1))+ "<br>";
                setTimeout(() => { document.getElementById('name').style.backgroundColor = "transparent"; }, _cardConf.touchWaitTime);
		        return true;
            },
            '32': function(cardId) {                                     //タッチ方向：後向き(180度)かつ、画面下方向に10mm程度移動検知　でID認証した場合
                console.log('RN=32, ',cardId,", r=",parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))," , X= ",parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))," , Y= ",parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))," , A= ",parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1)));
                document.getElementById('name').style.backgroundColor = "#baffab";           //5point揃って解析中は、表題の背景色を変える
                document.getElementById('i1message').style.color = "#980909ff";
                document.getElementById("i1text").innerHTML+="RN=32, " + cardId + ", r="+ parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))+", X="+parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))+", Y="+parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))+", A="+parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1))+ "<br>";
                setTimeout(() => { document.getElementById('name').style.backgroundColor = "transparent"; }, _cardConf.touchWaitTime);
		        return true;
            },
            '33': function(cardId) {                                     //タッチ方向：後向き(180度)かつ、面上方向に10mm程度移動検知　でID認証した場合
                console.log('RN=33, ',cardId,", r=",parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))," , X= ",parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))," , Y= ",parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))," , A= ",parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1)));
                document.getElementById('name').style.backgroundColor = "#baffab";           //5point揃って解析中は、表題の背景色を変える
                document.getElementById('i1message').style.color = "#0b1abaff";
                document.getElementById("i1text").innerHTML+="RN=33, " + cardId + ", r="+ parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))+", X="+parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))+", Y="+parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))+", A="+parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1))+ "<br>";
                setTimeout(() => { document.getElementById('name').style.backgroundColor = "transparent"; }, _cardConf.touchWaitTime);
		        return true;
            },
            '34': function(cardId) {                                     //タッチ方向：後向き(180度)かつ、画面右方向に10mm程度移動検知　でID認証した場合
                console.log('RN=34, ',cardId,", r=",parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))," , X= ",parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))," , Y= ",parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))," , A= ",parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1)));
                document.getElementById('name').style.backgroundColor = "#baffab";           //5point揃って解析中は、表題の背景色を変える
                document.getElementById('i1message').style.color = "#4b8b44ff";
                document.getElementById("i1text").innerHTML+="RN=34, " + cardId + ", r="+ parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))+", X="+parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))+", Y="+parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))+", A="+parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1))+ "<br>";
                setTimeout(() => { document.getElementById('name').style.backgroundColor = "transparent"; }, _cardConf.touchWaitTime);
		        return true;
            },
            '35': function(cardId) {                                     //タッチ方向：後向き(180度)かつ、画面左方向に10mm程度移動検知　でID認証した場合
                console.log('RN=35, ',cardId,", r=",parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))," , X= ",parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))," , Y= ",parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))," , A= ",parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1)));
                document.getElementById('name').style.backgroundColor = "#baffab";           //5point揃って解析中は、表題の背景色を変える
                document.getElementById('i1message').style.color = "#f97705ff";
                document.getElementById("i1text").innerHTML+="RN=35, " + cardId + ", r="+ parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))+", X="+parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))+", Y="+parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))+", A="+parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1))+ "<br>";
                setTimeout(() => { document.getElementById('name').style.backgroundColor = "transparent"; }, _cardConf.touchWaitTime);
		        return true;
            },
            '36': function(cardId) {                                     //タッチ方向：前向き(180度)かつ、画面左方向に10mm程度移動検知　でID認証した場合
                console.log('RN=36, ',cardId,", r=",parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))," , X= ",parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))," , Y= ",parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))," , A= ",parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1)));
                document.getElementById('name').style.backgroundColor = "#baffab";           //5point揃って解析中は、表題の背景色を変える
                document.getElementById('i1message').style.color = "#f7e336ff";
                document.getElementById("i1text").innerHTML+="RN=36, " + cardId + ", r="+ parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))+", X="+parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))+", Y="+parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))+", A="+parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1))+ "<br>";
                setTimeout(() => { document.getElementById('name').style.backgroundColor = "transparent"; }, _cardConf.touchWaitTime);
		        return true;
            },
            '37': function(cardId) {                                     //タッチ方向：前向き(180度)かつ、画面左下方向に10mm程度移動検知　でID認証した場合
                console.log('RN=37, ',cardId,", r=",parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))," , X= ",parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))," , Y= ",parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))," , A= ",parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1)));
                document.getElementById('name').style.backgroundColor = "#baffab";           //5point揃って解析中は、表題の背景色を変える
                document.getElementById('i1message').style.color = "#39dacfff";
                document.getElementById("i1text").innerHTML+="RN=37, " + cardId + ", r="+ parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))+", X="+parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))+", Y="+parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))+", A="+parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1))+ "<br>";
                setTimeout(() => { document.getElementById('name').style.backgroundColor = "transparent"; }, _cardConf.touchWaitTime);
		        return true;
            },
            '38': function(cardId) {                                     //タッチ方向：前向き(180度)かつ、画面下方向に10mm程度移動検知　でID認証した場合
                console.log('RN=38, ',cardId,", r=",parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))," , X= ",parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))," , Y= ",parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))," , A= ",parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1)));
                document.getElementById('name').style.backgroundColor = "#baffab";           //5point揃って解析中は、表題の背景色を変える
                document.getElementById('i1message').style.color = "#06450dff";
                document.getElementById("i1text").innerHTML+="RN=38, " + cardId + ", r="+ parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))+", X="+parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))+", Y="+parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))+", A="+parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1))+ "<br>";
                setTimeout(() => { document.getElementById('name').style.backgroundColor = "transparent"; }, _cardConf.touchWaitTime);
		        return true;
            },
            '39': function(cardId) {                                     //タッチ方向：前向き(180度)かつ、画面右下方向に10mm程度移動検知　でID認証した場合
                console.log('RN=39, ',cardId,", r=",parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))," , X= ",parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))," , Y= ",parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))," , A= ",parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1)));
                document.getElementById('name').style.backgroundColor = "#baffab";           //5point揃って解析中は、表題の背景色を変える
                document.getElementById('i1message').style.color = "#f09041ff";
                document.getElementById("i1text").innerHTML+="RN=39, " + cardId + ", r="+ parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))+", X="+parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))+", Y="+parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))+", A="+parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1))+ "<br>";
                setTimeout(() => { document.getElementById('name').style.backgroundColor = "transparent"; }, _cardConf.touchWaitTime);
		        return true;
            },
            '42': function(cardId) {                                     //タッチ方向：左向き(270度)かつ、面下方向に10mm程度移動検知　でID認証した場合
                console.log('RN=42, ',cardId,", r=",parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))," , X= ",parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))," , Y= ",parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))," , A= ",parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1)));
                document.getElementById('name').style.backgroundColor = "#baffab";           //5point揃って解析中は、表題の背景色を変える
                document.getElementById('i1message').style.color = "#6ff905ff";
                document.getElementById("i1text").innerHTML+="RN=42, " + cardId + ", r="+ parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))+", X="+parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))+", Y="+parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))+", A="+parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1))+ "<br>";
                setTimeout(() => { document.getElementById('name').style.backgroundColor = "transparent"; }, _cardConf.touchWaitTime);
		        return true;
            },
            '43': function(cardId) {                                     //タッチ方向：左向き(270度)かつ、面上方向に10mm程度移動検知　でID認証した場合
                console.log('RN=43, ',cardId,", r=",parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))," , X= ",parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))," , Y= ",parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))," , A= ",parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1)));
                document.getElementById('name').style.backgroundColor = "#baffab";           //5point揃って解析中は、表題の背景色を変える
                document.getElementById('i1message').style.color = "#525d62ff";
                document.getElementById("i1text").innerHTML+="RN=43, " + cardId + ", r="+ parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))+", X="+parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))+", Y="+parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))+", A="+parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1))+ "<br>";
                setTimeout(() => { document.getElementById('name').style.backgroundColor = "transparent"; }, _cardConf.touchWaitTime);
		        return true;
            },
            '44': function(cardId) {                                     //タッチ方向：左向き(270度)かつ、画面右方向に10mm程度移動検知　でID認証した場合
                console.log('RN=44, ',cardId,", r=",parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))," , X= ",parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))," , Y= ",parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))," , A= ",parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1)));
                document.getElementById('name').style.backgroundColor = "#baffab";           //5point揃って解析中は、表題の背景色を変える
                document.getElementById('i1message').style.color = "#aef765ff";
                document.getElementById("i1text").innerHTML+="RN=44, " + cardId + ", r="+ parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))+", X="+parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))+", Y="+parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))+", A="+parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1))+ "<br>";
                setTimeout(() => { document.getElementById('name').style.backgroundColor = "transparent"; }, _cardConf.touchWaitTime);
		        return true;
            },
            '45': function(cardId) {                                     //タッチ方向：左向き(270度)かつ、画面左方向に10mm程度移動検知　でID認証した場合
                console.log('RN=45, ',cardId,", r=",parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))," , X= ",parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))," , Y= ",parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))," , A= ",parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1)));
                document.getElementById('name').style.backgroundColor = "#baffab";           //5point揃って解析中は、表題の背景色を変える
                document.getElementById('i1message').style.color = "#f77a7aff";
                document.getElementById("i1text").innerHTML+="RN=45, " + cardId + ", r="+ parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))+", X="+parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))+", Y="+parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))+", A="+parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1))+ "<br>";
                setTimeout(() => { document.getElementById('name').style.backgroundColor = "transparent"; }, _cardConf.touchWaitTime);
		        return true;
            },
            '46': function(cardId) {                                     //タッチ方向：前向き(270度)かつ、画面左方向に10mm程度移動検知　でID認証した場合
                console.log('RN=46, ',cardId,", r=",parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))," , X= ",parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))," , Y= ",parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))," , A= ",parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1)));
                document.getElementById('name').style.backgroundColor = "#baffab";           //5point揃って解析中は、表題の背景色を変える
                document.getElementById('i1message').style.color = "#f7e336ff";
                document.getElementById("i1text").innerHTML+="RN=46, " + cardId + ", r="+ parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))+", X="+parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))+", Y="+parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))+", A="+parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1))+ "<br>";
                setTimeout(() => { document.getElementById('name').style.backgroundColor = "transparent"; }, _cardConf.touchWaitTime);
		        return true;
            },
            '47': function(cardId) {                                     //タッチ方向：前向き(270度)かつ、画面左下方向に10mm程度移動検知　でID認証した場合
                console.log('RN=47, ',cardId,", r=",parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))," , X= ",parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))," , Y= ",parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))," , A= ",parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1)));
                document.getElementById('name').style.backgroundColor = "#baffab";           //5point揃って解析中は、表題の背景色を変える
                document.getElementById('i1message').style.color = "#39dacfff";
                document.getElementById("i1text").innerHTML+="RN=47, " + cardId + ", r="+ parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))+", X="+parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))+", Y="+parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))+", A="+parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1))+ "<br>";
                setTimeout(() => { document.getElementById('name').style.backgroundColor = "transparent"; }, _cardConf.touchWaitTime);
		        return true;
            },
            '48': function(cardId) {                                     //タッチ方向：前向き(270度)かつ、画面下方向に10mm程度移動検知　でID認証した場合
                console.log('RN=48, ',cardId,", r=",parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))," , X= ",parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))," , Y= ",parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))," , A= ",parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1)));
                document.getElementById('name').style.backgroundColor = "#baffab";           //5point揃って解析中は、表題の背景色を変える
                document.getElementById('i1message').style.color = "#06450dff";
                document.getElementById("i1text").innerHTML+="RN=48, " + cardId + ", r="+ parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))+", X="+parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))+", Y="+parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))+", A="+parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1))+ "<br>";
                setTimeout(() => { document.getElementById('name').style.backgroundColor = "transparent"; }, _cardConf.touchWaitTime);
		        return true;
            },
            '49': function(cardId) {                                     //タッチ方向：前向き(270度)かつ、画面右下方向に10mm程度移動検知　でID認証した場合
                console.log('RN=49, ',cardId,", r=",parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))," , X= ",parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))," , Y= ",parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))," , A= ",parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1)));
                document.getElementById('name').style.backgroundColor = "#baffab";           //5point揃って解析中は、表題の背景色を変える
                document.getElementById('i1message').style.color = "#f09041ff";
                document.getElementById("i1text").innerHTML+="RN=49, " + cardId + ", r="+ parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1))+", X="+parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1))+", Y="+parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1))+", A="+parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1))+ "<br>";
                setTimeout(() => { document.getElementById('name').style.backgroundColor = "transparent"; }, _cardConf.touchWaitTime);
		        return true;
            },
            //
                       
            /* カード解析エラー発生時に呼ばれる処理 */
            'error': function(errorCode, errorMessage, errorId) { // _cardConf.onErrorCallbackKey: function(errorCode, errorMessage, errorId) {
                /*
                 * errorCode 0: 正常, 1: 識別エラー, 3: 処理エラー
                 * エラーコードが1の場合は無視しても問題ないが3の場合は処理に何らかの不具合が発生した場合となるので要状況確認
                 * ※ エラー発生時に「analyzer.stop();」でタッチイベントの観測を停止させる事も可能
                 * errorIdに値がある時は解析結果が不完全(カード自体は識別できたが持ち手が識別できなかった場合)
                 */
                /* 必要に応じて処理を実装 */
                document.getElementById('name').style.backgroundColor = "#baffab";           //5point揃って解析中は、表題の背景色を変える

                console.log('[' + analyzer.getErrorMessage(errorCode) + ']', errorMessage, errorId," , rX= - , rY= - , rA= -");
                setTimeout(() => { document.getElementById('name').style.backgroundColor = "transparent"; }, _cardConf.touchWaitTime);

            }
        };
        
        /* 即時関数で環境確認 */
        var isPassive = false;	// パッシブ対応か否かを判定した結果を格納する
        (function() {
            try { 
                var options = Object.defineProperty({}, 'passive', { get: function() { isPassive = true; } });  
                window.addEventListener('test', options, options);  
                window.removeEventListener('test', options, options); 
            } catch (exception) { 
                isPassive = false; 
            }
        })();
        
        /* 各要素展開完了時にカードタッチ待受処理開始 */
        var readyFunc = function(e) {
            if (typeof initCtrl !== 'undefined') {
                analyzer = initCtrl(callbacks, cardConf);
                //analyzer.enableScrollAction = true;// ←1本指での操作を許容する場合はコメントアウトを解除(スクロール、対象を要素にした場合はクリックイベントにも影響有り)
            }
            console.log(e);             //20250423
        };
        
        /* 読込完了イベントを設定 */
        (function(){
	        window.addEventListener('DOMContentLoaded', readyFunc, isPassive ? {passive: false, capture: false} : false);
        })();

    </script>
        
</head>
        
<body>
<div id="contents">	
    <h1 id="name" style="background-color:transparent;">C-Card SDK Sample6</h1>
    	<p id="i1message" style="font-size: 7vw;">Multi touch card touched</p>
		<p id="i1text" style="font-size: 5vw;">サンプルのタッチ方向を前向き、後向き、左向き、右向きと変えてタッチして、右、右上、上、左上、左、左下、下、右下に１ｃｍ程度動かす。<br></p>	
	<!-- ↑↑↑ 別ページに遷移しない場合の実装例、以下のパラメータを使わない。↑↑↑ -->             
    <!--    'defaultContentsId': 'default_contents',		// 初期表示要素のID
            'variableContentsClass': '.variable_contents',	// 動的表示切替要素のクラス↑↑↑ -->
</div>

<!-- ↓↓↓ 効果音(使用する場合cardConf.okSoundElemId|cardConf.ngSoundElemIdの値とid属性値を合わせる事) ↓↓↓ -->
<div id="callback_audio">
    <audio src="./res/beeps/pass.mp3" id="beep_ok"></audio>
    <audio src="./res/beeps/warning.mp3" id="beep_ng"></audio>
</div>
<!-- ↑↑↑ 効果音(使用する場合cardConf.okSoundElemId|cardConf.ngSoundElemIdの値とid属性値を合わせる事) ↑↑↑ -->


<!-- ↓↓↓ 効果音初期化用モーダル(この要素を定義しない場合効果音は再生されない) ↓↓↓ -->
<div id="init_modal">
	<div id="init_modal_box">
		<div id="init_modal_title">Let's Try!!</div>
		<div id="init_modal_message">マルチタッチカードで画面にタッチして下さい</div>
		<div id="init_modal_done">OK</div>
	</div>
</div>
<!-- ↑↑↑ 効果音初期化用モーダル(この要素を定義しない場合効果音は再生されない) ↑↑↑ -->

</body>
</html>