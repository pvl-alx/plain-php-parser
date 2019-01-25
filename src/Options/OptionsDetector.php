<?php

namespace Options;

use Commands\ICommand;
use InvalidArgumentException;
use Url\Url;
use Url\UrlGenerator;

/**
 * Class OptionsDetector
 * @package Options
 */
class OptionsDetector
{
    /**
     * @param ICommand $command
     * @return Url
     */
   public static function detect(ICommand $command) : Url
   {
       $opt = getopt(null, $command->getArguments());

       if (empty($opt)) {
           throw new InvalidArgumentException("I'm sorry arguments are not valid.");
       }

       $opt = array_values($opt);
       $opt = reset($opt);
       return (new UrlGenerator($opt))->generate();
   }
}
