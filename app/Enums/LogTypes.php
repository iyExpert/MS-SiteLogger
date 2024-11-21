<?php

namespace App\Enums;

enum LogTypes: string
{
    case INFO = 'INFO';
    case ERROR = 'ERROR';
    case DEBUG = 'DEBUG';
    case JS_ERROR = 'JS_ERROR';
}
