<?php

namespace Drips\Logger;

use Monolog\Handler\AbstractHandler;

class Handler extends AbstractHandler
{
   public function handle(array $record)
   {
       if (!$this->isHandling($record)) {
           return false;
       }
       dump($record);
       return false === $this->bubble;
   }
}
