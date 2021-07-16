<?php

use Behat\Behat\Context\Context;
use Symfony\Component\HttpClient\HttpClient;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{

    protected $response;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }


    /**
     * @When I request a score from :arg1
     * @param $arg1
     * @return bool
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     * @throws Exception
     */
    public function iRequestAScoreFrom($arg1)
    {

        $httpClient     = HttpClient::create();
        $this->response = $httpClient->request("GET", $arg1);

        $responseCode = $this->response->getStatusCode();

        if ($responseCode != 200) {
            throw new Exception("Expected a 200, but received " . $responseCode);
        }

        return true;

    }


    /**
     * @Then The results should include a score
     * @return mixed
     */
    public function theResultsShouldIncludeAScore()
    {

        $response = json_decode($this->response->getContent(), true);

        return $response['data']['score'];

    }

}
