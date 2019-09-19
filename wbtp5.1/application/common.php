<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function mailto($to,$title,$content)
{
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 2;                                       // Enable verbose debug output
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->CharSet = 'utf-8';
        $mail->Host       = 'smtp.163.com';                     // SMTP服务器
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'qualsn@163.com';                     // SMTP username
        $mail->Password   = '125332825hjy';                               // SMTP password
        $mail->SMTPSecure = 'sll';                                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 465;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('qualsn@163.com', 'qualsn@163.com');
        $mail->addAddress($to);     // Add a recipient

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $title;
        $mail->Body    = $content;

        return $mail->send();
    } catch (Exception $e) {
        exception($mail->ErrorInfo,1001);
    }
}

//把span字符替换成a
function replace($data)
{
    return str_replace('span','a',$data);
}

//把字符串转换成数组
function strToArray($data)
{
    return explode('|',$data);
}