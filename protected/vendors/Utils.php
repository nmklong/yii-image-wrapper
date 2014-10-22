<?
class Utils {

    # Convert datetime in UTC to local timezone for application
    public static function datetimeToLocal($datetime, $format='Y-m-d H:i:s') {
        $dt = new DateTime($datetime, new DateTimeZone("UTC"));
        $dt->setTimezone(new DateTimeZone(Yii::app()->params['timezone']));
        return $dt->format($format);
    }

    # Convert date in UTC to local timezone for application
    public static function dateToLocal($date) {
        $dt = new DateTime($date, new DateTimeZone("UTC"));
        $dt->setTimezone(new DateTimeZone(Yii::app()->params['timezone']));
        return $dt->format('Y-m-d');
    }

    public static function addDays($days, $datetime='') {
        if ($datetime) {
            $time = strtotime($datetime) + (60 * 60 * 24 * $days);
        }
        else {
            $time = time() + (60 * 60 * 24 * $days);
        }
        return date('Y-m-s H:i:s', $time);
    }

    public static function get($array, $key, $default = null) {
        return isset($array[$key]) ? $array[$key] : $default;
    }

    public static function supportedLanguages() {
        return self::get(Yii::app()->params, 'languages', array());
    }

    public static function isLanguageSupported($language) {
        return in_array($language, array_keys(self::supportedLanguages()));
    }

    public static function changeLanguage($language) {
        if (Utils::isLanguageSupported($language)) {
            Yii::app()->session['language'] = $language;
            Yii::app()->language = $language;
        }
    }

    public static function sendEmail($recipient, $subject, $body, $reply_to=null , $from_addr=null) {
        $app_email_name = Yii::app()->params['app_email_name'];

        $app_email = Yii::app()->params['app_email'];
        //If the 'from' address is specified
        if ($from_addr) {
            $app_email = $from_addr;
        }

        $mail = new PHPMailerLite();
        $mail->IsMail();
        $mail->CharSet = 'utf-8';

        if ($reply_to) {
            $mail->AddReplyTo($reply_to);
        }

        $mail->SetFrom($app_email, $app_email_name);
        $mail->AddAddress($recipient);
        $mail->Subject ="=?UTF-8?B?" .base64_encode($subject). "?=";
        //$mail->AltBody  = "To view the message, please use an HTML compatible email viewer!";
        $mail->AltBody  = $body;
        $mail->MsgHTML($body);
        $mail->Send();

        MyLog::debug("Sent email to $recipient, $subject");
    }
}
?>
