<?php


namespace App\Entity\KeywordScore;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\KeywordScore\KeywordScoreRepository")
 */
class KeywordScore
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $provider;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $term;

    /**
     * @ORM\Column(type="float")
     */
    private $score;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * @param $provider
     * @return $this
     */
    public function setProvider($provider): self
    {
        $this->provider = $provider;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTerm()
    {
        return $this->term;
    }

    /**
     * @param $term
     * @return $this
     */
    public function setTerm($term): self
    {
        $this->term = $term;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @param $score
     * @return $this
     */
    public function setScore($score): self
    {
        $this->score = $score;

        return $this;
    }

}