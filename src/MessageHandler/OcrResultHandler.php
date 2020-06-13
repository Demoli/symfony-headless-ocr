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

use App\Entity\OcrResult;
use App\Message\OcrResultMessage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class OcrResultHandler implements MessageHandlerInterface
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    public function __invoke(OcrResultMessage $message)
    {
         $result = new OcrResult();

        $result->setFileId($message->getId())
            ->setResultText($message->getText());

        $this->entityManager->persist($result);
        $this->entityManager->flush();
    }
}
