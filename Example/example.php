<?php
require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'sLog.php';
require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'Level.php';
require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'LoggerAbstract.php';
require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'Loggers/File.php';
require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'Loggers/Mail.php';
require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'Loggers/Syslog.php';

use \sLog\sLog;

// настроить логгеры
sLog::addLogger(
    new \sLog\Loggers\File (
        array('file' => '/tmp/sLog.log'),
        \sLog\Level::DEBUG
    )
);

sLog::addLogger(
    new \sLog\Loggers\Syslog(array(),
        \sLog\Level::DEBUG
    )
);

sLog::addLogger(
    new \sLog\Loggers\Mail (
        array('email' => 'danilov@izhnet.ru'),
        \sLog\Level::WARNING
    )
);


sLog::log('Debug message', \sLog\Level::DEBUG);
sLog::log(
    'Warning message',
    \sLog\Level::WARNING,
    array('script'=>'test.php', 'line' => 10) //кроме сообщения послать дополнительные данные
);

