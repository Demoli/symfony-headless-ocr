<?php

/**
 * Copyright Skywire. All rights reserved.
 * See LICENSE.txt for license details.
 *
 * @author      Skywire Core Team
 * @copyright   Copyright (c) 2020 Skywire (http://www.skywire.co.uk)
 */
declare(strict_types=1);

namespace App\Tests\Message;

use App\Message\OcrMessage;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\SentStamp;

class OcrMessageTest extends KernelTestCase
{
    protected function setUp(): void
    {
        self::bootKernel();
    }

    public function testMessageBus()
    {
        /** @var MessageBusInterface $bus */
        $bus = self::$container->get(MessageBusInterface::class);

        $message = new OcrMessage();
        $message->setContent('Foobar');

        $result = $bus->dispatch($message);

        $this->assertArrayHasKey(SentStamp::class, $result->all());
    }
}
