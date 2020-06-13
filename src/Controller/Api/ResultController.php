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

use App\Repository\OcrResultRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ResultController extends AbstractController
{
    /**
     * @Route("/api/result/{fileIds}", name="api_result")
     */
    public function index(Request $request, OcrResultRepository $repository, string $fileIds)
    {
        $fileIds = explode(',', $fileIds);

        $result = $repository->findByFileIds($fileIds);

        return $this->json($result);
    }
}
