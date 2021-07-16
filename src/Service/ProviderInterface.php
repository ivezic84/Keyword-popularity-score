<?php


namespace App\Service;


use Symfony\Component\HttpFoundation\Request;

interface ProviderInterface
{
    public function getRating(Request $request);

}