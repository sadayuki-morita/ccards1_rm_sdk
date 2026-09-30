# ccards1_rm_sdk

## 概要

- 2点式C-cardのタッチ方向×動作判定ID認証アナライザを用いたSDK作成ディレクトリ
- SDK作成方法は、2点式、3点式C−CardのID認証版とほぼ同じだが、判定モード別、HTMLの書き方別に参考例が5種類ある。
- 顧客の使う判定モードが判明している時はそのモードの参考例をデフォルㇳの判定仕様に合わせる。　　
- 作成した顧客向けSDKは、GitHubでは管理しない。/products の下に格納しておくこと。また、完成したSDKは、https://multi-touchcard.com/sdk/ の下でデバッグを行い、そこに残しておくこと。


## ディレクトリ構造

    ccards1_rm_sdk  
      - /card_S1Base            : SDK原本。これをコピーして新しいSDKを生成する。  
          - /c                  : conf.php , server.crt => conf.phpに暗号化したIDCodeをコピペする。server.crtで、期限管理する  
          - /css                : style.css
          - /docs               : User提供ドキュメント
            - /sample           : HTMLサンプルファイル    
          - /f                  : func.php => サーバ側function。復号化等の関数    
          - /img                : touch.png => サンプルページのタッチ領域表示  
          - /res/beeps          : pass.mp3 , warning.mp3 => Pass , Fail の効果音  
          - /script             : analyzerm-s1t4u3-ob.js , cardrm-s1t4u3-ob.php , ctrlrm.js => アナライザソースファイル格納  
            - /c                : cs1.php => 提供SDKで使えるIDパターン。ファイル名は、cs1.php 固定    
          - index.php           : 初期アクセスページ。内容固定。   
          - main.php            : phpコードの下にHTMLコードが記載されている。
      - /cert_s1                : SDK作成途中生成ディレクトリ。GitHab管理対象外。  
      - /Documents              : SDKマニュアル、SDK作成方法説明資料、案件メモ(生成したSDKの product情報を記載)等  
      - /htmlSample             : main.php に記載するHTMLのサンプル例。現状のmain.php〜main5.phpに対応。  
      - /old                    : 旧バージョン。GitHab管理対象外。    
      - /products               : 作成した顧客向けSDKをそのまま格納。GitHab管理対象外。  
    　- /temp                   : IDコードの暗号化のための途中生成ファイル。GitHab管理対象外。  
      - .gitignore              : GitHab管理対象外指定。   
      - cs1base_20250625.php    : IDコードのコード化した配列ファイル  
      - openssl_encrypt_s1.php  : 暗号化処理php  
      - README.md  


## SDKの基本的な作成方法

  - 詳細は、PKB_SDK_20250526/マルチタッチカードSDK(2点式)について.md に記載。
  - また、/tempのconfv8_IDselect_gen_20260528.html をLive Server で開いて、IDとファイル名をInput欄に入れて実行すると、ダウンロードホルダにIDを抽出して暗号化したCONFV8配列が生成出来る。


## アナライザバージョン

- analyzerm-s1t4u3-ob.js  Rev.4.0.1	20260918
- cardrm-s1t4u3-ob.js  Rev.3.0.6 20260925
- ctrlmr.js Rev.3.2.1 20260204

      
## 来歴

- GitHab管理のためデイレクトリ構造見直し。GitHab登録　20260703
- タッチ座標解析データ配列touchDataArryの3次元配列化 20260729
- 動作判定に45度方向判定追加。動作判定のOrigin IdとMotion Id の一致判定を追加。 20260828
- motionAnalogOut配列に重心座標追加、touchAnalysisEnable=falseの非解析用HTMLで、cardConfとID座標変換後座標配列のコンソール出力無し  20260929



