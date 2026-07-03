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
$keyFilePath = "/home/morita/Documents/dev/sdk/PKB_SDK_20250526/pub_imlsdk/ccards1_rm_sdk/cert_s1/card_rm_dbg_20260305/server.key";//20260304 山口証券印刷様デモページ用アクスタ3次、プレート試作用

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
	$path = "/home/morita/Documents/dev/sdk/PKB_SDK_20250526/pub_imlsdk/ccards1_rm_sdk/card_rm_dbg_20260305/c/server.crt";//20260304 山口証券印刷様デモページ用アクスタ3次、プレート試作用

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
