<?php
/**
 * Расширеяет класс до возможности логирования
 */
namespace sLog;

/**
 * Придает любому классу возможность писать в лог
 *
 * @package sLog
 */
class Loggerable {
    /**
     * Запись лога
     * @param       $txt Текст лога
     * @param int   $level Уровень лога(один из \sLog\Level)
     * @param array $params Список дополнительных параметров, которые тоже будут записаны в лог
     */
    protected function log($txt, $level = 5, $params = array()) {
        if (class_exists('sLog\sLog')) {
            \sLog\sLog::log(get_class($this) . ': ' . $txt, \sLog\Level::NOTICE, $params);
        }
    }
}