<?php
    //    SETTINGS FOR GMAIL ACCOUNT
    // https://www.google.com/settings/u/1/security/lesssecureapps
    // https://accounts.google.com/b/0/DisplayUnlockCaptcha
    // https://security.google.com/settings/security/activity?hl=en&pli=1

    //This function send email to user : return true if success
    function sendEmailToUser($mailReceiver, $nameReceiver, $listName, $owner, $right, $subject){
     //SMTP needs accurate times, and the PHP time zone MUST be set
     //This should be done in your php.ini, but this is how to do it if you don't have access to that
     date_default_timezone_set('Etc/UTC');

     // load Class for PHPMAILER
     require_once 'phpmailer/PHPMailerAutoload.php';

     $rightArray = array(
        "sharedSurveys" => "right of reading",
        "noshare" => "right of reading and writing");
     $rightType = $rightArray[$right];


     //Create a new PHPMailer instance
     $mail = new PHPMailer;

     //Tell PHPMailer to use SMTP
     $mail->isSMTP();

     //Enable SMTP debugging
     // 0 = off (for production use)
     // 1 = client messages
     // 2 = client and server messages
     $mail->SMTPDebug = 0;

     //Ask for HTML-friendly debug output
     $mail->Debugoutput = 'html';

     //Set the hostname of the mail server
     $mail->Host = 'smtp.gmail.com';

     //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
     $mail->Port = 587;

     //Set the encryption system to use - ssl (deprecated) or tls
     $mail->SMTPSecure = 'tls';

     //Whether to use SMTP authentication
     $mail->SMTPAuth = true;

     //Username to use for SMTP authentication - use full email address for gmail
     $mail->Username = "loldilenardafr@gmail.com";

     //Password to use for SMTP authentication
     $mail->Password = "loldilenardatest";

     //Set who the message is to be sent from
     $mail->setFrom('loldilenardafr@gmail.com', 'Online Survey');

     //Set an alternative reply-to address
     $mail->addReplyTo('francoisleclercq4@gmail.com', 'Francois Leclercq');

     //Set who the message is to be sent to
     $mail->addAddress($mailReceiver, $nameReceiver);

     //Set the subject line
     $mail->Subject = "$nameReceiver, you've been invited to take a survey!";

     //Read an HTML message body from an external file, convert referenced images to embedded,
     //convert HTML into a basic plain-text alternative body
     $content = str_replace(
       array('#mailReceiver#','#nameReceiver#','#listName#','#owner#', '#rightType#', '#subject#'),
       array($mailReceiver, $nameReceiver, $listName, $owner, $rightType, $subject),
       file_get_contents("../private/library/template/content.html")
     );


     $mail->msgHTML($content , dirname(__FILE__));

     // embedded the images to the mail
     $mail->AddEmbeddedImage('../private/library/template/images/banner.png', 'banner');
     $mail->AddEmbeddedImage('../private/library/template/images/facebook.png', 'facebook');
     $mail->AddEmbeddedImage('../private/library/template/images/instagram.png', 'instagram');
     $mail->AddEmbeddedImage('../private/library/template/images/logo.png', 'logo');
     $mail->AddEmbeddedImage('../private/library/template/images/twitter.png', 'twitter');
     $mail->AddEmbeddedImage('../private/library/template/images/youtube.png', 'youtube');

     //Replace the plain text body with one created manually
     $mail->AltBody = 'This is a plain-text message body';

     //send the message, check for errors
     if ($mail->send()) {
       return true;
     }
     return false;
   }
?>
<script charset="utf-8"></script>