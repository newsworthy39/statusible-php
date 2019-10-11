<?php


declare(strict_types=1);

namespace newsworthy39\Log;

class Log
{

    public const LOG_INFO = 0;
    public const LOG_WARNING = 1;
    public const LOG_ERROR = 2;
    public const LOG_DEBUG = 3;

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
        printf("%s: Logger starting loglevel %d \n", date("r"), $this->logLevel);
    }

    public function info(String $format)
    {
        if ($this->logLevel >= LOG_INFO) {
            vprintf(sprintf("%s: %s", date("r"), $format), array_slice(func_get_args(),1));
        }
    }

    public function error(String $format)
    {
        if ($this->logLevel >= LOG_ERROR) {
            vprintf(sprintf("%s: %s", date("r"), $format), array_slice(func_get_args(),1));
        }
    }

    public function debug(String $format)
    {
        if ($this->logLevel >= LOG_DEBUG) {
            vprintf(sprintf("%s: %s", date("r"), $format), array_slice(func_get_args(),1));
        }
    }
}
