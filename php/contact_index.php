<?php

	$errors = array();

	// Check if name has been entered
	if (!isset($_POST['name'])) {
		$errors['name'] = 'Please enter your name';
	}

	// Check if address has been entered and is valid
	if (!isset($_POST['address'])) {
		$errors['address'] = 'Please enter your address';
	}

	// Check if volume has been entered and is valid
	if (!isset($_POST['volume'])) {
		$errors['volume'] = 'Please enter your phone number';
	}

	// Check if email has been entered and is valid
	if (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$errors['email'] = 'Please enter a valid email address';
	}

	// Check if email has been entered and is valid
	if (!isset($_POST['email2']) || !filter_var($_POST['email2'], FILTER_VALIDATE_EMAIL)) {
		$errors['email2'] = 'Please enter a confirmation email address';
	}

	// Check if email has been entered and is valid
	// if (!isset($_POST['volume']) || !filter_var($_POST['volume'], FILTER_VALIDATE_EMAIL)) {
	// 	$errors['volume'] = 'Please enter the number of volumes';
	// }


	// Check if message has been entered
	// if (!isset($_POST['volume'])) {
	// 	$errors['volume'] = 'Please enter the number of volumes';
	// }

	$errorOutput = '';

	if(!empty($errors)){

		$errorOutput .= '<div class="alert alert-danger alert-dismissible" role="alert">';
 		$errorOutput .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';

		$errorOutput  .= '<ul>';

		foreach ($errors as $key => $value) {
			$errorOutput .= '<li>'.$value.'</li>';
		}

		$errorOutput .= '</ul>';
		$errorOutput .= '</div>';

		echo $errorOutput;
		die();
	}

	//iphone用設定
	mb_language("Japanese");
	mb_internal_encoding("UTF-8");

	$name = $_POST['name'];
	$address = $_POST['address'];
	$volume = $_POST['volume'];
	$email = $_POST['email'];
	$email2 = $_POST['email2'];
	// $volume = $_POST['volume'];


	// $message = $_POST['message'];

	$name = htmlspecialchars($name);
	$address = htmlspecialchars($address);
	$volume = htmlspecialchars($volume);
	$email = htmlspecialchars($email);
	$email2 = htmlspecialchars($email2);
	// $volume = htmlspecialchars($volume);


	// $message = htmlspecialchars($message);

	$from = $email;

#ここのメールアドレスを管理者用に変更する
	// $to = 'yosshyjungle@gmail.com';  // please change this email id
	$to = 'info@sb-nm.ac.jp';  // please change this email id


	#文字コード変換
	$to = mb_convert_encoding($to,"sjis","utf-8");

	$subject = 'Contact Form : From Web Site';

	#文字コード変換
	$subject = mb_convert_encoding($subject,"sjis","utf-8");

	// $body = "From: $name\n Address: $address\n Phone: $volume\n E-Mail: $email\n Message:\n $message";
	// $body = "From: $name\n Address: $address\n E-Mail: $email\n E-Mail(Confirmation): $email2\n volume: $volume";
	$body = "From: $name\n Address: $address\n Volume: $volume\n E-Mail: $email\n E-Mail(Confirmation): $email2";


	#文字コード変換
	$body = mb_convert_encoding($body,"sjis","utf-8");

	$headers = "From: ".$from;
	#文字コード変換
	$address = mb_convert_encoding($address,"sjis","utf-8");
	#文字コード変換
	// $volume = mb_convert_encoding($volume,"sjis","utf-8");


	//送信完了画面
	$result = '';
	if (mail ($to, $subject, $body, $headers)) {
		$result .='<head><meta charset="utf-8"><style>h1{text-align:center;margin-top:40px;font-size:48px;}</style></head>';
		$result .= '<div align="center" style="margin:0 auto">';
		$result .= '<h1>ありがとうございました。</h1>';

		$result .= '<h2 style="font-size:48px;"><a href="' . $_SERVER['HTTP_REFERER'] . '"><button style="background: #0e487a;color: #fff;border: 2px solid #0e487a !important;text-align:center;display:inline-block;padding:10px;border-radius:5px;font-size:36px;">前に戻る</button></a></h2>';
 		// $result .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		$result .= '<hr>';
		$result .= '<p align="center" style="font-size:24px;">送信が完了しました。「前に戻る」ボタンをクリックしお戻りください。</p>';
		$result .= '</div>';

		echo $result;
		die();
	}

	$result = '';
	$result .= '<div class="alert alert-danger alert-dismissible" role="alert">';
	$result .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
	$result .= 'Something bad happend during sending this message. Please try again later';
	$result .= '</div>';

	echo $result;
