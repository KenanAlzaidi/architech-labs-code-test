# Acme Widget Co - Basket POC

## 🧾 Overview
This is a proof-of-concept basket system for Acme Widget Co. It models:
- A small product catalog
- Tiered delivery rules
- A discount offer (buy-one-get-one-half-price for red widgets)
- Clean object-oriented PHP with testing and autoloading

## 🛠️ Technologies Used
- PHP 8.1
- PHPUnit for testing
- PHPStan for static analysis
- Composer for dependency management

## 📦 Project Structure
```
project-root/
├── composer.json
├── src/
│   ├── Basket.php
│   ├── Product.php
│   ├── ProductCatalog.php
│   ├── Delivery/
│   │   ├── DeliveryRuleInterface.php
│   │   └── TieredDeliveryRule.php
│   ├── Offer/
│       ├── OfferInterface.php
│       └── BuyOneGetOneHalfPrice.php
├── tests/
│   └── BasketTest.php
```

## 🚀 Getting Started

### Install dependencies:
```bash
composer install
composer dump-autoload
```

### Run tests:
```bash
composer run test tests
```

## 🔧 Assumptions
- Product catalog holds an array of Product objects indexed by their product codes for faster lookup as a repository.
- No frontend or HTTP interface is needed; only CLI and unit tests.
- Offers are applied as strategy objects, respecting OCP and SRP.
- Delivery rules can be changed easily via dependency injection.
- Totals are rounded to 2 decimal places.

## 🧪 Example Test Cases
| Basket Items                   | Expected Total |
|--------------------------------|----------------|
| `B01, G01`                     | `$37.85`       |
| `R01, R01`                     | `$54.37`       |
| `R01, G01`                     | `$60.85`       |
| `B01, B01, R01, R01, R01`      | `$98.27`       |

---
