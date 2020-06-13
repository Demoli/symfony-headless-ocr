<?php

/**
 * Copyright Skywire. All rights reserved.
 * See LICENSE.txt for license details.
 *
 * @author      Skywire Core Team
 * @copyright   Copyright (c) 2020 Skywire (http://www.skywire.co.uk)
 */
declare(strict_types=1);

namespace App\Controller\Api;

use App\Form\UploadType;
use App\Message\OcrMessage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Throwable;

class UploadController extends AbstractController
{
    /**
     * @Route("/api/upload", name="api_upload")
     */
    public function index(Request $request, SluggerInterface $slugger, MessageBusInterface $messageBus)
    {
        $message = new OcrMessage();

        $form = $this->createForm(UploadType::class, $message);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $uploadFile */
            $uploadFile = $form->get('file')->getData();

            if ($uploadFile) {
                $originalFilename = pathinfo($uploadFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename  = $safeFilename . '-' . uniqid() . '.' . $uploadFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $targetDirectory = $this->getParameter('upload_directory');
                    $uploadFile->move(
                        $targetDirectory,
                        $newFilename
                    );

                    $absolute = $request->getUriForPath("/uploads/$newFilename");

                    $message->generateId()
                        ->setFile($absolute);

                    $messageBus->dispatch($message);

                    return new Response((string)$message->getId(), 200);
                } catch (Throwable $e) {
                    return new Response(null, 500);
                }
            }
        }
    }
}
