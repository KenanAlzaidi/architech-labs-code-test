<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Acme\{Basket, Product, ProductCatalog};
use Acme\Offer\BuyOneGetOneHalfPrice;
use Acme\Delivery\TieredDeliveryRule;

/**
 * Test case for the Basket class functionality
 */
class BasketTest extends TestCase {
    /**
     * Creates a new Basket instance with predefined catalog and rules
     *
     * @return Basket A basket initialized with a product catalog, BOGOHP offer and tiered delivery rules
     */
    private function createBasket(): Basket {
        //The same data provided within the assessment file
        $catalog = new ProductCatalog([
            'R01' => new Product('R01', 'Red Widget', 32.95),
            'G01' => new Product('G01', 'Green Widget', 24.95),
            'B01' => new Product('B01', 'Blue Widget', 7.95),
        ]);

        return new Basket(
            $catalog,
            [new BuyOneGetOneHalfPrice()],
            new TieredDeliveryRule()
        );
    }

    /**
     * Tests various basket total calculations with different product combinations
     *
     * Test cases:
     * 1. Blue Widget + Green Widget
     * 2. Two Red Widgets (with BOGOHP offer)
     * 3. Red Widget + Green Widget
     * 4. Two Blue Widgets + Three Red Widgets
     *
     */
    public function testBasketTotals(): void {
        $basket = $this->createBasket();
        $basket->add('B01');
        $basket->add('G01');
        $this->assertEquals(37.85, $basket->total());

        $basket = $this->createBasket();
        $basket->add('R01');
        $basket->add('R01');
        $this->assertEquals(54.37, $basket->total());

        $basket = $this->createBasket();
        $basket->add('R01');
        $basket->add('G01');
        $this->assertEquals(60.85, $basket->total());

        $basket = $this->createBasket();
        $basket->add('B01');
        $basket->add('B01');
        $basket->add('R01');
        $basket->add('R01');
        $basket->add('R01');
        $this->assertEquals(98.27, $basket->total());
    }
    
    /**
     * Tests that an InvalidArgumentException is thrown when adding a non-existent product
     */
    public function testInvalidArgumentExceptionWhenAddingNonExistentProduct(): void {
        $basket = $this->createBasket();
        $this->expectException(\InvalidArgumentException::class);
        $basket->add('XYZ'); // Product code does not exist in the catalog
    }
}