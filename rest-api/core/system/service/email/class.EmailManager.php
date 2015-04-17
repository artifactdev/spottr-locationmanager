<?php

/**
 * This EmailManager class provides some methods to send Emails via the system.
 *
 * @package MJ-REST api core
 * @subpackage system
 * @version 0.9.0
 * @author Markus Jahn
 * @copyright (c) 2015, Markus Jahn, markus-jahn@gmx.net
 */
class EmailManager
{

    /**
     * Loggerinstance.
     *
     * @var Logger
     */
    private $logger;

    /**
     * Default constructor.
     */
    public function __construct()
    {
        $this->logger = Logger::getLogger("emailManager");
        require_once CONF_FS_CORE_LIBS . 'PHPMailer-master/PHPMailerAutoload.php';
    }

    /**
     * This method send an email with the given email data.
     * If some values are invalid, an EmailException will be thrown.
     *
     * @param EmailBasic $emailBasic
     *            Email object to send.
     */
    public function send($emailBasic)
    {
        // TODO validation

        $mail = new PHPMailer();
        $mail->setFrom($emailBasic->sender->emailAddress, $emailBasic->sender->emailAlias);

        foreach ($emailBasic->recipients as $recipient) {
            $mail->addAddress($recipient->emailAddress, $recipient->emailAlias);
        }

        foreach ($emailBasic->recipientsCC as $recipient) {
            $mail->addCC($recipient->emailAddress, $recipient->emailAlias);
        }

        foreach ($emailBasic->recipientsBCC as $recipient) {
            $mail->addBCC($recipient->emailAddress, $recipient->emailAlias);
        }

        $mail->Subject = $emailBasic->subject;
        $mail->CharSet = 'utf-8';
        $mail->isHTML(true);

        $mail->Body = $emailBasic->bodyHTML;
        $mail->AltBody = $emailBasic->bodyAlt;

        if (! $mail->send()) {
            // TODO throw exception
        }
    }
}
