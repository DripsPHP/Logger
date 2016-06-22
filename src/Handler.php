<?php

namespace Drips\Logger;

use Monolog\Handler\AbstractHandler;
use Drips\Debugbar\Debugbar;
use Monolog\Logger as Monolog;

class Handler extends AbstractHandler
{
    public $logLevels = array(
        Monolog::DEBUG     => '#AAAAAA',
        Monolog::INFO      => '#4FC1E9',
        Monolog::NOTICE    => '#A0D468',
        Monolog::WARNING   => '#FFC354',
        Monolog::ERROR     => '#E9573F',
        Monolog::CRITICAL  => '#FC6E51',
        Monolog::ALERT     => '#DA4453',
        Monolog::EMERGENCY => '#FF0000',
    );

   public function handle(array $record)
   {
       if (!$this->isHandling($record)) {
           return false;
       }

       if (class_exists('Drips\Debugbar\Debugbar')) {
           $debugbar = Debugbar::getInstance();
           if($debugbar->hasTab('logger')){
               $debugbar->registerTab('logger', 'Logs', '<style>'.file_get_contents(__DIR__.'/style.css').'</style>');
           }
           $color = $this->logLevels[$record['level']];
           $channel = $record['channel'];
           $level = $record['level_name'];
           $message=  $record['message'];
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
