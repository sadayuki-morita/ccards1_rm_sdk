<?php
// 実行コマンド
// php /home/mobile-hp/cmn_public/pub_imlsdk/ccards1_sdk/openssl_encrypt_s1.php

// 認証パターン一覧
// /home/mobile-hp/cmn_public/pub_imlsdk/ccards1_sdk/cs1base.php

//TODO 都度変更 上記パターン一覧から認証するカードの行を自然順で記述する
$array = array( //s1カード202209用

	'UzEtMjI3OigxNCwxMCk6KDgsOCk6KDIsNik6KDgsMCk6KDAsMCk6MQ==',// S1-227
	'UzEtMjQzOig0LDEyKTooMTQsMTApOig2LDYpOig4LDApOigwLDApOjE=',// S1-243
	'UzEtMjY2OigxNCwxMCk6KDIsMTApOig4LDgpOig4LDApOigwLDApOjE=',// S1-266
	'UzEtNTAwOigxNCwxMCk6KDgsOCk6KDIsNik6KDE0LDApOigwLDApOjE=',// S1-500
	'UzEtNTEyOig0LDEyKTooMTQsMTApOig2LDYpOigxNCwwKTooMCwwKTox',// S1-512
	'UzEtNTMxOigxNCwxMCk6KDIsMTApOig4LDgpOigxNCwwKTooMCwwKTox',// S1-531
	'UzEtNjA4OigxNCwxMCk6KDYsMTApOigwLDgpOig2LDIpOigwLDApOjE=',// S1-608
	'UzEtNjE4OigxNCwxMCk6KDIsMTApOig4LDgpOig2LDIpOigwLDApOjE=',// S1-618
	'UzEtNjI2OigwLDEyKTooMTQsMTApOig2LDEwKTooNiwyKTooMCwwKTox',// S1-626
	'UzEtNzk0OigxNCwxMCk6KDYsMTApOigwLDgpOigxMiwyKTooMCwwKTox',// S1-794
	'UzEtODA0OigxNCwxMCk6KDIsMTApOig4LDgpOigxMiwyKTooMCwwKTox',// S1-804
	'UzEtODEyOigwLDEyKTooMTQsMTApOig2LDEwKTooMTIsMik6KDAsMCk6MQ==',// S1-812
	'UzEtMTI4MzooMTQsMTIpOigyLDgpOig4LDYpOigwLDIpOig2LDApOjE=',// S1-1283
	'UzEtMTI4OTooMTQsMTIpOig2LDEyKTooOCw2KTooMCwyKTooNiwwKTox',// S1-1289
	'UzEtMTI5OTooMTQsMTIpOig0LDEyKTooMTAsNik6KDAsMik6KDYsMCk6MQ==',// S1-1299
	'UzEtMTMzNzooMTQsMTIpOig4LDEwKTooMiw4KTooMCwyKTooNiwwKTox',// S1-1337
	'UzEtMTMzOTooMTQsMTIpOigwLDEwKTooNiw4KTooMCwyKTooNiwwKTox',// S1-1339
	'UzEtMTM0MjooMTQsMTIpOigyLDEwKTooOCw4KTooMCwyKTooNiwwKTox',// S1-1342
	'UzEtMTM1MzooMTQsMTIpOigyLDEyKTooOCwxMCk6KDAsMik6KDYsMCk6MQ==',// S1-1353
	'UzEtMTQyNjooMTQsMTIpOig0LDgpOigxMCw2KTooMCwyKTooOCwwKTox',// S1-1426
	'UzEtMTQzNjooMTQsMTIpOigyLDgpOigxMiw2KTooMCwyKTooOCwwKTox',// S1-1436
	'UzEtMTQzODooMTQsMTIpOig2LDgpOigxMiw2KTooMCwyKTooOCwwKTox',// S1-1438
	'UzEtMTQ0NTooMTQsMTIpOig0LDEyKTooMTIsNik6KDAsMik6KDgsMCk6MQ==',// S1-1445
	'UzEtMTQ3MDooMTQsMTIpOig4LDEwKTooMiw4KTooMCwyKTooOCwwKTox',// S1-1470
	'UzEtMTQ3NTooMTQsMTIpOigyLDEwKTooOCw4KTooMCwyKTooOCwwKTox',// S1-1475
	'UzEtMTYxNDooMTQsMTIpOigyLDgpOig4LDYpOigwLDIpOigxMiwwKTox',// S1-1614
	'UzEtMTYyMDooMTQsMTIpOig2LDEyKTooOCw2KTooMCwyKTooMTIsMCk6MQ==',// S1-1620
	'UzEtMTYzMDooMTQsMTIpOig0LDEyKTooMTAsNik6KDAsMik6KDEyLDApOjE=',// S1-1630
	'UzEtMTY2ODooMTQsMTIpOig4LDEwKTooMiw4KTooMCwyKTooMTIsMCk6MQ==',// S1-1668
	'UzEtMTY3MDooMTQsMTIpOigwLDEwKTooNiw4KTooMCwyKTooMTIsMCk6MQ==',// S1-1670
	'UzEtMTY3MzooMTQsMTIpOigyLDEwKTooOCw4KTooMCwyKTooMTIsMCk6MQ==',// S1-1673
	'UzEtMTY4NDooMTQsMTIpOigyLDEyKTooOCwxMCk6KDAsMik6KDEyLDApOjE=',// S1-1684
	'UzEtMTc0OTooMTQsMTIpOig0LDgpOigxMCw2KTooMCwyKTooMTQsMCk6MQ==',// S1-1749
	'UzEtMTc1NzooMTQsMTIpOigyLDgpOigxMiw2KTooMCwyKTooMTQsMCk6MQ==',// S1-1757
	'UzEtMTc1OTooMTQsMTIpOig2LDgpOigxMiw2KTooMCwyKTooMTQsMCk6MQ==',// S1-1759
	'UzEtMTc2NDooMTQsMTIpOig0LDEyKTooMTIsNik6KDAsMik6KDE0LDApOjE=',// S1-1764
	'UzEtMTc3NDooMTQsMTIpOig4LDEwKTooMiw4KTooMCwyKTooMTQsMCk6MQ==',// S1-1774
	'UzEtMTc3NjooMTQsMTIpOigyLDEwKTooOCw4KTooMCwyKTooMTQsMCk6MQ==',// S1-1776

);

$array = array( //s1カード2022108DNP追加分
	'UzEtMjM3Oig2LDEyKTooMTQsMTApOig0LDYpOig4LDApOigwLDApOjE=',// S1-237
	'UzEtNTA4Oig2LDEyKTooMTQsMTApOig0LDYpOigxNCwwKTooMCwwKTox',// S1-508
);

$array = array( //s1カード20230614DNP追加分
	'UzEtMTI4NzooMTQsMTIpOigyLDEyKTooOCw2KTooMCwyKTooNiwwKTox',// S1-1287
	'UzEtMTYxODooMTQsMTIpOigyLDEyKTooOCw2KTooMCwyKTooMTIsMCk6MQ==',// S1-1618
);

$array = array( //s1カード20231110DNP2024年分 2024−05−16に2ID追加 2024-06-14に2ID追加
	'UzEtMjI3OigxNCwxMCk6KDgsOCk6KDIsNik6KDgsMCk6KDAsMCk6MQ==',// S1-227
	'UzEtMjM3Oig2LDEyKTooMTQsMTApOig0LDYpOig4LDApOigwLDApOjE=',// S1-237
	'UzEtMjQzOig0LDEyKTooMTQsMTApOig2LDYpOig4LDApOigwLDApOjE=',// S1-243
	'UzEtMjY2OigxNCwxMCk6KDIsMTApOig4LDgpOig4LDApOigwLDApOjE=',// S1-266
	'UzEtNTAwOigxNCwxMCk6KDgsOCk6KDIsNik6KDE0LDApOigwLDApOjE=',// S1-500
	'UzEtNTA4Oig2LDEyKTooMTQsMTApOig0LDYpOigxNCwwKTooMCwwKTox',// S1-508
	'UzEtNTEyOig0LDEyKTooMTQsMTApOig2LDYpOigxNCwwKTooMCwwKTox',// S1-512
	'UzEtNTMxOigxNCwxMCk6KDIsMTApOig4LDgpOigxNCwwKTooMCwwKTox',// S1-531
	'UzEtNjA4OigxNCwxMCk6KDYsMTApOigwLDgpOig2LDIpOigwLDApOjE=',// S1-608
	'UzEtNjE4OigxNCwxMCk6KDIsMTApOig4LDgpOig2LDIpOigwLDApOjE=',// S1-618
	'UzEtNjI2OigwLDEyKTooMTQsMTApOig2LDEwKTooNiwyKTooMCwwKTox',// S1-626 2024-05-16追加
	'UzEtNzk0OigxNCwxMCk6KDYsMTApOigwLDgpOigxMiwyKTooMCwwKTox',// S1-794
	'UzEtODA0OigxNCwxMCk6KDIsMTApOig4LDgpOigxMiwyKTooMCwwKTox',// S1-804
	'UzEtODEyOigwLDEyKTooMTQsMTApOig2LDEwKTooMTIsMik6KDAsMCk6MQ==',// S1-812 2024-05-16追加
	'UzEtMTI4MzooMTQsMTIpOigyLDgpOig4LDYpOigwLDIpOig2LDApOjE=',// S1-1283
	'UzEtMTI4OTooMTQsMTIpOig2LDEyKTooOCw2KTooMCwyKTooNiwwKTox',// S1-1289
	'UzEtMTI5OTooMTQsMTIpOig0LDEyKTooMTAsNik6KDAsMik6KDYsMCk6MQ==',// S1-1299
	'UzEtMTMzNzooMTQsMTIpOig4LDEwKTooMiw4KTooMCwyKTooNiwwKTox',// S1-1337
	'UzEtMTMzOTooMTQsMTIpOigwLDEwKTooNiw4KTooMCwyKTooNiwwKTox',// S1-1339
	'UzEtMTM0MjooMTQsMTIpOigyLDEwKTooOCw4KTooMCwyKTooNiwwKTox',// S1-1342
	'UzEtMTM1MzooMTQsMTIpOigyLDEyKTooOCwxMCk6KDAsMik6KDYsMCk6MQ==',// S1-1353
	'UzEtMTQyNjooMTQsMTIpOig0LDgpOigxMCw2KTooMCwyKTooOCwwKTox',// S1-1426 2024-06-14追加
	'UzEtMTQzNjooMTQsMTIpOigyLDgpOigxMiw2KTooMCwyKTooOCwwKTox',// S1-1436
	'UzEtMTQzODooMTQsMTIpOig2LDgpOigxMiw2KTooMCwyKTooOCwwKTox',// S1-1438
//	'UzEtMTQ0NTooMTQsMTIpOig0LDEyKTooMTIsNik6KDAsMik6KDgsMCk6MQ==',// S1-1445
	'UzEtMTQ3MDooMTQsMTIpOig4LDEwKTooMiw4KTooMCwyKTooOCwwKTox',// S1-1470
	'UzEtMTQ3NTooMTQsMTIpOigyLDEwKTooOCw4KTooMCwyKTooOCwwKTox',// S1-1475
	'UzEtMTYxNDooMTQsMTIpOigyLDgpOig4LDYpOigwLDIpOigxMiwwKTox',// S1-1614
	'UzEtMTYyMDooMTQsMTIpOig2LDEyKTooOCw2KTooMCwyKTooMTIsMCk6MQ==',// S1-1620
	'UzEtMTYzMDooMTQsMTIpOig0LDEyKTooMTAsNik6KDAsMik6KDEyLDApOjE=',// S1-1630
	'UzEtMTY2ODooMTQsMTIpOig4LDEwKTooMiw4KTooMCwyKTooMTIsMCk6MQ==',// S1-1668
	'UzEtMTY3MDooMTQsMTIpOigwLDEwKTooNiw4KTooMCwyKTooMTIsMCk6MQ==',// S1-1670
	'UzEtMTY3MzooMTQsMTIpOigyLDEwKTooOCw4KTooMCwyKTooMTIsMCk6MQ==',// S1-1673
	'UzEtMTY4NDooMTQsMTIpOigyLDEyKTooOCwxMCk6KDAsMik6KDEyLDApOjE=',// S1-1684
	'UzEtMTc0OTooMTQsMTIpOig0LDgpOigxMCw2KTooMCwyKTooMTQsMCk6MQ==',// S1-1749 2024-06-14追加
	'UzEtMTc1NzooMTQsMTIpOigyLDgpOigxMiw2KTooMCwyKTooMTQsMCk6MQ==',// S1-1757
	'UzEtMTc1OTooMTQsMTIpOig2LDgpOigxMiw2KTooMCwyKTooMTQsMCk6MQ==',// S1-1759
//	'UzEtMTc2NDooMTQsMTIpOig0LDEyKTooMTIsNik6KDAsMik6KDE0LDApOjE=',// S1-1764
	'UzEtMTc3NDooMTQsMTIpOig4LDEwKTooMiw4KTooMCwyKTooMTQsMCk6MQ==',// S1-1774
	'UzEtMTc3NjooMTQsMTIpOigyLDEwKTooOCw4KTooMCwyKTooMTQsMCk6MQ==',// S1-1776
);

$array = array( //s1カード20241025DNP2025年分
	'UzEtMjI3OigxNCwxMCk6KDgsOCk6KDIsNik6KDgsMCk6KDAsMCk6MQ==',// S1-227
	'UzEtMjM3Oig2LDEyKTooMTQsMTApOig0LDYpOig4LDApOigwLDApOjE=',// S1-237
	'UzEtMjQzOig0LDEyKTooMTQsMTApOig2LDYpOig4LDApOigwLDApOjE=',// S1-243
	'UzEtMjY2OigxNCwxMCk6KDIsMTApOig4LDgpOig4LDApOigwLDApOjE=',// S1-266
	'UzEtNTAwOigxNCwxMCk6KDgsOCk6KDIsNik6KDE0LDApOigwLDApOjE=',// S1-500
	'UzEtNTA4Oig2LDEyKTooMTQsMTApOig0LDYpOigxNCwwKTooMCwwKTox',// S1-508
	'UzEtNTEyOig0LDEyKTooMTQsMTApOig2LDYpOigxNCwwKTooMCwwKTox',// S1-512
	'UzEtNTMxOigxNCwxMCk6KDIsMTApOig4LDgpOigxNCwwKTooMCwwKTox',// S1-531
	'UzEtNjA4OigxNCwxMCk6KDYsMTApOigwLDgpOig2LDIpOigwLDApOjE=',// S1-608
	'UzEtNjE4OigxNCwxMCk6KDIsMTApOig4LDgpOig2LDIpOigwLDApOjE=',// S1-618
	'UzEtNjI2OigwLDEyKTooMTQsMTApOig2LDEwKTooNiwyKTooMCwwKTox',// S1-626
	'UzEtNzk0OigxNCwxMCk6KDYsMTApOigwLDgpOigxMiwyKTooMCwwKTox',// S1-794
	'UzEtODA0OigxNCwxMCk6KDIsMTApOig4LDgpOigxMiwyKTooMCwwKTox',// S1-804
	'UzEtODEyOigwLDEyKTooMTQsMTApOig2LDEwKTooMTIsMik6KDAsMCk6MQ==',// S1-812
	'UzEtMTI4MzooMTQsMTIpOigyLDgpOig4LDYpOigwLDIpOig2LDApOjE=',// S1-1283
	'UzEtMTI4OTooMTQsMTIpOig2LDEyKTooOCw2KTooMCwyKTooNiwwKTox',// S1-1289
	'UzEtMTI5OTooMTQsMTIpOig0LDEyKTooMTAsNik6KDAsMik6KDYsMCk6MQ==',// S1-1299
	'UzEtMTMzNzooMTQsMTIpOig4LDEwKTooMiw4KTooMCwyKTooNiwwKTox',// S1-1337
	'UzEtMTMzOTooMTQsMTIpOigwLDEwKTooNiw4KTooMCwyKTooNiwwKTox',// S1-1339
	'UzEtMTM0MjooMTQsMTIpOigyLDEwKTooOCw4KTooMCwyKTooNiwwKTox',// S1-1342
	'UzEtMTM1MzooMTQsMTIpOigyLDEyKTooOCwxMCk6KDAsMik6KDYsMCk6MQ==',// S1-1353
	'UzEtMTQyNjooMTQsMTIpOig0LDgpOigxMCw2KTooMCwyKTooOCwwKTox',// S1-1426 
	'UzEtMTQzNjooMTQsMTIpOigyLDgpOigxMiw2KTooMCwyKTooOCwwKTox',// S1-1436
	'UzEtMTQzODooMTQsMTIpOig2LDgpOigxMiw2KTooMCwyKTooOCwwKTox',// S1-1438
	'UzEtMTQ3MDooMTQsMTIpOig4LDEwKTooMiw4KTooMCwyKTooOCwwKTox',// S1-1470
	'UzEtMTQ3NTooMTQsMTIpOigyLDEwKTooOCw4KTooMCwyKTooOCwwKTox',// S1-1475
	'UzEtMTYxNDooMTQsMTIpOigyLDgpOig4LDYpOigwLDIpOigxMiwwKTox',// S1-1614
	'UzEtMTYyMDooMTQsMTIpOig2LDEyKTooOCw2KTooMCwyKTooMTIsMCk6MQ==',// S1-1620
	'UzEtMTYzMDooMTQsMTIpOig0LDEyKTooMTAsNik6KDAsMik6KDEyLDApOjE=',// S1-1630
	'UzEtMTY2ODooMTQsMTIpOig4LDEwKTooMiw4KTooMCwyKTooMTIsMCk6MQ==',// S1-1668
	'UzEtMTY3MDooMTQsMTIpOigwLDEwKTooNiw4KTooMCwyKTooMTIsMCk6MQ==',// S1-1670
	'UzEtMTY3MzooMTQsMTIpOigyLDEwKTooOCw4KTooMCwyKTooMTIsMCk6MQ==',// S1-1673
	'UzEtMTY4NDooMTQsMTIpOigyLDEyKTooOCwxMCk6KDAsMik6KDEyLDApOjE=',// S1-1684
	'UzEtMTc0OTooMTQsMTIpOig0LDgpOigxMCw2KTooMCwyKTooMTQsMCk6MQ==',// S1-1749
	'UzEtMTc1NzooMTQsMTIpOigyLDgpOigxMiw2KTooMCwyKTooMTQsMCk6MQ==',// S1-1757
	'UzEtMTc1OTooMTQsMTIpOig2LDgpOigxMiw2KTooMCwyKTooMTQsMCk6MQ==',// S1-1759
	'UzEtMTc3NDooMTQsMTIpOig4LDEwKTooMiw4KTooMCwyKTooMTQsMCk6MQ==',// S1-1774
	'UzEtMTc3NjooMTQsMTIpOigyLDEwKTooOCw4KTooMCwyKTooMTQsMCk6MQ==',// S1-1776
);


$array = array( //debug 20250619版
    "UzEtNjMwOig4LDE0KTooMCwxNCk6KDE0LDEyKTooNiw0KTooMCwyKTox", // S1-630
	"UzEtODE2Oig4LDE0KTooMCwxNCk6KDE0LDEyKTooMTIsNCk6KDAsMik6MQ==", // S1-816
	"UzEtOTU5Oig0LDE0KTooMTQsMTIpOigwLDgpOig4LDYpOigwLDIpOjE=", // S1-959
	"UzEtMTA3MjooNCwxNCk6KDE0LDEyKTooMCw4KTooMTQsNik6KDAsMik6MQ==", // S1-1072
	"UzEtMTMwNjooMTQsMTIpOigwLDEwKTooMTIsNik6KDAsMik6KDYsMCk6MQ==", // S1-1306
	"UzEtMTQxOTooMTQsMTIpOigyLDEwKTooOCw2KTooMCwyKTooOCwwKTox", // S1-1419
	"UzEtMTYzNzooMTQsMTIpOigwLDEwKTooMTIsNik6KDAsMik6KDEyLDApOjE=", // S1-1637
	"UzEtMTc0MjooMTQsMTIpOigyLDEwKTooOCw2KTooMCwyKTooMTQsMCk6MQ==", // S1-1742
	"UzEtMTc1NzooMTQsMTIpOigyLDgpOigxMiw2KTooMCwyKTooMTQsMCk6MQ==", // S1-1757
);

$array = array( //debug 20250701版
    "UzEtMTooMTQsMTIpOigwLDgpOigxNCwyKTooNiwyKTooMCwyKTox", // S1-1
	"UzEtNzooMTQsMTIpOigyLDEwKTooMTQsMik6KDYsMik6KDAsMik6MQ==", // S1-7
	"UzEtOTooMTQsMTIpOig2LDEwKTooMTQsMik6KDYsMik6KDAsMik6MQ==", // S1-9
	"UzEtMTE6KDE0LDEyKTooMiwxMik6KDE0LDIpOig2LDIpOigwLDIpOjE=", // S1-11
	"UzEtMTI6KDE0LDEyKTooNCwxMik6KDE0LDIpOig2LDIpOigwLDIpOjE=", // S1-12
	"UzEtMTM6KDE0LDEyKTooNiwxMik6KDE0LDIpOig2LDIpOigwLDIpOjE=", // S1-13
	"UzEtMTk6KDE0LDEyKTooMCw4KTooMTIsNCk6KDYsMik6KDAsMik6MQ==", // S1-19
	"UzEtNTA6KDE0LDEyKTooNCwxMik6KDE0LDQpOig2LDIpOigwLDIpOjE=", // S1-50
	"UzEtNTc6KDE0LDEyKTooMCw4KTooMTIsNik6KDYsMik6KDAsMik6MQ==", // S1-57
	"UzEtNTg6KDE0LDEyKTooMiw4KTooMTIsNik6KDYsMik6KDAsMik6MQ==", // S1-58
	"UzEtNjA6KDE0LDEyKTooNiw4KTooMTIsNik6KDYsMik6KDAsMik6MQ==", // S1-60
	"UzEtNzg6KDE0LDEyKTooNiw4KTooMTQsNik6KDYsMik6KDAsMik6MQ==", // S1-78
	"UzEtOTY6KDE0LDEyKTooOCw4KTooMCw4KTooNiwyKTooMCwyKTox", // S1-96
	"UzEtOTc6KDE0LDEyKTooNiwxMCk6KDAsOCk6KDYsMik6KDAsMik6MQ==", // S1-97
	"UzEtMTA1OigxNCwxMik6KDgsOCk6KDIsOCk6KDYsMik6KDAsMik6MQ==", // S1-105
	"UzEtMTA2OigxNCwxMik6KDgsMTApOigyLDgpOig2LDIpOigwLDIpOjE=", // S1-106
	"UzEtMTA3OigxNCwxMik6KDgsMTIpOigyLDgpOig2LDIpOigwLDIpOjE=", // S1-107
	"UzEtMTQwOigxNCwxMik6KDgsMTIpOigyLDEwKTooNiwyKTooMCwyKTox", // S1-140
	"UzEtMTY1OigxNCwxMik6KDIsMTApOigxNCwyKTooOCwyKTooMCwyKTox", // S1-165
	"UzEtMTY3OigxNCwxMik6KDYsMTApOigxNCwyKTooOCwyKTooMCwyKTox", // S1-167
	"UzEtMTY5OigxNCwxMik6KDIsMTIpOigxNCwyKTooOCwyKTooMCwyKTox", // S1-169
	"UzEtMTk5OigxNCwxMik6KDYsOCk6KDE0LDYpOig4LDIpOigwLDIpOjE=", // S1-199
	"UzEtMzE5OigxNCwxMik6KDYsMTApOigwLDEwKTooMTAsMik6KDAsMik6MQ==", // S1-319
	"UzEtNDA1OigxNCwxMik6KDAsMTIpOig4LDgpOigxMiwyKTooMCwyKTox", // S1-405
	"UzEtNTM2OigxNCwxMik6KDAsOCk6KDEyLDQpOig2LDQpOigwLDIpOjE=", // S1-536
	"UzEtNTY4OigxNCwxMik6KDAsMTApOigxMiw2KTooNiw0KTooMCwyKTox", // S1-568
	"UzEtNTcxOigxNCwxMik6KDYsMTApOigxMiw2KTooNiw0KTooMCwyKTox", // S1-571
	"UzEtNTgyOigxNCwxMik6KDAsOCk6KDE0LDYpOig2LDQpOigwLDIpOjE=", // S1-582
	"UzEtNTg2OigxNCwxMik6KDYsMTApOigxNCw2KTooNiw0KTooMCwyKTox", // S1-586
	"UzEtNTk5OigxNCwxMik6KDgsMTApOigwLDgpOig2LDQpOigwLDIpOjE=", // S1-599
	"UzEtNjEyOigxNCwxMik6KDgsMTApOigyLDEwKTooNiw0KTooMCwyKTox", // S1-612
	"UzEtNjEzOigxNCwxMik6KDgsMTIpOigyLDEwKTooNiw0KTooMCwyKTox", // S1-613
	"UzEtNjM2OigxNCwxMik6KDQsMTApOigxNCw0KTooOCw0KTooMCwyKTox", // S1-636
	"UzEtNjQ5OigxNCwxMik6KDIsOCk6KDE0LDYpOig4LDQpOigwLDIpOjE=", // S1-649
	"UzEtODk3OigxNCwxMik6KDAsOCk6KDEyLDYpOig2LDYpOigwLDIpOjE=", // S1-897
	"UzEtOTQyOigxNCwxMik6KDAsOCk6KDE0LDYpOig4LDYpOigwLDIpOjE=", // S1-942
);

$array = array( //タッチ方向動作判定版SDK debug 20260128版
	"UzEtNTc6KDE0LDEyKTooMCw4KTooMTIsNik6KDYsMik6KDAsMik6MQ==", // S1-57
	"UzEtMTA2OigxNCwxMik6KDgsMTApOigyLDgpOig2LDIpOigwLDIpOjE=", // S1-106
	"UzEtMTA3OigxNCwxMik6KDgsMTIpOigyLDgpOig2LDIpOigwLDIpOjE=", // S1-107
    "UzEtMTc4OigxNCwxMik6KDIsOCk6KDE0LDQpOig4LDIpOigwLDIpOjE=", // S1-178	
    "UzEtMTg1OigxNCwxMik6KDYsMTApOigxNCw0KTooOCwyKTooMCwyKTox", // S1-185
	"UzEtMTk5OigxNCwxMik6KDYsOCk6KDE0LDYpOig4LDIpOigwLDIpOjE=", // S1-199
    "UzEtMjkxOigxNCwxMik6KDgsMTApOigyLDgpOigxMCwyKTooMCwyKTox", // S1-291
    "UzEtMzExOigxNCwxMik6KDIsMTApOig4LDgpOigxMCwyKTooMCwyKTox", // S1-311	
    "UzEtNDY4OigxNCwxMik6KDAsMTApOig2LDYpOigxNCwyKTooMCwyKTox", // S1-468
    "UzEtNTY4OigxNCwxMik6KDAsMTApOigxMiw2KTooNiw0KTooMCwyKTox", // S1-568		
	"UzEtNTcxOigxNCwxMik6KDYsMTApOigxMiw2KTooNiw0KTooMCwyKTox", // S1-571
	"UzEtNTgyOigxNCwxMik6KDAsOCk6KDE0LDYpOig2LDQpOigwLDIpOjE=", // S1-582
    "UzEtNjAxOigxNCwxMik6KDgsMTIpOigwLDgpOig2LDQpOigwLDIpOjE=", // S1-601
    "UzEtNjA4OigxNCwxMik6KDYsMTIpOigwLDEwKTooNiw0KTooMCwyKTox", // S1-608
	"UzEtNjQ5OigxNCwxMik6KDIsOCk6KDE0LDYpOig4LDQpOigwLDIpOjE=", // S1-649
    "UzEtNzY3OigxNCwxMik6KDYsMTIpOigwLDgpOigxMiw0KTooMCwyKTox", // S1-767
    "UzEtNzk0OigxNCwxMik6KDYsMTIpOigwLDEwKTooMTIsNCk6KDAsMik6MQ==", // S1-794
    "UzEtODE5OigxNCwxMik6KDAsMTApOig2LDYpOigxNCw0KTooMCwyKTox", // S1-819
	"UzEtMTMzOTooMTQsMTIpOigwLDEwKTooNiw4KTooMCwyKTooNiwwKTox", // S1-1339
    "UzEtMTQzNjooMTQsMTIpOigyLDgpOigxMiw2KTooMCwyKTooOCwwKTox", // S1-1436
    "UzEtMTY3MDooMTQsMTIpOigwLDEwKTooNiw4KTooMCwyKTooMTIsMCk6MQ==", // S1-1670	
    "UzEtMTc1NzooMTQsMTIpOigyLDgpOigxMiw2KTooMCwyKTooMTQsMCk6MQ==", // S1-1757
    "SUQxMDMzMy0zOigxNCwxMik6KDIsMTApOig4LDgpOigwLDIpOig1LDApOjE=", // ID10333-3
    "SUQxMDMzMy0yOigxNCwxMik6KDIsMTApOig4LDgpOigwLDIpOig5LDApOjE=", // ID10333-2
    "SUQxMDMzMy0xOigxNCwxMik6KDIsMTApOig4LDgpOigwLDIpOigxMywwKTox", // ID10333-1
    "SUQxMDM4MS0zOigxNCwxMik6KDAsMTApOig4LDYpOigwLDIpOig1LDApOjE=", // ID10381-3
    "SUQxMDM4MS0yOigxNCwxMik6KDAsMTApOig4LDYpOigwLDIpOig5LDApOjE=", // ID10381-2
    "SUQxMDM4MS0xOigxNCwxMik6KDAsMTApOig4LDYpOigwLDIpOigxMywwKTox", // ID10381-1
);


$array = array(//20260224 CoLaboMix様向けデバック用
    "UzEtNTk5OigxNCwxMik6KDgsMTApOigxNCw2KTooNiw0KTooMCwyKTox", // S1-599
    "UzEtMTQzNjooMTQsMTIpOigyLDgpOigxMiw2KTooMCwyKTooOCwwKTox", // S1-1436
    "UzEtMTc1NzooMTQsMTIpOigyLDgpOigxMiw2KTooMCwyKTooMTQsMCk6MQ==", // S1-1757
);


$array = array(//20260304 山口証券印刷様デモページ用アクスタ3次、プレート試作用
	"UzEtMTk6KDE0LDEyKTooOCwxMik6KDIsMTApOigxNCw2KTooMCwyKTox", // S1-19
	"UzEtNTc6KDE0LDEyKTooOCwxMik6KDIsOCk6KDE0LDYpOigwLDIpOjE=", // S1-57
	"UzEtNTg6KDE0LDEyKTooOCwxMik6KDIsOCk6KDEyLDYpOigwLDIpOjE=", // S1-58
	"UzEtNzg6KDE0LDEyKTooNiw4KTooMTQsNik6KDYsMik6KDAsMik6MQ==", // S1-78
	"UzEtOTY6KDE0LDEyKTooOCwxMik6KDE0LDYpOig2LDYpOigwLDIpOjE=", // S1-96
	"UzEtMTA1OigxNCwxMik6KDgsMTIpOigxMiw2KTooNiw2KTooMCwyKTox", // S1-105
	"UzEtMTA2OigxNCwxMik6KDgsMTIpOigxMiw2KTooNiw0KTooMCwyKTox", // S1-106
	"UzEtMTA3OigxNCwxMik6KDgsMTIpOigxMiw2KTooNiwyKTooMCwyKTox", // S1-107
	"UzEtMTc4OigxNCwxMik6KDYsMTIpOigwLDEwKTooMTIsNik6KDAsMik6MQ==", // S1-178
	"UzEtMTg1OigxNCwxMik6KDYsMTApOigxNCw0KTooOCwyKTooMCwyKTox", // S1-185
	"UzEtMTk5OigxNCwxMik6KDYsMTIpOigwLDgpOig4LDYpOigwLDIpOjE=", // S1-199
	"UzEtMjkxOigxNCwxMik6KDQsMTIpOigxMiw2KTooNiw0KTooMCwyKTox", // S1-291
	"UzEtMzExOigxNCwxMik6KDQsMTIpOig2LDYpOigxMiw0KTooMCwyKTox", // S1-311
	"UzEtNDA0OigxNCwxMik6KDIsMTIpOig2LDYpOigxMiw0KTooMCwyKTox", // S1-404
	"UzEtNDA1OigxNCwxMik6KDIsMTIpOig2LDYpOigxNCwyKTooMCwyKTox", // S1-405
	"UzEtNDA5Oig0LDE0KTooMTQsMTIpOig4LDgpOigxMiwyKTooMCwyKTox", // S1-409
	"UzEtNDY4OigxNCwxMik6KDAsMTApOig2LDYpOigxNCwyKTooMCwyKTox", // S1-468
	"UzEtNTM2OigxNCwxMik6KDgsMTApOigyLDEwKTooMTQsNik6KDAsMik6MQ==", // S1-536
	"UzEtNTY4OigxNCwxMik6KDAsMTApOigxMiw2KTooNiw0KTooMCwyKTox", // S1-568
	"UzEtNTY5OigxNCwxMik6KDIsMTApOigxMiw2KTooNiw0KTooMCwyKTox", // S1-569
	"UzEtNTcxOigxNCwxMik6KDYsMTApOigxMiw2KTooNiw0KTooMCwyKTox", // S1-571
	"UzEtNTgyOigxNCwxMik6KDAsOCk6KDE0LDYpOig2LDQpOigwLDIpOjE=", // S1-582
	"UzEtNTg2OigxNCwxMik6KDYsMTApOigxNCw2KTooNiw0KTooMCwyKTox", // S1-586
	"UzEtNTk5OigxNCwxMik6KDgsMTApOigxNCw2KTooNiw0KTooMCwyKTox", // S1-599
	"UzEtNjAxOigxNCwxMik6KDgsMTIpOigwLDgpOig2LDQpOigwLDIpOjE=", // S1-601
	"UzEtNjA4OigxNCwxMik6KDYsMTIpOigwLDEwKTooNiw0KTooMCwyKTox", // S1-608
	"UzEtNjE0Oig4LDE0KTooMTQsMTIpOigyLDEwKTooNiw0KTooMCwyKTox", // S1-614
	"UzEtNjQ5OigxNCwxMik6KDYsMTApOigwLDgpOigxMiw2KTooMCwyKTox", // S1-649
	"UzEtNzYxOig0LDE0KTooMTQsMTIpOig2LDYpOigxMiw0KTooMCwyKTox", // S1-761
	"UzEtNzY3OigxNCwxMik6KDYsMTIpOigwLDgpOigxMiw0KTooMCwyKTox", // S1-767
	"UzEtNzk0OigxNCwxMik6KDYsMTIpOigwLDEwKTooMTIsNCk6KDAsMik6MQ==", // S1-794
	"UzEtODE5OigxNCwxMik6KDAsMTApOig4LDgpOigxNCw0KTooMCwyKTox", // S1-819
	"UzEtODk3OigxNCwxMik6KDgsOCk6KDIsOCk6KDE0LDYpOigwLDIpOjE=", // S1-897
	"UzEtMTMwODooMTQsMTIpOig0LDEwKTooMTIsNik6KDAsMik6KDYsMCk6MQ==", // S1-1308
	"UzEtMTMzOTooMTQsMTIpOigwLDEwKTooNiw4KTooMCwyKTooNiwwKTox", // S1-1339
	"UzEtMTQzNjooMTQsMTIpOigyLDgpOigxMiw2KTooMCwyKTooOCwwKTox", // S1-1436
	"UzEtMTYxNjooMTQsMTIpOigyLDEwKTooOCw2KTooMCwyKTooMTIsMCk6MQ==", // S1-1616
	"UzEtMTY3MDooMTQsMTIpOigwLDEwKTooNiw4KTooMCwyKTooMTIsMCk6MQ==", // S1-1670
	"UzEtMTc1NzooMTQsMTIpOigyLDgpOigxMiw2KTooMCwyKTooMTQsMCk6MQ==", // S1-1757
	"SUQxMDMzMy0xOigxNCwxMik6KDIsMTApOig4LDgpOigwLDIpOigxMywwKTox", // ID10333-1
	"SUQxMDMzMy0yOigxNCwxMik6KDIsMTApOig4LDgpOigwLDIpOig5LDApOjE=", // ID10333-2
	"SUQxMDMzMy0zOigxNCwxMik6KDIsMTApOig4LDgpOigwLDIpOig1LDApOjE=", // ID10333-3
	"SUQxMDM4MS0xOigxNCwxMik6KDAsMTApOig4LDYpOigwLDIpOigxMywwKTox", // ID10381-1
	"SUQxMDM4MS0yOigxNCwxMik6KDAsMTApOig4LDYpOigwLDIpOig5LDApOjE=", // ID10381-2
	"SUQxMDM4MS0zOigxNCwxMik6KDAsMTApOig4LDYpOigwLDIpOig1LDApOjE=", // ID10381-3
);


$array = array(/*20260601現在で試作で作成したS1系列ID1系列のID v4ベース （アクスタ180度回転、Y座標+2 ）*/
    "UzEtMTooMTQsMTIpOig4LDEyKTooMCwxMik6KDE0LDYpOigwLDIpOjE=",
    "UzEtNzooMTQsMTIpOigyLDEwKTooMTQsMik6KDYsMik6KDAsMik6MQ==",
    "UzEtOTooMTQsMTIpOig4LDEyKTooMCwxMik6KDgsNCk6KDAsMik6MQ==",
    "UzEtMTE6KDE0LDEyKTooMiwxMik6KDE0LDIpOig2LDIpOigwLDIpOjE=",
    "UzEtMTI6KDE0LDEyKTooNCwxMik6KDE0LDIpOig2LDIpOigwLDIpOjE=",
    "UzEtMTM6KDE0LDEyKTooNiwxMik6KDE0LDIpOig2LDIpOigwLDIpOjE=",
    "UzEtMTk6KDE0LDEyKTooOCwxMik6KDIsMTApOigxNCw2KTooMCwyKTox",
    "UzEtNTA6KDE0LDEyKTooNCwxMik6KDE0LDQpOig2LDIpOigwLDIpOjE=",
    "UzEtNTc6KDE0LDEyKTooOCwxMik6KDIsOCk6KDE0LDYpOigwLDIpOjE=",
    "UzEtNTg6KDE0LDEyKTooOCwxMik6KDIsOCk6KDEyLDYpOigwLDIpOjE=",
    "UzEtNjA6KDE0LDEyKTooNiw4KTooMTIsNik6KDYsMik6KDAsMik6MQ==",
    "UzEtNzg6KDE0LDEyKTooNiw4KTooMTQsNik6KDYsMik6KDAsMik6MQ==",
    "UzEtNzk6KDE0LDEyKTooOCw4KTooMTQsNik6KDYsMik6KDAsMik6MQ==",
    "UzEtOTY6KDE0LDEyKTooOCwxMik6KDE0LDYpOig2LDYpOigwLDIpOjE=",
    "UzEtOTc6KDE0LDEyKTooOCwxMik6KDE0LDYpOig4LDQpOigwLDIpOjE=",
    "UzEtMTAxOigyLDE0KTooMTQsMTIpOigwLDgpOig2LDIpOigwLDIpOjE=",
    "UzEtMTA1OigxNCwxMik6KDgsMTIpOigxMiw2KTooNiw2KTooMCwyKTox",
    "UzEtMTA2OigxNCwxMik6KDgsMTIpOigxMiw2KTooNiw0KTooMCwyKTox",
    "UzEtMTA3OigxNCwxMik6KDgsMTIpOigxMiw2KTooNiwyKTooMCwyKTox",
    "UzEtMTQwOigxNCwxMik6KDgsMTIpOigyLDEwKTooNiwyKTooMCwyKTox",
    "UzEtMTU3Oig4LDE0KTooMCwxNCk6KDE0LDEyKTooNiwyKTooMCwyKTox",
    "UzEtMTY1OigxNCwxMik6KDYsMTIpOigwLDEyKTooMTIsNCk6KDAsMik6MQ==",
    "UzEtMTY3OigxNCwxMik6KDYsMTIpOigwLDEyKTooOCw0KTooMCwyKTox",
    "UzEtMTY5OigxNCwxMik6KDIsMTIpOigxNCwyKTooOCwyKTooMCwyKTox",
    "UzEtMTc4OigxNCwxMik6KDYsMTIpOigwLDEwKTooMTIsNik6KDAsMik6MQ==",
    "UzEtMTg1OigxNCwxMik6KDYsMTApOigxNCw0KTooOCwyKTooMCwyKTox",
    "UzEtMTk5OigxNCwxMik6KDYsMTIpOigwLDgpOig4LDYpOigwLDIpOjE=",
    "UzEtMjI3OigxNCwxMik6KDYsMTIpOigxMiw2KTooNiw0KTooMCwyKTox",
    "UzEtMjMxOig0LDE0KTooMTQsMTIpOigyLDgpOig4LDIpOigwLDIpOjE=",
    "UzEtMjMzOig4LDE0KTooMTQsMTIpOigyLDgpOig4LDIpOigwLDIpOjE=",
    "UzEtMjM3Oig2LDE0KTooMTQsMTIpOig0LDgpOig4LDIpOigwLDIpOjE=",
    "UzEtMjQzOig0LDE0KTooMTQsMTIpOig2LDgpOig4LDIpOigwLDIpOjE=",
    "UzEtMjUyOig0LDE0KTooMTQsMTIpOig4LDgpOig4LDIpOigwLDIpOjE=",
    "UzEtMjU4Oig2LDE0KTooMTQsMTIpOigwLDEwKTooOCwyKTooMCwyKTox",
    "UzEtMjY2OigxNCwxMik6KDIsMTIpOig4LDEwKTooOCwyKTooMCwyKTox",
    "UzEtMjkxOigxNCwxMik6KDQsMTIpOigxMiw2KTooNiw0KTooMCwyKTox",
    "UzEtMzExOigxNCwxMik6KDQsMTIpOig2LDYpOigxMiw0KTooMCwyKTox",
    "UzEtMzE5OigxNCwxMik6KDQsMTIpOigxNCw0KTooOCw0KTooMCwyKTox",
    "UzEtNDA0OigxNCwxMik6KDIsMTIpOig2LDYpOigxMiw0KTooMCwyKTox",
    "UzEtNDA1OigxNCwxMik6KDIsMTIpOig2LDYpOigxNCwyKTooMCwyKTox",
    "UzEtNDA5Oig0LDE0KTooMTQsMTIpOig4LDgpOigxMiwyKTooMCwyKTox",
    "UzEtNDUwOig2LDE0KTooMTQsMTIpOig2LDQpOigxNCwyKTooMCwyKTox",
    "UzEtNDY4OigxNCwxMik6KDAsMTApOig2LDYpOigxNCwyKTooMCwyKTox",
    "UzEtNDgwOigxNCwxMik6KDIsMTApOig4LDYpOigxNCwyKTooMCwyKTox",
    "UzEtNTAwOigxNCwxMik6KDAsMTIpOigxMiw2KTooNiw0KTooMCwyKTox",
    "UzEtNTAzOig0LDE0KTooMTQsMTIpOigyLDgpOigxNCwyKTooMCwyKTox",
    "UzEtNTA1Oig4LDE0KTooMTQsMTIpOigyLDgpOigxNCwyKTooMCwyKTox",
    "UzEtNTA4Oig2LDE0KTooMTQsMTIpOig0LDgpOigxNCwyKTooMCwyKTox",
    "UzEtNTEyOig0LDE0KTooMTQsMTIpOig2LDgpOigxNCwyKTooMCwyKTox",
    "UzEtNTE5Oig0LDE0KTooMTQsMTIpOig4LDgpOigxNCwyKTooMCwyKTox",
    "UzEtNTI2Oig2LDE0KTooMTQsMTIpOigwLDEwKTooMTQsMik6KDAsMik6MQ==",
    "UzEtNTMxOigxNCwxMik6KDAsMTIpOig2LDQpOigxMiwyKTooMCwyKTox",
    "UzEtNTM2OigxNCwxMik6KDgsMTApOigyLDEwKTooMTQsNik6KDAsMik6MQ==",
    "UzEtNTY4OigxNCwxMik6KDAsMTApOigxMiw2KTooNiw0KTooMCwyKTox",
    "UzEtNTY5OigxNCwxMik6KDIsMTApOigxMiw2KTooNiw0KTooMCwyKTox",
    "UzEtNTcxOigxNCwxMik6KDYsMTApOigxMiw2KTooNiw0KTooMCwyKTox",
    "UzEtNTgyOigxNCwxMik6KDAsOCk6KDE0LDYpOig2LDQpOigwLDIpOjE=",
    "UzEtNTg2OigxNCwxMik6KDYsMTApOigxNCw2KTooNiw0KTooMCwyKTox",
    "UzEtNTk5OigxNCwxMik6KDgsMTApOigxNCw2KTooNiw0KTooMCwyKTox",
    "UzEtNjAxOigxNCwxMik6KDgsMTIpOigwLDgpOig2LDQpOigwLDIpOjE=",
    "UzEtNjA4OigxNCwxMik6KDYsMTIpOigwLDEwKTooNiw0KTooMCwyKTox",
    "UzEtNjEyOigxNCwxMik6KDgsMTApOigyLDEwKTooNiw0KTooMCwyKTox",
    "UzEtNjEzOigxNCwxMik6KDgsMTIpOigyLDEwKTooNiw0KTooMCwyKTox",
    "UzEtNjE0Oig4LDE0KTooMTQsMTIpOigyLDEwKTooNiw0KTooMCwyKTox",
    "UzEtNjE4OigxNCwxMik6KDIsMTIpOig4LDEwKTooNiw0KTooMCwyKTox",
    "UzEtNjIzOig2LDE0KTooMTQsMTIpOigwLDEyKTooNiw0KTooMCwyKTox",
    "UzEtNjI1Oig4LDE0KTooMTQsMTIpOigyLDEyKTooNiw0KTooMCwyKTox",
    "UzEtNjI2OigwLDE0KTooMTQsMTIpOig2LDEyKTooNiw0KTooMCwyKTox",
    "UzEtNjMwOig4LDE0KTooMCwxNCk6KDE0LDEyKTooNiw0KTooMCwyKTox",
    "UzEtNjM2OigxNCwxMik6KDQsMTApOigxNCw0KTooOCw0KTooMCwyKTox",
    "UzEtNjQ5OigxNCwxMik6KDYsMTApOigwLDgpOigxMiw2KTooMCwyKTox",
    "UzEtNzYxOig0LDE0KTooMTQsMTIpOig2LDYpOigxMiw0KTooMCwyKTox",
    "UzEtNzY3OigxNCwxMik6KDYsMTIpOigwLDgpOigxMiw0KTooMCwyKTox",
    "UzEtNzk0OigxNCwxMik6KDYsMTIpOigwLDEwKTooMTIsNCk6KDAsMik6MQ==",
    "UzEtODA0OigxNCwxMik6KDIsMTIpOig4LDEwKTooMTIsNCk6KDAsMik6MQ==",
    "UzEtODA5Oig2LDE0KTooMTQsMTIpOigwLDEyKTooMTIsNCk6KDAsMik6MQ==",
    "UzEtODExOig4LDE0KTooMTQsMTIpOigyLDEyKTooMTIsNCk6KDAsMik6MQ==",
    "UzEtODEyOigwLDE0KTooMTQsMTIpOig2LDEyKTooMTIsNCk6KDAsMik6MQ==",
    "UzEtODE2Oig4LDE0KTooMCwxNCk6KDE0LDEyKTooMTIsNCk6KDAsMik6MQ==",
    "UzEtODE5OigxNCwxMik6KDAsMTApOig4LDgpOigxNCw0KTooMCwyKTox",
    "UzEtODk3OigxNCwxMik6KDgsOCk6KDIsOCk6KDE0LDYpOigwLDIpOjE=",
    "UzEtOTQyOigxNCwxMik6KDYsOCk6KDAsOCk6KDE0LDYpOigwLDIpOjE=",
    "UzEtOTU5Oig0LDE0KTooMTQsMTIpOigwLDgpOig4LDYpOigwLDIpOjE=",
    "UzEtMTA3MjooNCwxNCk6KDE0LDEyKTooMCw4KTooMTQsNik6KDAsMik6MQ==",
    "UzEtMTI4MzooMTQsMTIpOigyLDgpOig4LDYpOigwLDIpOig2LDApOjE=",
    "UzEtMTI4NjooMTQsMTIpOigwLDEyKTooOCw2KTooMCwyKTooNiwwKTox",
    "UzEtMTI4NzooMTQsMTIpOigyLDEyKTooOCw2KTooMCwyKTooNiwwKTox",
    "UzEtMTI4OTooMTQsMTIpOig2LDEyKTooOCw2KTooMCwyKTooNiwwKTox",
    "UzEtMTI5MzooMTQsMTIpOig0LDgpOigxMCw2KTooMCwyKTooNiwwKTox",
    "UzEtMTI5OTooMTQsMTIpOig0LDEyKTooMTAsNik6KDAsMik6KDYsMCk6MQ==",
    "UzEtMTMwNjooMTQsMTIpOigwLDEwKTooMTIsNik6KDAsMik6KDYsMCk6MQ==",
    "UzEtMTMwODooMTQsMTIpOig0LDEwKTooMTIsNik6KDAsMik6KDYsMCk6MQ==",
    "UzEtMTMzNzooMTQsMTIpOig4LDEwKTooMiw4KTooMCwyKTooNiwwKTox",
    "UzEtMTMzOTooMTQsMTIpOigwLDEwKTooNiw4KTooMCwyKTooNiwwKTox",
    "UzEtMTM0MjooMTQsMTIpOigyLDEwKTooOCw4KTooMCwyKTooNiwwKTox",
    "UzEtMTM0NzooMTQsMTIpOig2LDEyKTooMCwxMCk6KDAsMik6KDYsMCk6MQ==",
    "UzEtMTM1MzooMTQsMTIpOigyLDEyKTooOCwxMCk6KDAsMik6KDYsMCk6MQ==",
    "UzEtMTQxOTooMTQsMTIpOigyLDEwKTooOCw2KTooMCwyKTooOCwwKTox",
    "UzEtMTQyNjooMTQsMTIpOig0LDgpOigxMCw2KTooMCwyKTooOCwwKTox",
    "UzEtMTQzNjooMTQsMTIpOigyLDgpOigxMiw2KTooMCwyKTooOCwwKTox",
    "UzEtMTQzODooMTQsMTIpOig2LDgpOigxMiw2KTooMCwyKTooOCwwKTox",
    "UzEtMTQ0NTooMTQsMTIpOig0LDEyKTooMTIsNik6KDAsMik6KDgsMCk6MQ==",
    "UzEtMTQ2MzooMTQsMTIpOig2LDgpOigwLDgpOigwLDIpOig4LDApOjE=",
    "UzEtMTQ3MDooMTQsMTIpOig4LDEwKTooMiw4KTooMCwyKTooOCwwKTox",
    "UzEtMTQ3NTooMTQsMTIpOigyLDEwKTooOCw4KTooMCwyKTooOCwwKTox",
    "UzEtMTYxNDooMTQsMTIpOigyLDgpOig4LDYpOigwLDIpOigxMiwwKTox",
    "UzEtMTYxNjooMTQsMTIpOigyLDEwKTooOCw2KTooMCwyKTooMTIsMCk6MQ==",
    "UzEtMTYxODooMTQsMTIpOigyLDEyKTooOCw2KTooMCwyKTooMTIsMCk6MQ==",
    "UzEtMTYyMDooMTQsMTIpOig2LDEyKTooOCw2KTooMCwyKTooMTIsMCk6MQ==",
    "UzEtMTYyNDooMTQsMTIpOig0LDgpOigxMCw2KTooMCwyKTooMTIsMCk6MQ==",
    "UzEtMTYzMDooMTQsMTIpOig0LDEyKTooMTAsNik6KDAsMik6KDEyLDApOjE=",
    "UzEtMTYzNzooMTQsMTIpOigwLDEwKTooMTIsNik6KDAsMik6KDEyLDApOjE=",
    "UzEtMTY2ODooMTQsMTIpOig4LDEwKTooMiw4KTooMCwyKTooMTIsMCk6MQ==",
    "UzEtMTY3MDooMTQsMTIpOigwLDEwKTooNiw4KTooMCwyKTooMTIsMCk6MQ==",
    "UzEtMTY3MzooMTQsMTIpOigyLDEwKTooOCw4KTooMCwyKTooMTIsMCk6MQ==",
    "UzEtMTY3ODooMTQsMTIpOig2LDEyKTooMCwxMCk6KDAsMik6KDEyLDApOjE=",
    "UzEtMTY4NDooMTQsMTIpOigyLDEyKTooOCwxMCk6KDAsMik6KDEyLDApOjE=",
    "UzEtMTc0MjooMTQsMTIpOigyLDEwKTooOCw2KTooMCwyKTooMTQsMCk6MQ==",
    "UzEtMTc0OTooMTQsMTIpOig0LDgpOigxMCw2KTooMCwyKTooMTQsMCk6MQ==",
    "UzEtMTc1NDooMTQsMTIpOig2LDEyKTooMTAsNik6KDAsMik6KDE0LDApOjE=",
    "UzEtMTc1NzooMTQsMTIpOigyLDgpOigxMiw2KTooMCwyKTooMTQsMCk6MQ==",
    "UzEtMTc1OTooMTQsMTIpOig2LDgpOigxMiw2KTooMCwyKTooMTQsMCk6MQ==",
    "UzEtMTc2NDooMTQsMTIpOig0LDEyKTooMTIsNik6KDAsMik6KDE0LDApOjE=",
    "UzEtMTc2NzooMTQsMTIpOig2LDgpOigwLDgpOigwLDIpOigxNCwwKTox",
    "UzEtMTc3NDooMTQsMTIpOig4LDEwKTooMiw4KTooMCwyKTooMTQsMCk6MQ==",
    "UzEtMTc3NjooMTQsMTIpOigyLDEwKTooOCw4KTooMCwyKTooMTQsMCk6MQ==",
    "SUQxMDA1Ny0xOigxNCwxMik6KDYsMTIpOigxMCw2KTooMCwyKTooMTMsMCk6MQ==",
    "SUQxMDA1Ny0yOigxNCwxMik6KDYsMTIpOigxMCw2KTooMCwyKTooOSwwKTox",
    "SUQxMDA1Ny0zOigxNCwxMik6KDYsMTIpOigxMCw2KTooMCwyKTooNSwwKTox",
    "SUQxMDA1OS0xOigxNCwxMik6KDYsMTIpOig4LDYpOigwLDIpOigxMywwKTox",
    "SUQxMDA1OS0yOigxNCwxMik6KDYsMTIpOig4LDYpOigwLDIpOig5LDApOjE=",
    "SUQxMDA1OS0zOigxNCwxMik6KDYsMTIpOig4LDYpOigwLDIpOig1LDApOjE=",
    "SUQxMDA4Mi0xOigxNCwxMik6KDQsMTIpOigxMiw2KTooMCwyKTooMTMsMCk6MQ==",
    "SUQxMDA4Mi0yOigxNCwxMik6KDQsMTIpOigxMiw2KTooMCwyKTooOSwwKTox",
    "SUQxMDA4Mi0zOigxNCwxMik6KDQsMTIpOigxMiw2KTooMCwyKTooNSwwKTox",
    "SUQxMDA4NC0xOigxNCwxMik6KDQsMTIpOigxMCw2KTooMCwyKTooMTMsMCk6MQ==",
    "SUQxMDA4NC0yOigxNCwxMik6KDQsMTIpOigxMCw2KTooMCwyKTooOSwwKTox",
    "SUQxMDA4NC0zOigxNCwxMik6KDQsMTIpOigxMCw2KTooMCwyKTooNSwwKTox",
    "SUQxMDA4Ni0xOigxNCwxMik6KDQsMTIpOig4LDYpOigwLDIpOigxMywwKTox",
    "SUQxMDA4Ni0yOigxNCwxMik6KDQsMTIpOig4LDYpOigwLDIpOig5LDApOjE=",
    "SUQxMDA4Ni0zOigxNCwxMik6KDQsMTIpOig4LDYpOigwLDIpOig1LDApOjE=",
    "SUQxMDA4OC0xOigxNCwxMik6KDQsMTIpOig2LDYpOigwLDIpOigxMywwKTox",
    "SUQxMDA4OC0yOigxNCwxMik6KDQsMTIpOig2LDYpOigwLDIpOig5LDApOjE=",
    "SUQxMDA4OC0zOigxNCwxMik6KDQsMTIpOig2LDYpOigwLDIpOig1LDApOjE=",
    "SUQxMDExMC0xOigxNCwxMik6KDIsMTIpOig4LDgpOigwLDIpOigxMywwKTox",
    "SUQxMDExMC0yOigxNCwxMik6KDIsMTIpOig4LDgpOigwLDIpOig5LDApOjE=",
    "SUQxMDExMC0zOigxNCwxMik6KDIsMTIpOig4LDgpOigwLDIpOig1LDApOjE=",
    "SUQxMDEyMS0xOigxNCwxMik6KDIsMTIpOigxMCw2KTooMCwyKTooMTMsMCk6MQ==",
    "SUQxMDEyMS0yOigxNCwxMik6KDIsMTIpOigxMCw2KTooMCwyKTooOSwwKTox",
    "SUQxMDEyMS0zOigxNCwxMik6KDIsMTIpOigxMCw2KTooMCwyKTooNSwwKTox",
    "SUQxMDEyMy0xOigxNCwxMik6KDIsMTIpOig4LDYpOigwLDIpOigxMywwKTox",
    "SUQxMDEyMy0yOigxNCwxMik6KDIsMTIpOig4LDYpOigwLDIpOig5LDApOjE=",
    "SUQxMDEyMy0zOigxNCwxMik6KDIsMTIpOig4LDYpOigwLDIpOig1LDApOjE=",
    "SUQxMDEyNS0xOigxNCwxMik6KDIsMTIpOig2LDYpOigwLDIpOigxMywwKTox",
    "SUQxMDEyNS0yOigxNCwxMik6KDIsMTIpOig2LDYpOigwLDIpOig5LDApOjE=",
    "SUQxMDEyNS0zOigxNCwxMik6KDIsMTIpOig2LDYpOigwLDIpOig1LDApOjE=",
    "SUQxMDI4OC0xOigxNCwxMik6KDgsMTApOigyLDgpOigwLDIpOigxMywwKTox",
    "SUQxMDI4OC0yOigxNCwxMik6KDgsMTApOigyLDgpOigwLDIpOig5LDApOjE=",
    "SUQxMDI4OC0zOigxNCwxMik6KDgsMTApOigyLDgpOigwLDIpOig1LDApOjE=",
    "SUQxMDMwNy0xOigxNCwxMik6KDYsMTApOigxMiw2KTooMCwyKTooMTMsMCk6MQ==",
    "SUQxMDMwNy0yOigxNCwxMik6KDYsMTApOigxMiw2KTooMCwyKTooOSwwKTox",
    "SUQxMDMwNy0zOigxNCwxMik6KDYsMTApOigxMiw2KTooMCwyKTooNSwwKTox",
    "SUQxMDMxOS0xOigxNCwxMik6KDQsMTApOigxMCw2KTooMCwyKTooMTMsMCk6MQ==",
    "SUQxMDMxOS0yOigxNCwxMik6KDQsMTApOigxMCw2KTooMCwyKTooOSwwKTox",
    "SUQxMDMxOS0zOigxNCwxMik6KDQsMTApOigxMCw2KTooMCwyKTooNSwwKTox",
    "SUQxMDMzMy0xOigxNCwxMik6KDIsMTApOig4LDgpOigwLDIpOigxMywwKTox",
    "SUQxMDMzMy0yOigxNCwxMik6KDIsMTApOig4LDgpOigwLDIpOig5LDApOjE=",
    "SUQxMDMzMy0zOigxNCwxMik6KDIsMTApOig4LDgpOigwLDIpOig1LDApOjE=",
    "SUQxMDMzOS0xOigxNCwxMik6KDIsMTApOigxMiw2KTooMCwyKTooMTMsMCk6MQ==",
    "SUQxMDMzOS0yOigxNCwxMik6KDIsMTApOigxMiw2KTooMCwyKTooOSwwKTox",
    "SUQxMDMzOS0zOigxNCwxMik6KDIsMTApOigxMiw2KTooMCwyKTooNSwwKTox",
    "SUQxMDM0MS0xOigxNCwxMik6KDIsMTApOigxMCw2KTooMCwyKTooMTMsMCk6MQ==",
    "SUQxMDM0MS0yOigxNCwxMik6KDIsMTApOigxMCw2KTooMCwyKTooOSwwKTox",
    "SUQxMDM0MS0zOigxNCwxMik6KDIsMTApOigxMCw2KTooMCwyKTooNSwwKTox",
    "SUQxMDM0My0xOigxNCwxMik6KDIsMTApOig4LDYpOigwLDIpOigxMywwKTox",
    "SUQxMDM0My0yOigxNCwxMik6KDIsMTApOig4LDYpOigwLDIpOig5LDApOjE=",
    "SUQxMDM0My0zOigxNCwxMik6KDIsMTApOig4LDYpOigwLDIpOig1LDApOjE=",
    "SUQxMDM2Ny0xOigxNCwxMik6KDAsMTApOig4LDgpOigwLDIpOigxMywwKTox",
    "SUQxMDM2Ny0yOigxNCwxMik6KDAsMTApOig4LDgpOigwLDIpOig5LDApOjE=",
    "SUQxMDM2Ny0zOigxNCwxMik6KDAsMTApOig4LDgpOigwLDIpOig1LDApOjE=",
    "SUQxMDM2OS0xOigxNCwxMik6KDAsMTApOig2LDgpOigwLDIpOigxMywwKTox",
    "SUQxMDM2OS0yOigxNCwxMik6KDAsMTApOig2LDgpOigwLDIpOig5LDApOjE=",
    "SUQxMDM2OS0zOigxNCwxMik6KDAsMTApOig2LDgpOigwLDIpOig1LDApOjE=",
    "SUQxMDM3Ny0xOigxNCwxMik6KDAsMTApOigxMiw2KTooMCwyKTooMTMsMCk6MQ==",
    "SUQxMDM3Ny0yOigxNCwxMik6KDAsMTApOigxMiw2KTooMCwyKTooOSwwKTox",
    "SUQxMDM3Ny0zOigxNCwxMik6KDAsMTApOigxMiw2KTooMCwyKTooNSwwKTox",
    "SUQxMDM3OS0xOigxNCwxMik6KDAsMTApOigxMCw2KTooMCwyKTooMTMsMCk6MQ==",
    "SUQxMDM3OS0yOigxNCwxMik6KDAsMTApOigxMCw2KTooMCwyKTooOSwwKTox",
    "SUQxMDM3OS0zOigxNCwxMik6KDAsMTApOigxMCw2KTooMCwyKTooNSwwKTox",
    "SUQxMDM4MS0xOigxNCwxMik6KDAsMTApOig4LDYpOigwLDIpOigxMywwKTox",
    "SUQxMDM4MS0yOigxNCwxMik6KDAsMTApOig4LDYpOigwLDIpOig5LDApOjE=",
    "SUQxMDM4MS0zOigxNCwxMik6KDAsMTApOig4LDYpOigwLDIpOig1LDApOjE=",
    "SUQxMDM4My0xOigxNCwxMik6KDAsMTApOig2LDYpOigwLDIpOigxMywwKTox",
    "SUQxMDM4My0yOigxNCwxMik6KDAsMTApOig2LDYpOigwLDIpOig5LDApOjE=",
    "SUQxMDM4My0zOigxNCwxMik6KDAsMTApOig2LDYpOigwLDIpOig1LDApOjE=",
    "SUQxMDQ4Mi0xOigxNCwxMik6KDYsOCk6KDEyLDYpOigwLDIpOigxMywwKTox",
    "SUQxMDQ4Mi0yOigxNCwxMik6KDYsOCk6KDEyLDYpOigwLDIpOig5LDApOjE=",
    "SUQxMDQ4Mi0zOigxNCwxMik6KDYsOCk6KDEyLDYpOigwLDIpOig1LDApOjE=",
    "SUQxMDQ5MC0xOigxNCwxMik6KDQsOCk6KDEyLDYpOigwLDIpOigxMywwKTox",
    "SUQxMDQ5MC0yOigxNCwxMik6KDQsOCk6KDEyLDYpOigwLDIpOig5LDApOjE=",
    "SUQxMDQ5MC0zOigxNCwxMik6KDQsOCk6KDEyLDYpOigwLDIpOig1LDApOjE=",
    "SUQxMDQ5Mi0xOigxNCwxMik6KDQsOCk6KDEwLDYpOigwLDIpOigxMywwKTox",
    "SUQxMDQ5Mi0yOigxNCwxMik6KDQsOCk6KDEwLDYpOigwLDIpOig5LDApOjE=",
    "SUQxMDQ5Mi0zOigxNCwxMik6KDQsOCk6KDEwLDYpOigwLDIpOig1LDApOjE=",
    "SUQxMDUwNi0xOigxNCwxMik6KDIsOCk6KDEyLDYpOigwLDIpOigxMywwKTox",
    "SUQxMDUwNi0yOigxNCwxMik6KDIsOCk6KDEyLDYpOigwLDIpOig5LDApOjE=",
    "SUQxMDUwNi0zOigxNCwxMik6KDIsOCk6KDEyLDYpOigwLDIpOig1LDApOjE=",
    "SUQxMDUwOC0xOigxNCwxMik6KDIsOCk6KDEwLDYpOigwLDIpOigxMywwKTox",
    "SUQxMDUwOC0yOigxNCwxMik6KDIsOCk6KDEwLDYpOigwLDIpOig5LDApOjE=",
    "SUQxMDUwOC0zOigxNCwxMik6KDIsOCk6KDEwLDYpOigwLDIpOig1LDApOjE=",
    "SUQxMDUxMC0xOigxNCwxMik6KDIsOCk6KDgsNik6KDAsMik6KDEzLDApOjE=",
    "SUQxMDUxMC0yOigxNCwxMik6KDIsOCk6KDgsNik6KDAsMik6KDksMCk6MQ==",
    "SUQxMDUxMC0zOigxNCwxMik6KDIsOCk6KDgsNik6KDAsMik6KDUsMCk6MQ==",
);


//$txt = json_encode($array);

//TODO 都度変更 openssl証明書作成時のserver.keyのパスを記述する
//$keyFilePath = "/Users/nakano/Documents/htdocs/csr/server.key";
//$keyFilePath = "/Users/nakano/Documents/htdocs/pub_hotate/public_html/card_sdk/c/spiritek/server.key";
//$keyFilePath = "/Users/nakano/Documents/htdocs/pub_hotate/public_html/card_sdk/c/newphoria/server.key";
//$keyFilePath = "/Users/nakano/Documents/htdocs/pub_hotate/public_html/card_sdk/c/nesic_iot/server.key";
//$keyFilePath = "/Users/nakano/Documents/htdocs/pub_hotate/public_html/ccard_sdk/card_jwbl/c/tmp/card/server.key";
//$keyFilePath = "/Users/nakano/Documents/htdocs/pub_hotate/public_html/ccard_sdk/card_wakasa/c/tmp/server.key";

//$keyFilePath = "/Users/nakano/Documents/htdocs/pub_hotate/public_html/card_sdk/c/moriilab/server.key";
//$keyFilePath = "/Users/nakano/Documents/htdocs/pub_hotate/public_html/card_sdk/c/card_dnp/server.key";
// $keyFilePath = "/Users/nakano/Documents/htdocs/pub_hotate/public_html/card_sdk/c/card_s1dnp20231110_2024/server.key";//20231110 DNP2024年分
//$keyFilePath = "/home/mobile-hp/cmn_public/pub_imlsdk/ccards1_sdk/cert_s1/card_s1dnp20231110_2024/server.key";//20231110 DNP2024年分(dev2020)
//$keyFilePath = "/home/mobile-hp/cmn_public/pub_imlsdk/ccards1_sdk/cert_s1/card_dnp20241025s1_2025/server.key";//s1カード20241025DNP2025年分(dev2020)

//$keyFilePath = "/home/morita/Documents/pub_imlsdk/ccards1_mr_sdk/cert_s1/card_mr_dbg20250617/server.key";//動作判定、タッチ方向判定アナライザ版デバッグ
//$keyFilePath = "/home/morita/Documents/pub_imlsdk/ccards1_mr_sdk/cert_s1/card_mr_dbg20250619/server.key";//動作判定、タッチ方向判定アナライザ版デバッグ
//$keyFilePath = "/home/morita/Documents/dev/sdk/PKB_SDK_20250526/pub_imlsdk/ccards1_rm_sdk/cert_s1/card_rm_dbg_20250701/server.key";//タッチ方向判定x動作判定アナライザ版デバッグ
//$keyFilePath = "/home/morita/Documents/dev/sdk/PKB_SDK_20250526/pub_imlsdk/ccards1_rm_sdk/cert_s1/card_rm_dbg_20260128/server.key";//タッチ方向判定x動作判定アナライザ版デバッグ
//$keyFilePath = "/home/morita/Documents/dev/sdk/PKB_SDK_20250526/pub_imlsdk/ccards1_rm_sdk/cert_s1/card_rms1_clm20260224/server.key";//20260224 CoLaboMix様向けデバック用
//$keyFilePath = "/home/morita/Documents/dev/sdk/PKB_SDK_20250526/pub_imlsdk/ccards1_rm_sdk/cert_s1/card_rm_dbg_20260305/server.key";//20260304 山口証券印刷様デモページ用アクスタ3次、プレート試作用
$keyFilePath = "/home/morita/Documents/dev/sdk/PKB_SDK_20250526/pub_imlsdk/ccards1_rm_sdk/cert_s1/card_rm_dbg_20260930/server.key";//20260930 重心座標追加版アナライザver4.0.1 SDKデバッグ用


$encrypt = null;
//$key = file_get_contents("/Users/nakano/Documents/htdocs/csr/ca-privatekey.pem");
//$passphrase = null;
//if ($res = openssl_get_privatekey($key, $passphrase)) {
if ($res = file_get_contents($keyFilePath)) {
	foreach ($array as $row) {
		if (openssl_private_encrypt($row, $encrypt, $res)) {
			$encrypt = base64_encode($encrypt);

			$decrypt = decrypt($encrypt);
			print "raw: {$row}\n";
			print "encrypt: {$encrypt}\n";
			print "decrypt: {$decrypt}\n";
			print ($row === $decrypt) ? "matched\n" : "unmatched\n";
			print "\n";
		} else {
			print "failed encrypt\n";
		}
	}
} else {
	print "Private key not found\n";
}


function decrypt($value) {
	$decrypt = null;
	//TODO 都度変更 SDKフォルダに配置したopenssl証明書(server.crt)のパスを記述する
	//$path = $confDir."/c/server.key";
	//$path = "/Users/nakano/Documents/htdocs/csr/server.crt";
	//$path = "/Users/nakano/Documents/htdocs/pub_hotate/public_html/card_sdk/c/spiritek/server.crt";
	//$path = "/Users/nakano/Documents/htdocs/pub_hotate/public_html/card_sdk/c/spiritek/server_new.crt";
	//$path = "/Users/nakano/Documents/htdocs/pub_hotate/public_html/card_sdk/c/newphoria/server.crt";
	//$path = "/Users/nakano/Documents/htdocs/pub_hotate/public_html/card_sdk/c/nesic_iot/server.crt";
	//$path = "/Users/nakano/Documents/htdocs/pub_hotate/public_html/ccard_sdk/card_jwbl/c/server.crt";
	//$path = "/Users/nakano/Documents/htdocs/pub_hotate/public_html/ccard_sdk/card_wakasa/c/tmp/server.crt";

	//$path = "/Users/nakano/Documents/htdocs/pub_hotate/public_html/ccard_sdk/card_moriilab/c/server.crt";
	//$path = "/Users/nakano/Documents/htdocs/pub_hotate/public_html/ccard_sdk/card_dnp/c/server.crt";
	//$path = "/Users/nakano/Documents/htdocs/pub_hotate/public_html/card_sdk/c/card_s1dnp20231110_2024/server.crt";
	// $path = "/Users/nakano/Documents/htdocs/pub_hotate/public_html/ccards1_sdk/card_dnp20240516s1_2024/c/server.crt";
	//$path = "/home/mobile-hp/cmn_public/pub_imlsdk/ccards1_sdk/card_dnp20240516s1_2024/c/server.crt";//20240516 DNP2024年分(dev2020)
	//$path = "/home/mobile-hp/cmn_public/pub_imlsdk/ccards1_sdk/card_dnp20241025s1_2025/c/server.crt";//s1カード20241025DNP2025年分(dev2020)

	//$path = "/home/morita/Documents/pub_imlsdk/ccards1_mr_sdk/card_mr_dbg20250617/c/server.crt";//動作判定、タッチ方向判定アナライザ版デバッグ
	//$path = "/home/morita/Documents/pub_imlsdk/ccards1_mr_sdk/card_mr_dbg20250619/c/server.crt";//動作判定、タッチ方向判定アナライザ版デバッグ
	//$path = "/home/morita/Documents/dev/sdk/PKB_SDK_20250526/pub_imlsdk/ccards1_rm_sdk/card_rm_dbg_20250701/c/server.crt";//タッチ方向判定x動作判定アナライザ版デバッグ
	//$path = "/home/morita/Documents/dev/sdk/PKB_SDK_20250526/pub_imlsdk/ccards1_rm_sdk/card_rm_dbg_20260128/c/server.crt";//タッチ方向判定x動作判定アナライザ版デバッグ
	//$path = "/home/morita/Documents/dev/sdk/PKB_SDK_20250526/pub_imlsdk/ccards1_rm_sdk/card_rms1_clm20260224/c/server.crt";//20260224 CoLaboMix様向けデバック用
	//$path = "/home/morita/Documents/dev/sdk/PKB_SDK_20250526/pub_imlsdk/ccards1_rm_sdk/card_rm_dbg_20260305/c/server.crt";//20260304 山口証券印刷様デモページ用アクスタ3次、プレート試作用
	$path = "/home/morita/Documents/dev/sdk/PKB_SDK_20250526/pub_imlsdk/ccards1_rm_sdk/card_rm_dbg_20260930/c/server.crt";//20260930 重心座標追加版アナライザver4.0.1 SDKデバッグ用


	try {
		if (file_exists($path)) {
			if ($key = file_get_contents($path)) {
				if (openssl_get_publickey($key)) {

					$timeZone = date_default_timezone_get();

					$now = time();
					//$now += 86400 * 365 * 1.20658;
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
					print "is valid ".date("Y/m/d H:i:s", $now)." <= ".date("Y/m/d/ H:i:s", $validTo)."\n";
					if ($now <= $validTo) {
						openssl_public_decrypt(base64_decode($value), $decrypt, $key);
					}
					date_default_timezone_set($timeZone);
				}
			}
		} else {
			print "crt not found\n";
		}
	} catch (Exception $e) {
		//error_log(__FUNCTION__."[".__LINE__."] ".$e->getMessage());
		print basename(__FILE__)." > ".__FUNCTION__."[".__LINE__."] ".$e->getMessage()."\n";
	}
	return $decrypt;
}
