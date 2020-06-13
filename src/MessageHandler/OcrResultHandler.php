<?php

/**
 * Copyright Skywire. All rights reserved.
 * See LICENSE.txt for license details.
 *
 * @author      Skywire Core Team
 * @copyright   Copyright (c) 2020 Skywire (http://www.skywire.co.uk)
 */
declare(strict_types=1);

namespace App\MessageHandler;

use App\Message\OcrResultMessage;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class OcrResultHandler implements MessageHandlerInterface
{
    public function __invoke(OcrResultMessage $message)
    {
        echo $message->getId() . PHP_EOL;
        echo $message->getText();
    }
}
