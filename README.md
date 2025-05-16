# Acme Widget Co - Basket POC

## 🧾 Overview
This is a proof-of-concept basket system for Acme Widget Co. It models:
- Product as the core data unit, encapsulated in a `Product` class.
- A `ProductCatalog` class acting as a repository for available products.
- Tiered delivery rules interface implemented using the Strategy pattern.
- A promotional offer (Buy-One-Get-One-Half-Price for red widgets) interface, also using the Strategy pattern.
- A `Basket` class that adds products, applies offers and delivery rules, and calculates the total
- Clean, testable, object-oriented PHP with Composer autoloading, PHPUnit testing and PHPStan for static analysis.
- Clear documentation using PHPDoc, fully compatible with PHPStan.

## 🛠️ Technologies and Architecture
- PHP 8.1
- PHPUnit for testing
- PHPStan for static analysis
- PHPDoc for code documentation
- Composer for dependency management and autoloading
- Git for version control
- OOP Design Patterns (Strategy, Repository, DI)
- PSR-4 Autoloading standard

## 📦 Project Structure
```
project-root/
├── src/
│   ├── Delivery/
│   │   ├── DeliveryRuleInterface.php
│   │   └── TieredDeliveryRule.php
│   ├── Offer/
│   │   ├── OfferInterface.php
│   │   └── BuyOneGetOneHalfPrice.php
│   ├── Basket.php
│   ├── Product.php
│   ├── ProductCatalog.php
├── tests/
│   └── BasketTest.php
├── .gitignore
├── composer.json
├── composer.lock
├── LICENSE
├── phpstan.neon
└── README.md

```

## 🚀 Getting Started

### Install dependencies:
```bash
composer install
composer dump-autoload
```

### Run tests:
```bash
composer run test
```

## 🔧 Assumptions
- This project is a general-purpose PHP proof of concept, not a client-server or web-based application.
- There is no HTTP layer, no request-response cycle, and no user interaction or input handling.
- The system is entirely in-memory, with no database or external storage.
- Products are represented as `Product` objects, and managed through a `ProductCatalog` class following the Repository pattern.
- Delivery and discount logic are decoupled using the Strategy pattern, allowing for extensibility.
- The system is exercised through unit tests (use cases), which serve as the sole execution mechanism.
- No CLI, UI, or external interfaces are included — the focus is strictly on architecture, logic, and correctness.
- No integration with third-party services or external APIs; all logic is self-contained.
- No `.env` file is needed as there are no configuration or environment-specific variables.
- Totals are rounded down to 2 decimal places.

## 🧪 Example Test Cases
| Basket Items                   | Expected Total |
|--------------------------------|----------------|
| `B01, G01`                     | `$37.85`       |
| `R01, R01`                     | `$54.37`       |
| `R01, G01`                     | `$60.85`       |
| `B01, B01, R01, R01, R01`      | `$98.27`       |
