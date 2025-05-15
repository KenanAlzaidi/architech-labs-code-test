<?php

declare(strict_types=1);

namespace Acme\Delivery;

/**
 * Implements tiered delivery pricing rules based on order subtotal
 */
class TieredDeliveryRule implements DeliveryRuleInterface {
    /**
     * Calculates the delivery cost based on the order subtotal
     *
     * @param float $subtotal The order subtotal amount
     * @return float The calculated delivery cost
     */
    public function calculate(float $subtotal): float {
        return match (true) {
            $subtotal >= 90 => 0,
            $subtotal >= 50 && $subtotal < 90 => 2.95,
            default => 4.95,
        };
    }
}