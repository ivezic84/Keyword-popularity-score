<?php


namespace App\Repository\KeywordScore;


use App\Entity\KeywordScore\KeywordScore;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class KeywordScoreRepository extends ServiceEntityRepository
{
    /**
     * KeywordRatingScore constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, KeywordScore::class);
    }

}