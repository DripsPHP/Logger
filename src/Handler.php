<?php

namespace Drips\Logger;

use Drips\Debugbar\Debugbar;
use Monolog\Handler\AbstractHandler;
use Monolog\Logger as Monolog;

/**
 * Class Handler
 *
 * Diese Klasse dient als Monolog-Handler, um die Logeinträge direkt in der Debugbar anzeigen zu können.
 *
 * @package Drips\Logger
 */
class Handler extends AbstractHandler
{
    /**
     * Zuweisung welcher Log-Level welcher Farbe (Debugbar-Label) entspricht
     *
     * @var array
     */
    public $logLevels = array(
        Monolog::DEBUG => '#AAAAAA',
        Monolog::INFO => '#4FC1E9',
        Monolog::NOTICE => '#A0D468',
        Monolog::WARNING => '#FFC354',
        Monolog::ERROR => '#E9573F',
        Monolog::CRITICAL => '#FC6E51',
        Monolog::ALERT => '#DA4453',
        Monolog::EMERGENCY => '#FF0000',
    );

    /**
     * Schreibt die einzelnen Log-Records in die Debugbar
     *
     * @param array $record
     *
     * @return bool
     */
    public function handle(array $record)
    {
        if (!$this->isHandling($record)) {
            return false;
        }

        if (class_exists('Drips\Debugbar\Debugbar')) {
            $debugbar = Debugbar::getInstance();
            if (!$debugbar->hasTab('logger')) {
                $debugbar->registerTab('logger', 'Logs', '<style>' . file_get_contents(__DIR__ . '/style.css') . '</style>');
            }
            $color = $this->logLevels[$record['level']];
            $channel = $record['channel'];
            $level = $record['level_name'];
            $message = $record['message'];
            $log_message = "
            <code class='drips-logger-record' style='color: $color'>
                <table>
                    <tr>
                        <td valign='top'><span class='debug-badge debug-channel'>$channel</span></td>
                        <td valign='top'><strong class='debug-badge' style='background-color: $color'>$level</strong></td>
                        <td valign='top' style='color: $color'>$message</td>
                    </tr>
                </table>
            </code>
           ";
            $debugbar->appendTab('logger', $log_message);
        }

        return false === $this->bubble;
    }
}
