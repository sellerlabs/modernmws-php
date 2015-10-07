<?php

namespace SellerLabs\Research\Interfaces;

use SellerLabs\Research\Responses\FeesResponse;
use SellerLabs\Research\Responses\SearchResponse;

/**
 * Interface ResearchClientInterface
 *
 * Represents an object capable of querying SellerLabs' Research API
 *
 * @author Eduardo Trujillo <ed@chromabits.com>
 * @author Benjamin Kovach <benjamin@roundsphere.com>
 * @package SellerLabs\Research\Interfaces
 */
interface ResearchClientInterface
{
    /**
     * Generate an authorization code for NodeMWS
     *
     * @param null|int $timestamp
     *
     * @return string
     */
    public function generateCode($timestamp = null);

    /**
     * Get the current offers for an ASIN from NodeMWS
     *
     * @param string $asin
     * @param bool $noPaapi
     *
     * @return \SellerLabs\Research\Responses\OffersResponse
     */
    public function getOffers($asin, $noPaapi = false);

    /**
     * Call the fees endpoint of NodeMWS and return the response
     *
     * @param $asin
     * @param $price
     *
     * @return FeesResponse
     */
    public function getFees($asin, $price);

    /**
     * Search the catalog and return the response
     *
     * @param $idType
     * @param $idCode
     *
     * @return SearchResponse
     */
    public function getSearch($idType, $idCode);

    /**
     * Get categories for an ASIN
     *
     * @param $asin
     *
     * @return \SellerLabs\Research\Responses\GetAsinCategoriesResponse
     */
    public function getAsinCategories($asin);

    /**
     * Get a category by ID
     *
     * @param $categoryId
     *
     * @return \SellerLabs\Research\Responses\GetCategoryByIdResponse
     */
    public function getCategoryById($categoryId);
}
