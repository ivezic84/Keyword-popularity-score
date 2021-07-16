<?php


namespace App\Service\Provider;


use App\Service\ProviderInterface;
use Symfony\Component\HttpFoundation\Request;

class TwitterServiceProvider implements ProviderInterface
{

    /**
     * @param Request $request
     * @return array
     */
    public function getRating(Request $request)
    {
        return [
            'data' => [
                'term' => 'test',
                'score' => 123
            ]
        ];
    }
}