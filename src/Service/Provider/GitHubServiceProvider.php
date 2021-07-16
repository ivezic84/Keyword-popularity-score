<?php

namespace App\Service\Provider;

use App\Entity\KeywordScore\KeywordScore;
use App\Enum\KeywordType;
use App\Enum\ProviderType;
use App\Service\ProviderInterface;
use App\Traits\ProviderTrait;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class GitHubServiceProvider
 * @package App\Service
 */
class GitHubServiceProvider implements ProviderInterface
{
    use ProviderTrait;

    /** @var EntityManagerInterface $em */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param Request $request
     * @return array
     * @throws GuzzleException
     */
    public function getRating(Request $request): array
    {

        $keyword = $request->get('q');

        /** @var KeywordScore $checkIfExist */
        $checkIfExist = $this->em->getRepository(KeywordScore::class)->findOneBy([
            'term'     => $keyword,
            'provider' => ProviderType::GIT_HUB,
        ]);

        if (!is_null($checkIfExist)) {

            return [
                'term'  => $checkIfExist->getTerm(),
                'score' => $checkIfExist->getScore(),
            ];

        }

        $keywordRocks = $request->get('q') . " " . KeywordType::ROCKS;
        $keywordSucks = $request->get('q') . " " . KeywordType::SUCKS;

        try {

            $client      = new Client();
            $rocksCount  = $this->getGuzzleResponse($client, $_ENV['GITHUB_SEARCH_PATH'], $keywordRocks);
            $sucksCount  = $this->getGuzzleResponse($client, $_ENV['GITHUB_SEARCH_PATH'], $keywordSucks);
            $ratingScore = $this->getRatingScore($rocksCount, $sucksCount);

            /** @var KeywordScore $keywordScore */
            $keywordScore = new KeywordScore();
            $keywordScore->setTerm($keyword)
                ->setScore($ratingScore)
                ->setProvider(ProviderType::GIT_HUB);

            $this->em->persist($keywordScore);
            $this->em->flush();

            return [
                'term'  => $keyword,
                'score' => $ratingScore,
            ];


        } catch (\Exception $exception) {
            return [
                'status'  => 'error',
                'message' => $exception->getMessage(),
            ];
        }

    }

}