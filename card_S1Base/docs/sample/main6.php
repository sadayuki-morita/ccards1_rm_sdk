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
    <title>C-Card SDK Sample6</title>
    <!-- ↓↓↓ 必須ファイルの読込 ↓↓↓ -->
	<script type="text/javascript" src="./script/ctrlrm.js" defer></script>
    <script type="text/javascript" src="./script/analyzerm-s1t4u3-ob.js" defer></script>
    <link rel="stylesheet" href="./css/style.css" />
    <!-- ↑↑↑ 必須ファイルの読込 ↑↑↑ -->
    <script>
        var analyzer = null;// カード解析処理

        /*******************************************************************************
         * カード解析処理制御設定 (実際に導入される際は解説関係のコメントは削除願います)
         * この設定値は初期値です。必要に応じて有効化して値を設定して下さい
         *******************************************************************************/
        /*/ ↓↓↓ この変数は必要に応じて有効化して下さい ↓↓↓ */
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
            'motionAnalogOut : [0,0,0,0,0,0],               // 動作変化のデルタ値(=変化量/閾値),重心座標格納 motionAnalogOut = [deltaX,deltaÝ,deltaangle,deltaTime,centroidX,centroidY]
            'touchAngleDeg : 0,                             // タッチ方向判定回転角
            'showErrorAlert : true,							// エラーアラート表示フラグ
            'initModalElemId : 'init_modal',				// メディア読込用モーダルの要素のID
            'initModalDoneElemId : 'init_modal_done',		// メディア読込用モーダルを閉じる(ボタン)要素のID
            'commonErrorMsg : 'カードが認識出来ませんでした。', // 汎用エラーメッセージ
        */
            'motionDetectNum' : [1,-1,1,1,1,1,0,0,0,0],     // motion制御指定配列（配列の要素番号 0:motion制御有、1:設定なし(0 or -1固定)、2～9:判定動作の指定、の値を 4条件閾値制御の場合 1、 疑似アナログ制御の場合 2、 8条件動作閾値判定の場合 3 にする。例えば、上下を閾値制御、左右をアナログ制御したい場合は、[2,-1,1,1,2,2,0,0,0,0]と指定する）
            'fixPosition' : false,                          // 動作判定、タッチ方向判定時のpositionの戻り値制御、false : position=analyze.point , true : position=1 cardId = cardId + "-" + analyze.point　＊動作判定、タッチ方向判定無しの場合、true/false関係なく callbacks['1']で、cardId = ID番号となる。
            'rotationDetect' : 1,                           // rotation判定指定配列（0:rotation判定無、1:rotation判定有、{判定有の場合、タッチパネルX座標軸の＋方向ベクトルと基準電極原点側から遠端側に向かうベクトルのなす角0°：callback.point=1、90°：2、180°：3、270°：4}とする。）
            'cardIdNum' : ["S1-57","S1-107","S1-582"],                            //認証判定するID
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
                resultData = '<br>RN = 1<br><br>'+ cardId + "<br>r=" + parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1)) + "<br>X= " + parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1)) + ", Y= "+ parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1)) + ", A= " + parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1));
                console.log(resultData);
                document.getElementById(cardId + "_" + "i1text1").innerHTML=resultData;
		        return true;
            },
            //

            // タッチ方向判定 'position番号' = '10'〜'40'　設定：cardConf.rotationDetect = 1, cardConf.motionDetectNum[0] = 0
            '10': function(cardId) {                                     //タッチ方向：前向き(0度)　でID認証した場合
                resultData = '<br>RN = 10<br><br>'+ cardId + "<br>r=" + parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1)) + "<br>X= " + parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1)) + ", Y= "+ parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1)) + ", A= " + parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1));
                console.log(resultData);
                document.getElementById(cardId + "_" + "i1text10").innerHTML=resultData;
		        return true;
            },
            '20': function(cardId) {                                     //タッチ方向：右向き(90度)　でID認証した場合
                resultData = '<br>RN = 20<br><br>'+ cardId + "<br>r=" + parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1)) + "<br>X= " + parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1)) + ", Y= "+ parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1)) + ", A= " + parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1));
                console.log(resultData);
                document.getElementById(cardId + "_" + "i1text20").innerHTML=resultData;
		        return true;
            },
            '30': function(cardId) {                                     //タッチ方向：後向き(180度)　でID認証した場合
                resultData = '<br>RN = 30<br><br>'+ cardId + "<br>r=" + parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1)) + "<br>X= " + parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1)) + ", Y= "+ parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1)) + ", A= " + parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1));
                console.log(resultData);
                document.getElementById(cardId + "_" + "i1text30").innerHTML=resultData;
		        return true;
            },
            '40': function(cardId) {                                     //タッチ方向：左向き(270度)　でID認証した場合
                resultData = '<br>RN = 40<br><br>'+ cardId + "<br>r=" + parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1)) + "<br>X= " + parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1)) + ", Y= "+ parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1)) + ", A= " + parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1));
                console.log(resultData);
                document.getElementById(cardId + "_" + "i1text40").innerHTML=resultData;
		        return true;
            },
            //

            // 動作判定 'position番号' = '2'〜'5'　設定：cardConf.rotationDetect = 0, cardConf.motionDetectNum[0] = 1 又は 2
            '2': function(cardId) {                                     //画面下方向に10mm程度移動検知　でID認証した場合
                resultData = '<br>RN = 2<br><br>'+ cardId + "<br>r=" + parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1)) + "<br>X= " + parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1)) + ", Y= "+ parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1)) + ", A= " + parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1));
                console.log(resultData);
                document.getElementById(cardId + "_" + "i1text2").innerHTML=resultData;
		        return true;
            },
            '3': function(cardId) {                                     //画面上方向に10mm程度移動検知　でID認証した場合
                resultData = '<br>RN = 3<br><br>'+ cardId + "<br>r=" + parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1)) + "<br>X= " + parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1)) + ", Y= "+ parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1)) + ", A= " + parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1));
                console.log(resultData);
                document.getElementById(cardId + "_" + "i1text3").innerHTML=resultData;
		        return true;
            },
            '4': function(cardId) {                                     //画面右方向に10mm程度移動検知　でID認証した場合
                resultData = '<br>RN = 4<br><br>'+ cardId + "<br>r=" + parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1)) + "<br>X= " + parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1)) + ", Y= "+ parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1)) + ", A= " + parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1));
                console.log(resultData);
                document.getElementById(cardId + "_" + "i1text4").innerHTML=resultData;
		        return true;
            },
            '5': function(cardId) {                                     //画面左方向に10mm程度移動検知　でID認証した場合
                resultData = '<br>RN = 5<br><br>'+ cardId + "<br>r=" + parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1)) + "<br>X= " + parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1)) + ", Y= "+ parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1)) + ", A= " + parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1));
                console.log(resultData);
                document.getElementById(cardId + "_" + "i1text5").innerHTML=resultData;
		        return true;
            },
*/
            // タッチ方向判定×動作判定 'position番号' = '12'〜'45'　設定：cardConf.rotationDetect = 1, cardConf.motionDetectNum[0] = 1 又は 2
            '12': function(cardId) {                                     //タッチ方向：前向き(0度)かつ、面下方向に10mm程度移動検知　でID認証した場合
                resultData = '<br>RN = 12<br><br>'+ cardId + "<br>r=" + parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1)) + "<br>X= " + parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1)) + ", Y= "+ parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1)) + ", A= " + parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1));
                console.log(resultData);
                document.getElementById(cardId + "_" + "i1text12").innerHTML=resultData;
		        return true;
            },
            '13': function(cardId) {                                     //タッチ方向：前向き(0度)かつ、面上方向に10mm程度移動検知　でID認証した場合
                resultData = '<br>RN = 13<br><br>'+ cardId + "<br>r=" + parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1)) + "<br>X= " + parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1)) + ", Y= "+ parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1)) + ", A= " + parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1));
                console.log(resultData);
                document.getElementById(cardId + "_" + "i1text13").innerHTML=resultData;
		        return true;
            },
            '14': function(cardId) {                                     //タッチ方向：前向き(0度)かつ、画面右方向に10mm程度移動検知　でID認証した場合
                resultData = '<br>RN = 14<br><br>'+ cardId + "<br>r=" + parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1)) + "<br>X= " + parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1)) + ", Y= "+ parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1)) + ", A= " + parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1));
                console.log(resultData);
                document.getElementById(cardId + "_" + "i1text14").innerHTML=resultData;
		        return true;
            },
            '15': function(cardId) {                                     //タッチ方向：前向き(0度)かつ、画面左方向に10mm程度移動検知　でID認証した場合
                resultData = '<br>RN = 15<br><br>'+ cardId + "<br>r=" + parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1)) + "<br>X= " + parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1)) + ", Y= "+ parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1)) + ", A= " + parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1));
                console.log(resultData);
                document.getElementById(cardId + "_" + "i1text15").innerHTML=resultData;
		        return true;
            },

            '22': function(cardId) {                                     //タッチ方向：右向き(90度)かつ、面下方向に10mm程度移動検知　でID認証した場合
                resultData = '<br>RN = 22<br><br>'+ cardId + "<br>r=" + parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1)) + "<br>X= " + parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1)) + ", Y= "+ parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1)) + ", A= " + parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1));
                console.log(resultData);
                document.getElementById(cardId + "_" + "i1text22").innerHTML=resultData;
		        return true;
            },
            '23': function(cardId) {                                     //タッチ方向：右向き(90度)かつ、面上方向に10mm程度移動検知　でID認証した場合
                resultData = '<br>RN = 23<br><br>'+ cardId + "<br>r=" + parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1)) + "<br>X= " + parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1)) + ", Y= "+ parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1)) + ", A= " + parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1));
                console.log(resultData);
                document.getElementById(cardId + "_" + "i1text23").innerHTML=resultData;
		        return true;
            },
            '24': function(cardId) {                                     //タッチ方向：右向き(90度)かつ、画面右方向に10mm程度移動検知　でID認証した場合
                resultData = '<br>RN = 24<br><br>'+ cardId + "<br>r=" + parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1)) + "<br>X= " + parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1)) + ", Y= "+ parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1)) + ", A= " + parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1));
                console.log(resultData);
                document.getElementById(cardId + "_" + "i1text24").innerHTML=resultData;
		        return true;
            },
            '25': function(cardId) {                                     //タッチ方向：右向き(90度)かつ、画面左方向に10mm程度移動検知　でID認証した場合
                resultData = '<br>RN = 25<br><br>'+ cardId + "<br>r=" + parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1)) + "<br>X= " + parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1)) + ", Y= "+ parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1)) + ", A= " + parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1));
                console.log(resultData);
                document.getElementById(cardId + "_" + "i1text25").innerHTML=resultData;
		        return true;
            },

            '32': function(cardId) {                                     //タッチ方向：後向き(180度)かつ、面下方向に10mm程度移動検知　でID認証した場合
                resultData = '<br>RN = 32<br><br>'+ cardId + "<br>r=" + parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1)) + "<br>X= " + parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1)) + ", Y= "+ parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1)) + ", A= " + parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1));
                console.log(resultData);
                document.getElementById(cardId + "_" + "i1text32").innerHTML=resultData;
		        return true;
            },
            '33': function(cardId) {                                     //タッチ方向：後向き(180度)かつ、面上方向に10mm程度移動検知　でID認証した場合
                resultData = '<br>RN = 33<br><br>'+ cardId + "<br>r=" + parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1)) + "<br>X= " + parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1)) + ", Y= "+ parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1)) + ", A= " + parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1));
                console.log(resultData);
                document.getElementById(cardId + "_" + "i1text33").innerHTML=resultData;
		        return true;
            },
            '34': function(cardId) {                                     //タッチ方向：後向き(180度)かつ、画面右方向に10mm程度移動検知　でID認証した場合
                resultData = '<br>RN = 34<br><br>'+ cardId + "<br>r=" + parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1)) + "<br>X= " + parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1)) + ", Y= "+ parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1)) + ", A= " + parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1));
                console.log(resultData);
                document.getElementById(cardId + "_" + "i1text34").innerHTML=resultData;
		        return true;
            },
            '35': function(cardId) {                                     //タッチ方向：後向き(180度)かつ、画面左方向に10mm程度移動検知　でID認証した場合
                resultData = '<br>RN = 35<br><br>'+ cardId + "<br>r=" + parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1)) + "<br>X= " + parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1)) + ", Y= "+ parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1)) + ", A= " + parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1));
                console.log(resultData);
                document.getElementById(cardId + "_" + "i1text35").innerHTML=resultData;
		        return true;
            },

            '42': function(cardId) {                                     //タッチ方向：左向き(270度)かつ、面下方向に10mm程度移動検知　でID認証した場合
                resultData = '<br>RN = 42<br><br>'+ cardId + "<br>r=" + parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1)) + "<br>X= " + parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1)) + ", Y= "+ parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1)) + ", A= " + parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1));
                console.log(resultData);
                document.getElementById(cardId + "_" + "i1text42").innerHTML=resultData;
		        return true;
            },
            '43': function(cardId) {                                     //タッチ方向：左向き(270度)かつ、面上方向に10mm程度移動検知　でID認証した場合
                resultData = '<br>RN = 43<br><br>'+ cardId + "<br>r=" + parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1)) + "<br>X= " + parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1)) + ", Y= "+ parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1)) + ", A= " + parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1));
                console.log(resultData);
                document.getElementById(cardId + "_" + "i1text43").innerHTML=resultData;
		        return true;
            },
            '44': function(cardId) {                                     //タッチ方向：左向き(270度)かつ、画面右方向に10mm程度移動検知　でID認証した場合
                resultData = '<br>RN = 44<br><br>'+ cardId + "<br>r=" + parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1)) + "<br>X= " + parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1)) + ", Y= "+ parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1)) + ", A= " + parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1));
                console.log(resultData);
                document.getElementById(cardId + "_" + "i1text44").innerHTML=resultData;
		        return true;
            },
            '45': function(cardId) {                                     //タッチ方向：左向き(270度)かつ、画面左方向に10mm程度移動検知　でID認証した場合
                resultData = '<br>RN = 45<br><br>'+ cardId + "<br>r=" + parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1)) + "<br>X= " + parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1)) + ", Y= "+ parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1)) + ", A= " + parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1));
                console.log(resultData);
                document.getElementById(cardId + "_" + "i1text45").innerHTML=resultData;
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
        };
        
        /* 読込完了イベントを設定 */
        (function(){
	        window.addEventListener('DOMContentLoaded', readyFunc, isPassive ? {passive: false, capture: false} : false);
        })();

    </script>
        
</head>
        
<body>

	<!-- デフォルトコンテンツ(初期表示) -->
	<div id="default_contents">
		<div data-role="page">
			<div data-role="content" id="main_contents">
                <h1 id="name" style="background-color:transparent;">C-Card SDK Sample6</h1>
		        <p id="howtouse" style="font-size: 5vw;">サンプルのタッチ方向を前向き、後向き、左向き、右向きと変えてタッチして、上、下、左、右に１ｃｍ程度動かす。<br></p>	
				<div id="resizeimage">
					<img id="ccard1" class="ccard img_contents" src="./img/touch.png" alt="main_image" />
				</div>
			</div>
		</div>
	</div>

	<!-- 表示コンテンツ カードID毎にcardIDをidとしたコンテンツブロックを記述する		  -->
<!-- 
    <div id="S1-57" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-57_i1text1" style="font-size: 7vw;">S1-57, id=1</p></div>
	<div id="S1-107" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-107_i1text1" style="font-size: 7vw;">S1-107, id=1</p></div>
	<div id="S1-582" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-582_i1text1" style="font-size: 7vw;">S1-582, id=1</p></div>
		
	<div id="S1-57_i2" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-57_i1text2" style="font-size: 7vw;">S1-57, id=2</p></div>
	<div id="S1-107_i2" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-107_i1text2" style="font-size: 7vw;">S1-107, id=2</p></div>
	<div id="S1-582_i2" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-582_i1text2" style="font-size: 7vw;">S1-582, id=2</p></div>
	<div id="S1-57_i3" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-57_i1text3" style="font-size: 7vw;">S1-57, id=3</p></div>
	<div id="S1-107_i3" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-107_i1text3" style="font-size: 7vw;">S1-107, id=3</p></div>
	<div id="S1-582_i3" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-582_i1text3" style="font-size: 7vw;">S1-582, id=3</p></div>
	<div id="S1-57_i4" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-57_i1text4" style="font-size: 7vw;">S1-57, id=4</p></div>
	<div id="S1-107_i4" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-107_i1text4" style="font-size: 7vw;">S1-107, id=4</p></div>
	<div id="S1-582_i4" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-582_i1text4" style="font-size: 7vw;">S1-582, id=4</p></div>
	<div id="S1-57_i5" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-57_i1text5" style="font-size: 7vw;">S1-57, id=5</p></div>
	<div id="S1-107_i5" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-107_i1text5" style="font-size: 7vw;">S1-107, id=5</p></div>
	<div id="S1-582_i5" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-582_i1text5" style="font-size: 7vw;">S1-582, id=5</p></div>

    <div id="S1-57_i10" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-57_i1text10" style="font-size: 7vw;">S1-57, id=10</p></div>
	<div id="S1-107_i10" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-107_i1text10" style="font-size: 7vw;">S1-107, id=10</p></div>
	<div id="S1-582_i10" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-582_i1text10" style="font-size: 7vw;">S1-582, id=10</p></div>
    <div id="S1-57_i20" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-57_i1text20" style="font-size: 7vw;">S1-57, id=20</p></div>
	<div id="S1-107_i20" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-107_i1text20" style="font-size: 7vw;">S1-107, id=20</p></div>
	<div id="S1-582_i20" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-582_i1text20" style="font-size: 7vw;">S1-582, id=20</p></div>
    <div id="S1-57_i30" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-57_i1text30" style="font-size: 7vw;">S1-57, id=30</p></div>
	<div id="S1-107_i30" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-107_i1text30" style="font-size: 7vw;">S1-107, id=30</p></div>
	<div id="S1-582_i30" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-582_i1text30" style="font-size: 7vw;">S1-582, id=30</p></div>
    <div id="S1-57_i40" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-57_i1text40" style="font-size: 7vw;">S1-57, id=40</p></div>
	<div id="S1-107_i40" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-107_i1text40" style="font-size: 7vw;">S1-107, id=40</p></div>
	<div id="S1-582_i40" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-582_i1text40" style="font-size: 7vw;">S1-582, id=40</p></div>
-->
	<div id="S1-57_i12" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-57_i1text12" style="font-size: 7vw;">S1-57, id=12</p></div>
	<div id="S1-107_i12" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-107_i1text12" style="font-size: 7vw;">S1-107, id=12</p></div>
	<div id="S1-582_i12" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-582_i1text12" style="font-size: 7vw;">aaa</p></div>
	<div id="S1-57_i13" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-57_i1text13" style="font-size: 7vw;">S1-57, id=13</p></div>
	<div id="S1-107_i13" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-107_i1text13" style="font-size: 7vw;">S1-107, id=13</p></div>
	<div id="S1-582_i13" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-582_i1text13" style="font-size: 7vw;">S1-582, id=13</p></div>
	<div id="S1-57_i14" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-57_i1text14" style="font-size: 7vw;">S1-57, id=14</p></div>
	<div id="S1-107_i14" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-107_i1text14" style="font-size: 7vw;">S1-107, id=14</p></div>
	<div id="S1-582_i14" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-582_i1text14" style="font-size: 7vw;">S1-582, id=14</p></div>
	<div id="S1-57_i15" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-57_i1text15" style="font-size: 7vw;">S1-57, id=15</p></div>
	<div id="S1-107_i15" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-107_i1text15" style="font-size: 7vw;">S1-107, id=15</p></div>
	<div id="S1-582_i15" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-582_i1text15" style="font-size: 7vw;">S1-582, id=15</p></div>
	<div id="S1-57_i22" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-57_i1text22" style="font-size: 7vw;">S1-57, id=22</p></div>
	<div id="S1-107_i22" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-107_i1text22" style="font-size: 7vw;">S1-107, id=22</p></div>
	<div id="S1-582_i22" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-582_i1text22" style="font-size: 7vw;">S1-582, id=22</p></div>
	<div id="S1-57_i23" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-57_i1text23" style="font-size: 7vw;">S1-57, id=23</p></div>
	<div id="S1-107_i23" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-107_i1text23" style="font-size: 7vw;">S1-107, id=23</p></div>
	<div id="S1-582_i23" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-582_i1text23" style="font-size: 7vw;">S1-582, id=23</p></div>
	<div id="S1-57_i24" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-57_i1text24" style="font-size: 7vw;">S1-57, id=24</p></div>
	<div id="S1-107_i24" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-107_i1text24" style="font-size: 7vw;">S1-107, id=24</p></div>
	<div id="S1-582_i24" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-582_i1text24" style="font-size: 7vw;">S1-582, id=24</p></div>
	<div id="S1-57_i25" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-57_i1text25" style="font-size: 7vw;">S1-57, id=25</p></div>
	<div id="S1-107_i25" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-107_i1text25" style="font-size: 7vw;">S1-107, id=25</p></div>
	<div id="S1-582_i25" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-582_i1text25" style="font-size: 7vw;">S1-582, id=25</p></div>
	<div id="S1-57_i32" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-57_i1text32" style="font-size: 7vw;">S1-57, id=32</p></div>
	<div id="S1-107_i32" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-107_i1text32" style="font-size: 7vw;">S1-107, id=32</p></div>
	<div id="S1-582_i32" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-582_i1text32" style="font-size: 7vw;">S1-582, id=32</p></div>
	<div id="S1-57_i33" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-57_i1text33" style="font-size: 7vw;">S1-57, id=33</p></div>
	<div id="S1-107_i33" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-107_i1text33" style="font-size: 7vw;">S1-107, id=33</p></div>
	<div id="S1-582_i33" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-582_i1text33" style="font-size: 7vw;">S1-582, id=33</p></div>
	<div id="S1-57_i34" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-57_i1text34" style="font-size: 7vw;">S1-57, id=34</p></div>
	<div id="S1-107_i34" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-107_i1text34" style="font-size: 7vw;">S1-107, id=34</p></div>
	<div id="S1-582_i34" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-582_i1text34" style="font-size: 7vw;">S1-582, id=34</p></div>
	<div id="S1-57_i35" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-57_i1text35" style="font-size: 7vw;">S1-57, id=35</p></div>
	<div id="S1-107_i35" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-107_i1text35" style="font-size: 7vw;">S1-107, id=35</p></div>
	<div id="S1-582_i35" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-582_i1text35" style="font-size: 7vw;">S1-582, id=35</p></div>
	<div id="S1-57_i42" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-57_i1text42" style="font-size: 7vw;">S1-57, id=42</p></div>
	<div id="S1-107_i42" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-107_i1text42" style="font-size: 7vw;">S1-107, id=42</p></div>
	<div id="S1-582_i42" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-582_i1text42" style="font-size: 7vw;">S1-582, id=42</p></div>
	<div id="S1-57_i43" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-57_i1text43" style="font-size: 7vw;">S1-57, id=43</p></div>
	<div id="S1-107_i43" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-107_i1text43" style="font-size: 7vw;">S1-107, id=43</p></div>
	<div id="S1-582_i43" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-582_i1text43" style="font-size: 7vw;">S1-582, id=43</p></div>
	<div id="S1-57_i44" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-57_i1text44" style="font-size: 7vw;">S1-57, id=44</p></div>
	<div id="S1-107_i44" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-107_i1text44" style="font-size: 7vw;">S1-107, id=44</p></div>
	<div id="S1-582_i44" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-582_i1text44" style="font-size: 7vw;">S1-582, id=44</p></div>
	<div id="S1-57_i45" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-57_i1text45" style="font-size: 7vw;">S1-57, id=45</p></div>
	<div id="S1-107_i45" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-107_i1text45" style="font-size: 7vw;">S1-107, id=45</p></div>
	<div id="S1-582_i45" class="variable_contents"><h1 style="background-color:transparent;">C-Card SDK Sample6</h1><p id="S1-582_i1text45" style="font-size: 7vw;">S1-582, id=45</p></div>


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