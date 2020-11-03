<?php

include 'mysqldb.php';
$category = $_POST["category"];

if($category =="ID"){//아이디 찾기
    $email = $_POST["email"];
    $query = "SELECT * FROM user WHERE email ='$email'";
    $result = $db->query($query);
    
    if(mysqli_num_rows($result)==1){
      $row=mysqli_fetch_assoc($result);
    
     //입력한 이메일과 데이터베이스 이메일이 동일할 경우

        $title = "1인가구중고시장 회원님의 아이디";
        $text = "회원님의 아이디는 [ ".$row['userID']." ] 입니다.";// 이메일 내용
        include_once('./PHPMailer/PHPMailerAutoload.php');
        mailer("1인가구중고시장","kimtkdgur78@naver.com",$email," ".$title," ".$text,1);
        // 네이버 메일 전송
        // 메일 -> 환경설정 -> POP3/IMAP 설정 -> POP3/SMTP & IMAP/SMTP 중에 IMAP/SMTP 사용
         
        // mailer("보내는 사람 이름", "보내는 사람 메일주소", "받는 사람 메일주소", "제목", "내용", "type");
        // type : text=0, html=1, text+html=2
       
          ?>
          
            "이메일로 회원님의 아이디가 발송되었습니다.
             
            
    <?php
    
        }else{
            ?>
           
             "이메일을 확인해주세요."
                
      <?php
        }
        
     
      
    
    }else{//임시비밀번호 재발급
        $email = $_POST["email"]; 
        $userid = $_POST["userID"];
        $query = "SELECT * FROM user WHERE email ='$email'";
        $result = $db->query($query);
        
        if(mysqli_num_rows($result)==1){
          $row=mysqli_fetch_assoc($result);

          if($row['userID']==$userid){    
            $randomString = ''; 
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
           
            for ($i = 0; $i < 10; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            
            
            $title = "1인가구중고시장 회원님의 임시비밀번호 입니다.";
            $text = "회원님의 임시비밀번호는  [ ".$randomString." ] 입니다.";// 이메일 내용
            include_once('./PHPMailer/PHPMailerAutoload.php');
            mailer("1인가구중고시장","kimtkdgur78@naver.com",$email,"".$title,"".$text,1);
            // 네이버 메일 전송
            // 메일 -> 환경설정 -> POP3/IMAP 설정 -> POP3/SMTP & IMAP/SMTP 중에 IMAP/SMTP 사용
             
            // mailer("보내는 사람 이름", "보내는 사람 메일주소", "받는 사람 메일주소", "제목", "내용", "type");
            // type : text=0, html=1, text+html=2
           

            //데이터베이스 임시비밀번호 변경
            $temporarily = "update user set password = '$randomString' where userID ='$userid'";
            $db->query($temporarily);

            ?>
              "이메일로 임시비밀번호가 발송되었습니다."
                    <?php
          }else{
            ?>
            "이메일 혹은 아이디를 확인해주세요."
      <?php
          }
        }else{
            ?>
              "이메일 혹은 아이디를 확인해주세요."
      <?php
        }
    }


    function generateRandomString($length = 10) {// 랜덤 난수 생성기 임시비밀번호 생성기
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
     
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
  }

    

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

     ?>