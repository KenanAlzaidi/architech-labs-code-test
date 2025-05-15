<?php

declare(strict_types=1);

namespace Acme\Offer;

use Acme\Basket;

/**
 * Interface for implementing promotional offers that can be applied to a shopping basket
 */
interface OfferInterface {
    /**
     * Calculates the promotional offer for the given shopping basket
     * 
     * @param Basket $basket The shopping basket to apply the offer to
     * @return float The total discount amount calculated by the offer
     */
    public function discount(Basket $basket): float;
}