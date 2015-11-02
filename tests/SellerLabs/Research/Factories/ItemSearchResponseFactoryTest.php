<?php

namespace Tests\SellerLabs\Research\Factories;

use SellerLabs\Research\Factories\ItemSearchResponseFactory;

class ItemSearchResponseFactoryTest extends ResponseFactoryTestCase
{
    public function testConstruct()
    {
        (new itemSearchResponseFactory())
            ->makeFromResponse(
                $this->makeResponseRelative(
                    '../Responses/Resources/ItemSearchResponse.json'
                )
            );
    }
}