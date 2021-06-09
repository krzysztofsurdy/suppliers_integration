<?php

declare(strict_types=1);

namespace Application\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    public function blocked(): Response
    {
        return new JsonResponse('This route is disabled');
    }
}