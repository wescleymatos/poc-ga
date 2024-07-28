<?php

namespace App\Infra\Services\Logs;

enum LogLevel: string
{
    case INFO = 'Information';
    case DEBUG = 'Debug';
    case WARNING = 'Warning';
    case ERROR = 'Error';
    case TRACE = 'Trace';
}
