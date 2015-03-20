<?php
/**
 * Библиотека логирования в файл, в syslog, на почту
 */
namespace sLog;
/**
 * Библиотека логирования
 *
 * С помощью это класса производится:
 *   - настройка логирования(список логеров и их настройки)
 *   - запись лога
  *
 * @package sLog
 */
class sLog {
    /**
     * @var bool Флаг, говорящий о выводе лога в консоль
     */
    static public $debug = false;

    /**
     * Минимальный уровень лога(один из \sLog\Level), который нужно логировать
     * @var int
     */
    static public $debug_backtrace_level = \sLog\Level::WARNING;

    /**
     * @var array - список логеров
     */
    static private $loggers = array();

    /**
     * Запись лога(при обращении к классу как к функции)
     * @param       $log - текст лога
     * @param int   $status - уровень лога(один из \sLog\Level)
     * @param array $params - список дополнительных параметров, для сохранения в лог
     */
    static public function __invoke($log, $status = \sLog\Level::ALERT, $params = array()) {
        self::log($log, $status = \sLog\Level::ALERT, $params);
    }

    /**
     * Добавляет еще один логер
     * @param LoggerAbstract $Logger - логер(в файл, в syslog, на почту...)
     * @param null           $name - имя логера
     */
    static public function addLogger(\sLog\LoggerAbstract $Logger, $name = null)
    {
        if ($name) {
            self::$loggers[$name] = $Logger;
        } else {
            self::$loggers[] = $Logger;
        }
    }

    /**
     * Запись лога
     *
     * Перебирает список логов и записывает в те логи, которые удовлетворяют уровню лога
     *
     * @param       $log - текст лога
     * @param int   $status - уровень лога(один из \sLog\Level)
     * @param array $params - список дополнительных параметров, для сохранения в лог
     */

    static public function log($log, $level = \sLog\Level::DEBUG, $params = array())
    {

        if (self::$debug) {
            echo \sLog\Level::getName($level) . "\t$log\n";
        }

        if ($level <= \sLog\Level::WARNING) {
            $params['debug_backtrace'] = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 1);
        }


        /* @var $logger \sLog\LoggerAbstract */
        foreach(self::$loggers as $logger) {
            if ($logger->getLevel() >= $level) {
                $logger->log($log, $level, $params);
            }
        }
    }

    /**
     * Включает вывод лога в консоль
     */
    static public function enableDebug()
    {
        self::$debug = true;
    }

    /**
     * Выключает вывод лога в консоль
     */
    static public function disableDebug()
    {
        self::$debug = false;
    }

    /**
     * Устанавливает мимнимальный уровень лога(один из \sLog\Level)), которые нужно логировать
     * @param int $level
     */
    static public function setDebugBacktraceLevel($level = \sLog\Level::WARNING)
    {
        self::$debug_backtrace_level = $level;
    }

}