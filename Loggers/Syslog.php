<?php
namespace sLog\Loggers;

/**
 * Логирование в syslog
 *
 * @example new sLog\Logger\Syslog(array('my_name'=>'my_process', \sLog\Level::NOTICE))
 *
 * @package sLog\Loggers
 */

class Syslog extends \sLog\LoggerAbstract {
    /**
     * Префикс который будет вписан перед текстом лога
     * @var string
     */
    private $my_name;
    public function __construct(array $params=array(), $level = \sLog\Level::DEBUG)
    {
        parent::__construct(array(), $level);
        if (!isset($params['my_name']) || empty($params['my_name'])) {
            $params['my_name'] = uniqid('sLog_');
        }
        $this->my_name = $params['my_name'];
        openlog($this->my_name, LOG_PID | LOG_PERROR, LOG_LOCAL0);
    }

    public function log($log, $level=\sLog\Level::INFORMATION, $params = array())
    {
        $this->put($log, $level);
    }

    private function put($s, $level)
    {
        syslog($level, $s);
    }
}