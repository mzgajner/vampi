<?php

namespace AppBundle\Service;

use Symfony\Component\Process\Process;

class Lemmatizer
{
    public static function convert($word, $lang)
    {
        $process = new Process(sprintf('bin/lemmagen/lemmatizer bin/lemmagen/dictionaries/%s.bin %s', $lang, $word));
        $process->run();

        if (!$process->isSuccessful()) {
            throw new \RuntimeException($process->getErrorOutput());
        }

        return $process->getOutput();
    }

}