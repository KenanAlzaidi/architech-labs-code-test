<?php

declare(strict_types=1);

namespace Acme\Delivery;

/**
 * Interface for delivery cost calculation rules
 */
interface DeliveryRuleInterface {
    /**
     * Calculates the delivery cost based on the order subtotal
     *
     * @param float $subtotal The order subtotal amount
     * @return float The calculated delivery cost
     */
    public function calculate(float $subtotal): float;
}