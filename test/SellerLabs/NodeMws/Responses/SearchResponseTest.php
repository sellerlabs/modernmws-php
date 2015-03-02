<?php

use SellerLabs\NodeMws\Responses\SearchResponse;

class SearchResponseTest extends \PHPUnit_Framework_TestCase
{
    protected $searchResponse;
    protected $responseInterfaceMock;

    public function setUp()
    {
        $responseInterfaceMock = Mockery::mock('GuzzleHttp\Message\ResponseInterface');

        $this->searchResponse = file_get_contents(dirname(__FILE__) . '/Resources/SearchResponse.json');

        $responseInterfaceMock->
        shouldReceive('getBody')
            ->andReturn($this->searchResponse);

        $this->responseInterfaceMock = $responseInterfaceMock;
    }

    public function tearDown()
    {
        Mockery::close();
    }

    public function testConstruct()
    {
        $search = new SearchResponse($this->responseInterfaceMock);

        $this->assertFalse($search->isEmpty());

        foreach($search->getSearchProducts() as $product) {
            $this->assertInstanceOf('\SellerLabs\NodeMws\Entities\SearchProduct', $product);
        }

        $this->assertInstanceOf('\SellerLabs\NodeMws\Entities\SearchProduct', $search->first());
    }
}