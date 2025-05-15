<?php

declare(strict_types=1);

namespace Acme;

/**
 * Represents a product in the Acme Widget Co system.
 *
 * This is the core data model for managing individual product entities.
 */
class Product {
    public function __construct(
        public string $code,
        public string $name,
        public float $price
    ) {}
}