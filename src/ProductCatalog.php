<?php

declare(strict_types=1);

namespace Acme;

/**
 * ProductCatalog acts as a repository for Product entities.
 *
 * It provides centralized, read-only access to a predefined collection of products,
 * allowing lookup by product code.
 *
 * @phpstan-type ProductMap array<string, Product>
 */
class ProductCatalog
{
    /**
     * @var Product[] Indexed by product code for quick lookup.
     * @phpstan-var ProductMap
     */
    private array $products;

    /**
     * @param array<string, Product> $products
     */
    public function __construct(array $products)
    {
        $this->products = $products;
    }

    /**
     * Retrieves a product by its code.
     *
     * @param string $code The product code to look up.
     * @return Product The product with the given code.
     * @throws \InvalidArgumentException If the product code does not exist in the catalog.
     */
    public function get(string $code): Product
    {
        return $this->products[$code] ?? throw new \InvalidArgumentException("Invalid product code");
    }
}
