<?php

declare(strict_types=1);

namespace Acme;

use Acme\Delivery\DeliveryRuleInterface;
use Acme\Offer\OfferInterface;

/**
 * Represents a shopping basket that can hold products, calculate discounts and delivery costs
 */
class Basket {
    /** @var Product[] $items List of products in the basket */
    private array $items = [];

    /**
     * @param ProductCatalog $catalog Product catalog for looking up products
     * @param array<OfferInterface> $offers List of applicable offers/discounts
     * @param DeliveryRuleInterface $deliveryRule Rule for calculating delivery costs
     */
    public function __construct(
        private ProductCatalog $catalog,
        private array $offers,
        private DeliveryRuleInterface $deliveryRule
    ) {}

    /**
     * Adds a product to the basket by its product code
     *
     * @param string $productCode The unique code identifying the product
     * @return void
     * @throws \InvalidArgumentException If product code doesn't exist in catalog
     */
    public function add(string $productCode): void {
        $this->items[] = $this->catalog->get($productCode);
    }

    /**
     * Returns all products currently in the basket
     *
     * @return Product[]
     */
    public function getItems(): array {
        return $this->items;
    }

    /**
     * Calculates the total cost including discounts and delivery
     *
     * @return float The final total rounded down to 2 decimal places
     */
    public function total(): float {
        $totalDiscounts = 0.0;
        foreach ($this->offers as $offer) {
            $totalDiscounts += $offer->discount($this);
        }

        $subtotal = array_reduce($this->items, fn($carry, Product $p) => $carry + $p->price, 0.0);
        $subtotal -= $totalDiscounts;
        $delivery = $this->deliveryRule->calculate($subtotal);

        return round($subtotal + $delivery, 2, PHP_ROUND_HALF_DOWN);
    }
}