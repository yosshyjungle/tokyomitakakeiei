<?php echo"<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8" />
<title>予約・応募フォーム連動 営業日カレンダー</title>
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta name="Keywords" content="" />
<meta name="Description" content="" />
</head>
<body>
<?php require_once('calendar_form/admin/config.php');//設定ファイルインクルード?>

<?php if(!isset($_POST["reservSubmit"]) && empty($_GET['mode'])){//▼カレンダーを表示（フォームは非表示）▼ ?>
<?php if(!$copyright) exit($warningMesse); else {$scheduleCalender = scheduleCalenderMb($ym,$timeStamp);?>
<table width="100%" bgcolor="<?php echo $headerBgColor;?>" style="color:<?php echo $headerColor;?>;font-size:large;background-color:<?php echo $headerBgColor;?>;"><tr><td align="center"><font color="<?php echo $headerColor;?>"><?php echo $scheduleCalender['calnderHeaderYm'];?></font></td></tr></table>

<table width="100%">
<tr>
<?php if(!empty($scheduleCalender['dspPrev'])){ ?>
<td align="left"><a href="?ym=<?php echo $scheduleCalender['dspPrev'];?>">&laquo; 前月へ</a></td>
<?php } ?>

<?php if(!empty($scheduleCalender['dspNext'])){ ?>
<td align="right"><a href="?ym=<?php echo $scheduleCalender['dspNext'];?>">翌月へ &raquo;</a></td>
<?php } ?>
</tr>
</table>

<!--　▼以下休業日、定休日テキスト箇所。すべて削除してしまってオリジナルでももちろんOKです▼　-->
<table>
  <tr>
<?php if($closedText) { //定休日テキストを表示（背景色が休業日と違ったら） ?>
    <td bgcolor="<?php echo $closedBg; ?>" width="10">&nbsp;&nbsp;</td>
    <td><font size="2">定休日</font></td>
<?php } ?>
    <td bgcolor="<?php echo $holidayBg;//休業日のテキスト ?>" width="10">&nbsp;&nbsp;</td>
    <td><font size="2">休業日</font></td>
  </tr>
</table>
<!--　▲休業日、定休日テキスト箇所ここまで▲　-->
<hr />

<?php echo $scheduleCalender['body'];//カレンダー出力（カレンダー自体のタグ等を変更したい場合はfunction.php内を変更下さい）?>

<table width="100%">
<tr>
<?php if(!empty($scheduleCalender['dspPrev'])){ ?>
<td align="left"><a href="?ym=<?php echo $scheduleCalender['dspPrev'];?>">&laquo; 前月へ</a></td>
<?php } ?>

<?php if(!empty($scheduleCalender['dspNext'])){ ?>
<td align="right"><a href="?ym=<?php echo $scheduleCalender['dspNext'];?>">翌月へ &raquo;</a></td>
<?php } ?>
</tr>
</table>
<?php Uqa4h78r();}//著作権表記リンク無断削除禁止（削除すると全機能、または一部機能が失われます）?>

<?php }else{//▼申し込みフォームを表示（カレンダーは非表示）▼ ?>



<?php
//予約日時をカレンダーから取得（変更不可）
$date = (isset($_GET["date"])) ? calf_h($_GET["date"]) : exit('日付が選択されていません。戻って選択しなおして下さい<br /><a href="javascript:history.back()">戻る&raquo;<a>');
$time = (isset($_GET["time"])) ? calf_h($_GET["time"]) : '';
$dateArray = explode("-",$date);
$dspDate = $dateArray[0]."年".$dateArray[1]."月".$dateArray[2]."日";//日付フォーマットの変更
$dspDate .= ($weekDsp == 1) ? '（'.$weekArray[date('w',strtotime($date))].'）' : '';//曜日を表示する（設定ファイルでONの場合のみ）
$dspDate .= " ".$timeArray[$time];//時間リストの反映
?>

<!-- ▼予約フォーム表示▼ ※デフォルトを参考に項目などは自由に変更下さい。全項目を自動で取得、送信します。（PC（pc.php）、スマホ（sp.php）、ガラケー（i.php）それぞれ変更下さい ※使うデバイスのみでOKです） -->

<div align="center"><a href="?page=back">前画面に戻る</a></div>

  <h4>予約フォーム</h4>
  <div>下記フォームに必要事項を入力後、確認ボタンを押してください。</div>
  <hr />
<form action="calendar_form/mail/mb.php" method="post">

<p><?php echo $selectDateText;?><br /><?php echo $dspDate;?> <input type="hidden" name="reserv[date]" value="<?php echo $date;?>" /><input type="hidden" name="reserv[time]" value="<?php echo $time;?>" /></p>

<p>お名前 <span class="col19">*</span><br /><input size="20" type="text" name="お名前" /></p>

<p>電話番号（半角） <br /><input size="30" type="text" name="電話番号" /></p>

<p>メールアドレス（半角）<span class="col19">*</span><br /> <input size="30" type="text" name="メールアドレス" /></p>

<p>性別<br>
<input name="性別" id="men" type="radio" value="男" />
<label for="men">男</label>
<input name="性別" type="radio" value="女" id="female" />
<label for="female">女</label> 

<p>サイトを知ったきっかけ <br />
<input name="サイトを知ったきっかけ[]" type="checkbox" value="友人・知人" id="checkbox01" /><label for="checkbox01">友人・知人　</label> 
<input name="サイトを知ったきっかけ[]" type="checkbox" value="検索エンジン" id="checkbox02" /><label for="checkbox02">検索エンジン</label> </p>

<p>お問い合わせ内容 <br /><textarea name="お問い合わせ内容"></textarea></p>

<div align="center"><input type="submit" value="　 確認 　" /></div>
</form>


<?php Uqa4h78r();}//著作権表記リンク無断削除禁止（削除すると全機能、または一部機能が失われます）?>
</body>
</html>
