<?php

/**
 * This controller calculates popularity score for keyword.
 * Accepts keyword from request and calculate popularity in range from 0-10.
 * The result is saved in local database to make future queries for the same words faster.
 * It is possible to change provider, for example instead of GitHub is possible to use Twitter service provider.
 * Returns the result in JSON format that contain two parameters, term and score.
 * @author Ljubisa Ivezic
 * @version 1.0
 */

namespace App\Controller\v1;

use App\Service\Provider\GitHubServiceProvider;
use GuzzleHttp\Exception\GuzzleException;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class KeywordScoreController extends AbstractController
{

    /**
     * @param Request $request
     * @param GitHubServiceProvider $gitHubServiceProvider
     * @return JsonResponse
     * @throws GuzzleException
     * @OA\Response(
     *     response=200,
     *     description="Return score for the keyword in json format"
     * )
     * @OA\Parameter(
     *     name="q",
     *     in="query"
     * )
     */
    public function getScore(Request $request, GitHubServiceProvider $gitHubServiceProvider): JsonResponse
    {

        /** @var array $result */
        $result = $gitHubServiceProvider->getRating($request);
        return new JsonResponse(['data' => $result]);

    }

}