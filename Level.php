<?php
/**
 * Содержит список возможных уровней лога(ALERT, WARNING, NOTICE,...)
 */
namespace sLog;
/**
 * Содержит список возможных уровней лога(ALERT, WARNING, NOTICE,...)
 *
 * @package sLog
 */

class Level {
    /**
     * Авария: система неработоспособна
     */
    const EMERGENCY = 0;

    /**
     * Тревога: система требует немедленного вмешательства
     */
    const ALERT = 1;

    /**
     * Критический: состояние системы критическое
     */
    const CRITICAL = 2;

    /**
     * Ошибка: сообщения о возникших ошибках
     */
    const ERROR = 3;

    /**
     * Предупреждение: предупреждения о возможных проблемах
     */
    const WARNING = 4;

    /**
     * Замечание: сообщения о нормальных, но важных событиях
     */
    const NOTICE = 5;

    /**
     * Информационный: информационные сообщения
     */
    const INFORMATION = 6;

    /**
     * Отладка: отладочные сообщения
     */
    const DEBUG = 7; #

    /**
     * Возвращает имя по номеру уровня лога
     * @param $status
     *
     * @return string
     */
    static public function getName($status)
    {
        switch($status) {
            case self::EMERGENCY:
                return 'EMERGENCY';
                break;
            case self::ALERT:
                return 'ALERT';
                break;
            case self::CRITICAL:
                return 'CRITICAL';
                break;
            case self::ERROR:
                return 'ERROR';
                break;
            case self::WARNING:
                return 'WARNING';
                break;
            case self::NOTICE:
                return 'NOTICE';
                break;
            case self::INFORMATION:
                return 'INFORMATION';
                break;
            case self::DEBUG:
                return 'DEBUG';
                break;
            default:
                return '';
        }
    }
}