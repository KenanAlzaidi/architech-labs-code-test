<?php

declare(strict_types=1);

namespace Acme\Offer;

use Acme\Basket;

/**
 * Implements a "Buy One Get One Half Price" offer for red widgets (R01).
 * For every pair of red widgets in the basket, applies a 50% discount on one widget.
 */
class BuyOneGetOneHalfPrice implements OfferInterface {
    /**
     * Calculates the "Buy One Get One Half Price" discount for the basket
     * 
     * @param Basket $basket The shopping basket to apply the offer to
     * @return float The total discount amount for red widgets
     */
    public function discount(Basket $basket): float {
        $redWidgets = array_values(array_filter($basket->getItems(), fn($p) => $p->code === 'R01'));
        $count = count($redWidgets);
        $discountedItems = intdiv($count, 2);
        $totalDiscount = 0.0;
        for ($i = 0; $i < $discountedItems; $i++) {
            $totalDiscount += $redWidgets[0]->price / 2;
        }
        return $totalDiscount;
    }
}