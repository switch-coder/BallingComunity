<?php

if(!isset($_POST)){
    echo "값을 다시 확인해주세요</br>";
}else{

$text = $_POST["text"];
$email = $_POST["email"];


include_once('./PHPMailer/PHPMailerAutoload.php');
mailer("1인가구중고시장","kimtkdgur78@naver.com",$email,"1인가구중고시장 인증번호 ","아래 인증번호를 정확히 입력해주세요 <br/><br/> 인증번호 : ".$text,1);

}?>
"회원님의 이메일로 인증번호가 전송되었습니다."
<?php

// 네이버 메일 전송
// 메일 -> 환경설정 -> POP3/IMAP 설정 -> POP3/SMTP & IMAP/SMTP 중에 IMAP/SMTP 사용
 
// mailer("보내는 사람 이름", "보내는 사람 메일주소", "받는 사람 메일주소", "제목", "내용", "type");
// type : text=0, html=1, text+html=2
 
// ex) mailer("kOO", "zzxp@naver.com", "zzxp@naver.com", "제목 테스트", "내용 테스트", 1);
function mailer($fname, $fmail, $to, $subject, $content, $type=0, $file="", $cc="", $bcc="")
{
    if ($type != 1)
        $content = nl2br($content);
 
    $mail = new PHPMailer(); // defaults to using php "mail()"
    
    $mail->IsSMTP(); 
//    $mail->SMTPDebug = 2; 
    $mail->SMTPSecure = "ssl";
    $mail->SMTPAuth = true; 
 
    $mail->Host = "smtp.naver.com"; 
    $mail->Port = 465; 
    $mail->Username = "kimtkdgur78@naver.com";
    $mail->Password = "manias0428!"; 
 
    $mail->CharSet = 'UTF-8';
    $mail->From = $fmail;
    $mail->FromName = $fname;
    $mail->Subject = $subject;
    $mail->AltBody = ""; // optional, comment out and test
    $mail->msgHTML($content);
    $mail->addAddress($to);
    if ($cc)
        $mail->addCC($cc);
    if ($bcc)
        $mail->addBCC($bcc);
 
    if ($file != "") {
        foreach ($file as $f) {
            $mail->addAttachment($f['path'], $f['name']);
        }
    }
    return $mail->send();
}
 
// 파일을 첨부하는 경우 사용
// function attach_file($filename, $tmp_name)
// {
//     // 서버에 업로드 되는 파일은 확장자를 주지 않는다. (보안 취약점)
//     $dest_file = '경로지정/tmp/'.str_replace('/', '_', $tmp_name);
//     move_uploaded_file($tmp_name, $dest_file);
//     $tmpfile = array("name" => $filename, "path" => $dest_file);
//     return $tmpfile;
// }




?>