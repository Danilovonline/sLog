<?php
namespace sLog\Loggers;

/**
 * Логирование на почту
 *
 * @example new sLog\Logger\File(array('emails'=>'danilov@izhnet.ru', \sLog\Level::NOTICE))
 * @example new sLog\Logger\File(array('emails'=>array('danilov@izhnet.ru','noc@izhnet.ru') \sLog\Level::NOTICE))
 *
 * @package sLog\Loggers
 */

class Mail extends \sLog\LoggerAbstract {
    private $emails = array();

    /**
     * Настройка логирования в файл
     * @param array $params Список параметров(email - адрес или список адресов на которые будет выслан лог )
     * @param int   $level Минимальный уровень лога, который нужно логировать
     */

    public function __construct(array $params=array(), $level = \sLog\Level::DEBUG)
    {
        parent::__construct(array(), $level);
        $this->emails = is_array($params['email']) ?
            $params['email'] :
            array($params['email']);
    }

    public function log($log, $level=\sLog\Level::INFORMATION, $params = array())
    {
        $params['dt'] =  (isset($params['dt'])) ? $params['dt'] : date("Y-m-d H:i:s");
        $params['log'] = $log;

        $msg = array();
        foreach($params as $k=>$v) {
            $msg[] = "<b>{$k}</b>:<br><pre>" . print_r($v, true) . "</pre><br>";
        }
        $msg = implode("<br>", $msg);
        $sbj = mb_strtoupper(\sLog\Level::getName($level)) . ': ' . $log;
        $this->put($sbj, $msg, $level);
    }

    private function put($sbj, $msg, $level)
    {
        $emails = implode(',', $this->emails);
        $headers = array(
            'X-Log-Level: ' . $level,
            'MIME-Version: 1.0',
            'Content-type: text/html; charset=utf8',
        );
        $headers = implode("\r\n", $headers);

        $sbj = '=?UTF-8?B?' . base64_encode($sbj) . '?=';
        if (!mail($emails, $sbj, $msg, $headers)) {
            echo "!!! MAIL: error send\n\n";
        };
    }
}