<?php

namespace Tests\SellerLabs\Research\Responses;

use Mockery;
use SellerLabs\Research\Entities\Offer;
use SellerLabs\Research\Responses\OffersResponse;
use Tests\SellerLabs\Support\MockResponsesTrait;
use Tests\SellerLabs\Support\TestCase;

/**
 * Class OffersResponseTest
 *
 * @author Benjamin Kovach <benjamin@roundsphere.com>
 * @package Tests\SellerLabs\Research
 */
class OffersResponseTest extends TestCase
{
    use MockResponsesTrait;

    /**
     * @expectedException \SellerLabs\Research\Exceptions\InvalidFormatException
     */
    public function testConstructorWithInvalid()
    {
        new OffersResponse($this->makeResponse(
            dirname(__FILE__) . '/Resources/InvalidSearchResponse.json'
        ));
    }

    public function testEverything()
    {
        $offers = new OffersResponse($this->makeResponse(
            dirname(__FILE__) . '/Resources/OffersResponse.json'
        ));

        $results = array_merge(
            $offers->getFbaNewOffers(),
            $offers->getFbaUsedOffers(),
            $offers->getMerchantNewOffers(),
            $offers->getMerchantUsedOffers()
        );

        foreach ($results as $offer) {
            $this->assertInstanceOf(Offer::class, $offer);
        }

        $this->assertEquals('B0097BEE9Q', $offers->getProductIdCode());
        $this->assertEquals('asin', $offers->getProductIdType());
        $this->assertInternalType('array', $offers->getExtras());
        $this->assertEquals(125, $offers->getExtra('newLowest'));
        $this->assertTrue($offers->hasExtra('newLowest'));
        $this->assertFalse($offers->hasExtra('newLowestNope'));
        $this->assertFalse($offers->hasEanIdType());
        $this->assertFalse($offers->hasUpcIdType());
    }
}