## マルチタッチカードSDK資料(2点式)

### SDK作成手順について
1. [新規SDKの領域を作成する](#SDK領域の作成)  
2. [証明書を新規作成する](#証明書の作成)  
3. [証明書をSDKに配置する](#証明書の配置)  
4. [カードIDに対応した暗号化文字列を作成する](#暗号化文字列の作成)  
5. [暗号化文字列を設定ファイルに記載する](#暗号化文字列を設定ファイルに記載する)  
6. [作成したSDKの動作確認を行う](#動作確認)  
  
### SDK有効期限の変更手順について
1. [証明書の有効期限を変更する](#証明書有効期限の変更)  
2. [証明書をSDKに配置する](#証明書の配置)   
  
### 参考資料  
* [証明書有効期限の確認方法](#有効期限確認方法)
* [カード解析処理について](#解析処理)  
  
<a id="SDK領域の作成"></a>
### SDK領域の作成
下記のBaseフォルダをコピーして案件用フォルダを作成します。  
* /pub_imlsdk/ccards1_sdk/card_S1Base/  
```
	cd /pub_imlsdk/ccards1_sdk
	cp -R ./card_S1Base ./card_案件名
```  
* 作成した案件用フォルダは、以降、/案件領域/ と表記します。    
  
<a id="証明書の作成"></a>
### 証明書の作成
案件ごとに作業用フォルダを作成してその中で行います。  
どの案件の証明書かがわかるフォルダを作成してください。    
* /pub_imlsdk/ccards1_sdk/cert_s1/作業フォルダ/  
  
1. 以下のコマンドで作業用フォルダを作成します。  
```	
	cd /pub_imlsdk/ccards1_sdk/cert_s1  
	mkdir 作業フォルダ名  
```
* 作成した作業用フォルダは、以降、/作業領域/ と表記します。  
  
2. 作業フォルダ内に移動し秘密鍵を生成します。  
```
	cd ./作業フォルダ名  
	openssl genrsa 2048 > server.key  
```
  
3. 下記コマンドで証明書署名を要求します。  
```
	openssl req -new -key server.key > server.csr  
```
  
* 要求処理では以下のように入力してください。  

```
	Country Name (2 letter code) []:JP  
	State or Province Name (full name) []:Tokyo  
	Locality Name (eg, city) []:Koto-ku  
	Organization Name (eg, company) []:Multi touch LLC.
	Organizational Unit Name (eg, section) []:  
	Common Name (eg, fully qualified host name) []:*.multi-touchcard.com
	Email Address []:  
  
	Please enter the following 'extra' attributes  
	to be sent with your certificate request  
	A challenge password []:  
```
  
4. サーバー証明書(server.crt と server0.crt)を有効期限365日で作成します。  
```
	openssl x509 -days 365 -req -signkey server.key < server.csr > server.crt
	openssl x509 -days 365 -req -signkey server.key < server.csr > server0.crt
```
  
5. 下記コマンドで証明書設定用ファイルを準備します。
```
	cp ../openssl.cnf ./

	mkdir ./cardCA
	mkdir ./cardCA/newcerts
	touch ./cardCA/index.txt
	echo 00 > ./cardCA/serial
```
  
6. 下記コマンドで証明書の有効期限を更新します。(2025-01-01 0:00:00～2025-12-31 23:59:59に設定する場合)
```
	openssl ca -config ./openssl.cnf -policy policy_anything -out server.crt -startdate 20250101000000Z -enddate 20251231235959Z -cert server0.crt -keyfile server.key -infiles server.csr
```  

<a id="証明書有効期限の変更"></a>
### 証明書の有効期限更新について
1. 証明書作成時の作業用フォルダに移動します。  
```
	cd /作業領域/
```  
  
2. 下記コマンドで、既存の index.txt ファイルをクリアします。  
```
	rm ./cardCA/index.txt  
	touch ./cardCA/index.txt
```
  
3. 下記コマンドで有効期限を更新します。(2025-01-01 0:00:00～2025-12-31 23:59:59に設定する場合)  
```
	openssl ca -config ./openssl.cnf -policy policy_anything -out server.crt -startdate 20250101000000Z -enddate 20251231235959Z -cert server0.crt -keyfile server.key -infiles server.csr
``` 
  
<a id="証明書の配置"></a>
### 証明書をSDKに配置する  
* 以下のコマンドで証明書(server.crt)を案件用フォルダに配置します。
```
	cp /作業領域/server.crt /案件領域/c/
```
  
<a id="有効期限確認方法"></a>
### 証明書有効期限の確認方法
下記コマンドで証明書の有効期限を確認できます。  
証明書ファイルが存在するフォルダで実行してください。  
```
	openssl x509 -dates -noout -in ./server.crt  
```
  
### カードの接点パターン一覧ファイルについて
* 2点式カード /pub_imlsdk/ccards1_sdk/cs1base_20250619.php  
  
	x 記載されている値は「オーブ C-Card V8 配列仕様」の値をBase64エンコードした値です。
	電極並びを原点に近い順のコードに修正したバージョン
	
  
  
### 接点パターンから暗号化文字列を生成するプログラム
* 2点式カード用 /pub_imlsdk/ccards1_sdk/openssl_encrypt.php  
  
  
<a id="暗号化文字列の作成"></a>  
### カードIDに対応した暗号化文字列を作成する手順  
上記「openssl_encrypt.php 」に認証するカードIDの設定を記述し実行することで、暗号化文字列を生成できます。  
* 使用方法
	1. $array に認証するカードIDのパターン(cs1base_20250619.phpに記載されている値)を「**IDの自然順で**」記述します。
	2. $keyFilePathに証明書作成に使用したserver.keyファイル(/作業領域/server.key)を記述します。
	3. $pathに案件の証明書ファイル(/案件領域/c/server.crt)を記述します。
	4. コマンドでプログラムを実行します。
```
	php /pub_imlsdk/ccards1_sdk/openssl_encrypt_s1.php > ob20260107.txt
```  
  
* $arrayに記述したカードIDの数、以下の項目が出力されます。
	* is valid：現在時刻 <= 証明書有効期限
	* raw：$arrayに設定したパターン文字列
	* encrypt：パターン文字列を秘密鍵で暗号化した文字列
	* decrypt：暗号化文字列を証明書で復号した文字列
	* matched：正しく復号できたのでOK、unmached：正しく復号できなかったのでどこかが間違っています。手順を再確認してください  
```
	is valid 2025/05/23 15:40:06 <= 2026/01/31/ 23:59:59
	raw: UzEtMTc3NjooMTQsMTIpOigyLDEwKTooOCw4KTooMCwyKTooMTQsMCk6MQ==
	encrypt: nnqy4NRpvYQdDD1IlfddJkt3AIOAGGy7/Q+juxvBIaCQJ+ZVEwOLpXD4YrNrkmN/Zqi+QeVmaN9OOP+nkjc8DV/HTkXaENwR91Za3VLV7/L6KtNBwbWXWPLuJk6ttYWztzYJyjDaNkjZFWYVuwRm8R6CsGdOo/mX2SZ73AutCzdcgErziicKwgV4gpRRGvrltUULARgHdIuS8SebB3Y7Ut+f1jjYQZqfDIXsbOFCXk7CzmWC6+2U+CiXTtklzKvT1ZvLmBrBKaggPwcTm1tADbPTSS9TQAe2iZ+s/oDCm5LV1jxcMM9w2klXswXtWJmQbG20iNJTVVqTiw+cWwOaRQ==
	decrypt: UzEtMTc3NjooMTQsMTIpOigyLDEwKTooOCw4KTooMCwyKTooMTQsMCk6MQ==
	matched
```  
  
<a id="暗号化文字列を設定ファイルに記載する"></a>  
### 暗号化文字列を設定ファイルに記載する  
	作成した暗号化文字列(上記encryptの値)を、SDKの設定ファイルに記載します。 

		grep "encrypt:" ob20260107.txt > encrypt20260107.txt

		抽出したファイルをVScodeで開いて encrypt20260107.txt　の各行の先頭を "encrypt: "から" ' "に置換、最後尾に" ', "を追加する。

	抽出から置換、最後尾の追加までをターミナルのコマンド1行で処理する場合

		grep "encrypt:" ob20260305.txt | sed 's/encrypt: /\x27/g' | sed 's/$/\x27,/' > encrypt20260305.txt

	この修正したtextをconf.phpにペーストする。
	

* 設定ファイルは、/案件領域/c/conf.php です。  
* この設定ファイルに記載されているカードのみ、認証が可能です。    
* $encryptConfigV8 および $encryptConfigV8r の両方に暗号化文字列を作成した順番で記載してください。  
  
<a id="動作確認"></a>  
### 作成したSDKの動作確認を行う 
作成した、/案件領域/ フォルダをブラウザで表示できる領域にコピーし、動作確認を行ってください。


<a id="解析処理"></a>  
### カード解析処理について
* カードをタッチしたときの解析処理は、/案件領域/script/cards1.php に記述されています。  
* 難読化前のソースは下記のとおりです。
	* /pub_imlsdk/ccards1_sdk/card_s1develop/script/cards1コメント除去JS版.php
	* /pub_imlsdk/ccards1_sdk/card_s1develop/script/cards1コメントありIS版.php
* 難読化には[JavaScript Obfuscator Tool](https://obfuscator.io/) 等を使用しています。

<a id="HTML方式別サンプル例"></a>  
### main.php 内のHTML記述サンプルについて
* タッチ方向動作判定のHTML記述、callback関数のサンプル例が5種類用意されています。main.phpファイルが異なっているので、使用するファイル名に応じて、 /c/conf.php内の12行目
	public static $touchUrl		= "./main.php";
のファイル名を変更するもしくは、使用するファイル名をmain.phpに変更してください。
サンプルファイル内容
	main.php ：ID認証して指定URLに遷移する（従来アナライザと同じ認証動作）
	main2.php：タッチ方向判定、IDはSDKに採用したIDすべて、コールバック関数＝1固定、バリアブルコンテンツ切り替え無し、タッチ方向毎に文字色変更
	main3.php：動作判定、アナログ動作判定あり、IDはSDKに採用したIDすべて、バリアブルコンテンツ切り替え無し、前後左右動作判定毎に文字色変更＋左右回転アナログ判定で文字サイズ変更
	main4.php：タッチ方向×動作判定、IDはSDKに採用したIDすべて、バリアブルコンテンツ切り替え無し、前後左右、左右回転動作判定毎に文字色変更
	main5.php：タッチ方向×動作判定、ID認証あり（3ID）、バリアブルコンテンツ切り替え有り、前後左右動作判定毎に表示文字変更

### 更新履歴
2025-05-23  初版作成(PKB岸田)  
2025-06-03  誤表記の修正(3点式→2点式)(PKB岸田)  
