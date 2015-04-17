<?php

/**
 * The TranslationUtils translates given messages to the current language.
 *
 * @package MJ-REST api core
 * @subpackage commons
 * @version 0.9.0
 * @author Markus Jahn
 * @copyright (c) 2014, Markus Jahn, markus-jahn@gmx.net
 */
class TranslationUtils
{
    /**
     * Translates the given message to the current selected language. If no message source was found, the message placeholder will be returned.
     * @param string $message Message to translate.
     * @return string Translated message.
     */
    public static function translate($message) {
        if (!is_string($message)) {
            return "No message found";
        }

            // TODO implement me and exceptions.
        return $message;
    }
}