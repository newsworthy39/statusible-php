<?php


declare(strict_types=1);

namespace newsworthy39\Log;

class Log
{
    private $logLevel = LOG_INFO;

    public function __construct()
    {
        $tmp = getenv('LOG_LEVEL');
        if (is_string($tmp)) {
            if (strtolower($tmp) == "log_debug") {
                $this->logLevel = LOG_DEBUG;
            }
            if (strtolower($tmp) == "log_info") {
                $this->logLevel = LOG_INFO;
            }
            if (strtolower($tmp) == "log_error") {
                $this->logLevel = LOG_ERROR;
            }
            if (strtolower($tmp) == "log_warning") {
                $this->logLevel = LOG_WARNING;
            }
        }
        openlog("app", LOG_PID | LOG_PERROR, LOG_SYSLOG);
        syslog($this->logLevel, sprintf("%s: Logger starting loglevel %d \n", date("r"), $this->logLevel));
    }

    public function __destruct()
    {
        closelog();
    }

    public function info(String $format)
    {
        if ($this->logLevel >= LOG_INFO) {
            syslog($this->logLevel, vsprintf(sprintf("%s: %s", date("r"), $format), array_slice(func_get_args(), 1)));
        }
    }

    public function error(String $format)
    {
        if ($this->logLevel >= LOG_ERROR) {
            syslog($this->logLevel,  vsprintf(sprintf("%s: %s", date("r"), $format), array_slice(func_get_args(), 1)));
        }
    }

    public function debug(String $format)
    {
        if ($this->logLevel >= LOG_DEBUG) {
            syslog($this->logLevel, vsprintf(sprintf("%s: %s", date("r"), $format), array_slice(func_get_args(), 1)));
        }
    }
}
