<?php
namespace sLog\Loggers;

/**
 * Логирование в файл
 *
 * @example new sLog\Logger\File(array('file'=>'/tmp/test.log', \sLog\Level::NOTICE))
 *
 * @package sLog\Loggers
 */
class File extends \sLog\LoggerAbstract {
    /**
     * Полный путь и имя файла, в который пишется лог
     * @var string

     */
    private $log_file;

    /**
     * Настройка логирования в файл
     * @param array $params Список параметров(file - полный путь и имя файла, в который пишется лог )
     * @param int   $level Минимальный уровень лога, который нужно логировать
     */
    public function __construct(array $params=array(), $level = \sLog\Level::DEBUG)
    {

        parent::__construct(array(), $level);
        $this->log_file = $params['file'];
        if (!file_exists($this->log_file)) {
            file_put_contents($this->log_file, '');
            chmod($this->log_file, 0777);
        }
        //$this->max_size_file_byte = 1024 * 1024;
    }

    public function log($log, $level=\sLog\Level::INFORMATION, $params = array())
    {
        $dt =  (isset($params['dt'])) ? $params['dt'] : date("Y-m-d H:i:s");
        $file =  (isset($params['file'])) ? $params['file'] : '';

        if (isset($params['dt'])) {
            unset($params['dt']);
        }
        if (isset($params['file'])) {
            unset($params['file']);
        }

        $raw = empty($params) ? base64_encode(serialize($params)) : '';

        $s = sprintf(
            "[%s]\t%s\t%s\t%s\t%s\n",
            $dt,
            $file,
            \sLog\Level::getName($level),
            $log,
            $raw
        );
        $this->put($s);
    }

    private function put($s)
    {
        file_put_contents($this->log_file, $s, FILE_APPEND);
    }
}