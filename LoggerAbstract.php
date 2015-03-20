<?php
namespace sLog;

/**
 * Абстрактный класс, реализуя который можно написать свой логер
 *
 * @package sLog
 */
abstract class LoggerAbstract {
    /**
     * Минимальный уровень лога, который нужно логировать
     * @var int
     */
    protected $level;

    /**
     * @param array $params Список параметров
     * @param int   $level Минимальный уровень лога(один из \sLog\Level), который нужно записать
     */
    public function __construct(array $params = array(), $level = \sLog\Level::DEBUG)
    {
        $this->setLevel($level);
    }

    /**
     * Запись лога
     * @param       $log Текст лога
     * @param int   $level Уровень лога(один из \sLog\Level)
     * @param array $params Список параметров, которые тоже будут записаны в лог
     *
     * @return mixed
     */
    abstract public function log($log, $level = \sLog\Level::DEBUG, $params = array());

    /**
     * Установит мимнимального уровня лога, который нужно логировать
     * @param int $level Уровень лога(один из \sLog\Level)
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }

    /**
     * Вернет текущий уровень лога
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }


} 