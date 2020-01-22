<?php

namespace App\components;

use \PHPMailer;

class Mail
{
    private $mail;

    /**
     * Mail constructor.
     * @param PHPMailer $PHPMailer
     * @throws \phpmailerException
     */
    public function __construct(PHPMailer $PHPMailer)
    {
        $this->mail = $PHPMailer;
        $this->mail->CharSet = 'utf-8';
        $this->mail->isSMTP();
        $this->mail->Host = config("mail")['smtp'];
        $this->mail->SMTPAuth = true;
        $this->mail->Username = config("mail")['email'];
        $this->mail->Password = config("mail")['password'];
        $this->mail->SMTPSecure = config("mail")['encryption'];
        $this->mail->Port = config("mail")['port'];
        $this->mail->setFrom($this->mail->Username, 'Администратор МГКИТ');
    }

    /**
     * Отправляет письмо
     *
     * @param $userEmail e-mail пользователя
     * @param $file ссылка на документ
     * @param $subject либо изменения либо расписание экзаменов
     * @param $unsubscribe отписаться
     * @throws \phpmailerException
     */
    public function send($userEmail, $file, $subject, $unsubscribe)
    {
        try {
            $this->mail->addAddress($userEmail);
            $this->mail->isHTML(true);
            $this->mail->Subject = $subject;
            $this->mail->Body =
                '<div style="background: #F2F2F2; text-align: center; padding: 20px 15px;">
                    <h3 style="font-size: 2rem; font-weight: bold;">' . $subject . '</h3>
                    <p><a style="background: #555555; padding: 15px 13px; color: #FFFFFF; text-decoration: none; border-radius: 9px;" href="' . config("domain") . $file . '">Посмотреть</a></p>
                    <p style="margin-top: 35px;">Вы получили это письмо, потому что Вы подписались на рассылку на сайте УниКИТ<a style="color: #888888; display: block;" target="_blank" href="' . config("domain") .  'unsubscribe/' . $unsubscribe . '">Отписаться от рассылки</a></p>
                </div>';
            $this->mail->send();
            $this->mail->clearAddresses();
        }

        catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}"; die;
        }
    }

    /**
     * Отправляет письмо при изменении основного расписания
     *
     * @param $userEmail
     * @param $file
     * @param $subject
     * @param $idCourse
     * @param $unsubscribe
     * @throws \phpmailerException
     */
    public function sendCourses($userEmail, $file, $subject, $idCourse, $unsubscribe)
    {
        try {
            $this->mail->addAddress($userEmail);
            $this->mail->isHTML(true);
            $this->mail->Subject = $subject;
            $this->mail->Body =
                '<div style="background: #F2F2F2; text-align: center; padding: 20px 15px;">
                    <h3 style="font-size: 2rem; font-weight: bold;">На сайте УниКИТ опубликовано новое расписание ' . $idCourse . ' курса</h3>
                    <p><a style="background: #555555; padding: 15px 13px; color: #FFFFFF; text-decoration: none; border-radius: 9px;" href="' . config("domain") . $file . '">Посмотреть расписание</a></p>
                    <p style="margin-top: 35px;">Вы получили это письмо, потому что Вы подписались на рассылку на сайте УниКИТ<a style="color: #888888; display: block;" target="_blank" href="' . config("domain") .  'unsubscribe/' . $unsubscribe . '">Отписаться от рассылки</a></p>
                </div>';
            $this->mail->send();
            $this->mail->clearAddresses();
        }

        catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}"; die;
        }
    }
}