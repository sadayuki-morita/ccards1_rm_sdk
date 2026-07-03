<?php
/**
 * カードタッチページ　タッチ方向判定、動作判定認証バージョン
 *
 * @author  Multi touch LLC.
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
    <title>C-Card SDK Sample3</title>
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
            'motionDetectNum' : [0,0,0,0,0,0,0,0],          // motion制御指定配列（配列の要素番号 0:motion制御有、1:設定なし(0 or -1固定)、2:下、3:上、4:左、5:右、6:右回転、7:左回転 の値を 閾値制御の場合 1 疑似アナログ制御の場合 2 にする。例えば、上下を閾値制御、左右回転をアナログ制御したい場合は、[2,-1,1,1,0,0,2,2]と指定する）
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
            'motionDetectNum' : [2,-1,1,1,1,1,2,2],          // motion制御指定配列（配列の要素番号 0:motion制御有、1:設定なし(0 or -1固定)、2:下、3:上、4:右、5:左、6:左回転、7:右回転 の値を 閾値制御の場合 1 疑似アナログ制御の場合 2 にする。例えば、上下を閾値制御、左右回転をアナログ制御したい場合は、[2,-1,1,1,0,0,2,2]と指定する）
        };
        /*/ ↑↑↑ この変数は必要に応じて有効化して下さい ↑↑↑ */

        /****************************************************************
         * カード解析時に呼ばれる処理群
         * 実装時は下記スクリプトを編集してご利用下さい
         ****************************************************************/

        var preFonrSizeValue = 7;                           //回転動作のフォントサイズ初期値

        var callbacks = {
            /* カード解析開始直前に呼ばれる処理 */
            'start': function() {
                /* 必要に応じて処理を実装 */
                document.getElementById('name').style.backgroundColor = "#baffab";           //5point揃って解析中は、表題の背景色を変える

                console.log('start_analyze');
            },
        
            /* S1系カードでタッチした時に呼ばれる処理 */
            '2': function(cardId) {                                     //画面下に10m程度移動検知した場合

                document.getElementById('name').style.backgroundColor = "#transparent";         //認証後は、表題の背景色を戻す。
 
                let resultData = 'RN=2<br>'+ cardId + "<br>r=" + parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1)) + "<br>X= " + parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1)) + ", Y= "+ parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1)) + ", A= " + parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1));
                console.log(resultData);
                document.getElementById("i1text").innerHTML=resultData;

                document.getElementById('i1message').style.color = "#f90505ff";           //動作方向に依って文字色を変える

		        return true;
            },

            '3': function(cardId) {                                     //画面下に10mm程度移動検知した場合

                document.getElementById('name').style.backgroundColor = "#transparent";         //認証後は、表題の背景色を戻す。
 
                let resultData = 'RN=3<br>'+ cardId + "<br>r=" + parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1)) + "<br>X= " + parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1)) + ", Y= "+ parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1)) + ", A= " + parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1));
                console.log(resultData);
                document.getElementById("i1text").innerHTML=resultData;

                document.getElementById('i1message').style.color = "#36fa05dd";           //動作方向に依って文字色を変える

		        return true;
            },

            '4': function(cardId) {                                     //画面右に10mm程度移動検知した場合

                document.getElementById('name').style.backgroundColor = "#transparent";         //認証後は、表題の背景色を戻す。
 
                let resultData = 'RN=4<br>'+ cardId + "<br>r=" + parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1)) + "<br>X= " + parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1)) + ", Y= "+ parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1)) + ", A= " + parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1));
                console.log(resultData);
                document.getElementById("i1text").innerHTML=resultData;

                document.getElementById('i1message').style.color = "#0c1edfbb";           //動作方向に依って文字色を変える

		        return true;
            },
            
            '5': function(cardId) {                                     //画面左に10mm程度移動検知した場合

                document.getElementById('name').style.backgroundColor = "#transparent";         //認証後は、表題の背景色を戻す。
 
                let resultData = 'RN=5<br>'+ cardId + "<br>r=" + parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1)) + "<br>X= " + parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1)) + ", Y= "+ parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1)) + ", A= " + parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1));
                console.log(resultData);
                document.getElementById("i1text").innerHTML=resultData;

                document.getElementById('i1message').style.color = "#f0900aff";           //動作方向に依って文字色を変える

		        return true;
            },

            '6': function(cardId){                                     //反時計回り（左回り）に回転角度閾値回転した場合

                document.getElementById('name').style.backgroundColor = "#transparent";         //認証後は、表題の背景色を戻す。

                let fontSizeValue = preFonrSizeValue + (1 + parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(2)));           //フォントサイズ拡大

                if(fontSizeValue < 3 || fontSizeValue > 20){
                    fontSizeValue = preFonrSizeValue;
                }

                document.getElementById('i1message').style.fontSize = fontSizeValue + "vw";
                preFonrSizeValue = fontSizeValue;
                console.log("fontSizeValue=",fontSizeValue);

                let resultData = 'RN=6<br>'+ cardId + "<br>r=" + parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1)) + "<br>X= " + parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1)) + ", Y= "+ parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1)) + ", A= " + parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1));
                console.log(resultData);
                document.getElementById("i1text").innerHTML=resultData;

                _cardAnalyzer.motionAnalogOut = [0,0,0,0];

                return true;                
            },


            '7': function(cardId){                                     //時計回りに（右回り）回転角度閾値回転した場合

                document.getElementById('name').style.backgroundColor = "#transparent";         //認証後は、表題の背景色を戻す。

                let fontSizeValue = preFonrSizeValue - (1 + parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(2)));           //フォントサイズ縮小

                if(fontSizeValue < 3 || fontSizeValue > 20){
                    fontSizeValue = preFonrSizeValue;
                }

                document.getElementById('i1message').style.fontSize = fontSizeValue + "vw";
                preFonrSizeValue = fontSizeValue;
                console.log("fontSizeValue=",fontSizeValue);

                let resultData = 'RN=7<br>'+ cardId + "<br>r=" + parseFloat(_cardAnalyzer.touchAngleDeg.toFixed(1)) + "<br>X= " + parseFloat(_cardAnalyzer.motionAnalogOut[0].toFixed(1)) + ", Y= "+ parseFloat(_cardAnalyzer.motionAnalogOut[1].toFixed(1)) + ", A= " + parseFloat(_cardAnalyzer.motionAnalogOut[2].toFixed(1));
                console.log(resultData);
                document.getElementById("i1text").innerHTML=resultData;

                _cardAnalyzer.motionAnalogOut = [0,0,0,0];

                return true;                
            },
		        /* ↑↑↑画面遷移しない場合の実装 trueを返却↑↑↑ */
        
            /* カード解析エラー発生時に呼ばれる処理 */
            'error': function(errorCode, errorMessage, errorId) { 
                /*
                 * errorCode 0: 正常, 1: 識別エラー, 3: 処理エラー
                 * エラーコードが1の場合は無視しても問題ないが3の場合は処理に何らかの不具合が発生した場合となるので要状況確認
                 * ※ エラー発生時に「analyzer.stop();」でタッチイベントの観測を停止させる事も可能
                 * errorIdに値がある時は解析結果が不完全(カード自体は識別できたが持ち手が識別できなかった場合)
                 */
                /* 必要に応じて処理を実装 */
                document.getElementById('name').style.backgroundColor = "#baffab";           //5point揃って解析中は、表題の背景色を変える

                console.log('[' + analyzer.getErrorMessage(errorCode) + ']', errorMessage, errorId," , rX= - , rY= - , rA= -");

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
    <h1 id="name" style="background-color:transparent;">C-Card SDK Sample3</h1>
    	<p id="i1message" style="font-size: 7vw;">Multi touch card touched</p>
		<p id="i1text" style="font-size: 5vw;">サンプルをタッチして、上、下、左、右に１ｃｍ程度動かす。または、左回り、右回りに動かす。</p>	
	<!-- ↑↑↑ 別ページに遷移しない場合の実装例(別ページに画面遷移する場合は不要) ↑↑↑ -->
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