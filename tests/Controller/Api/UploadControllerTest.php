<?php

/**
 * Copyright Skywire. All rights reserved.
 * See LICENSE.txt for license details.
 *
 * @author      Skywire Core Team
 * @copyright   Copyright (c) 2020 Skywire (http://www.skywire.co.uk)
 */
declare(strict_types=1);

namespace App\Tests\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadControllerTest extends WebTestCase
{
    /**
     * @var \Symfony\Bundle\FrameworkBundle\KernelBrowser
     */
    private $client;

    protected function setUp(): void
    {
        $this->client = self::createClient();
        self::bootKernel();
    }

    public function testUpload()
    {
        copy(__DIR__. '/_files/upload-test.jpg', __DIR__. '/_files/upload-tmp.jpg');
        $file = new UploadedFile(__DIR__. '/_files/upload-tmp.jpg', 'upload.jpg', 'image/jpeg');

        $this->client->request('POST', 'api/upload', [], ['upload' => ['file' => $file]]);

        $response = $this->client->getResponse()->getContent();

        $this->assertContains('upload-', $response);
        $this->assertContains('.jpeg', $response);
    }
}
