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

	// Check if tel has been entered and is valid
	if (!isset($_POST['tel'])) {
		$errors['tel'] = 'Please enter your phone number';
	}

	// Check if email has been entered and is valid
	if (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$errors['email'] = 'Please enter a valid email address';
	}

	// Check if message has been entered
	if (!isset($_POST['message'])) {
		$errors['message'] = 'Please enter your message';
	}

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
	$tel = $_POST['tel'];
	$email = $_POST['email'];
	$message = $_POST['message'];

	$name = htmlspecialchars($name);
	$address = htmlspecialchars($address);
	$tel = htmlspecialchars($tel);
	$email = htmlspecialchars($email);
	$message = htmlspecialchars($message);

	$from = $email;

#ここのメールアドレスを管理者用に変更する
	$to = 'yosshyjungle@gmail.com';  // please change this email id

	#文字コード変換
	$to = mb_convert_encoding($to,"sjis","utf-8");

	$subject = 'Contact Form : From Web Site';

	#文字コード変換
	$subject = mb_convert_encoding($subject,"sjis","utf-8");


	$body = "From: $name\n Address: $address\n Phone: $tel\n E-Mail: $email\n Message:\n $message";
	// $body = "From: $name\n Address: $address\n Phone: $tel\n E-Mail: $email";

	#文字コード変換
	$body = mb_convert_encoding($body,"sjis","utf-8");

	$headers = "From: ".$from;
	#文字コード変換
	$address = mb_convert_encoding($address,"sjis","utf-8");
	#文字コード変換
	$message = mb_convert_encoding($message,"sjis","utf-8");


	//送信完了画面
	$result = '';
	if (mail ($to, $subject, $body, $headers)) {
		$result .= '<div align="center" style="margin:0 auto">';
		$result .= '<h1 align="center;margin-top:20px;">ありがとうございました。</h1>';

		$result .= '<h2><a href="' . $_SERVER['HTTP_REFERER'] . '"><button style="background: #0e487a;color: #fff;border: 2px solid #0e487a !important;text-align:center;display:inline-block;padding:10px;font-size:20px;border-radius:5px">前に戻る</button></a></h2>';
 		// $result .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		$result .= '<hr>';
		$result .= '<p align="center">送信が完了しました。「前に戻る」ボタンをクリックしお戻りください。</p>';
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
