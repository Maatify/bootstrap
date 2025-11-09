![Maatify.dev](https://www.maatify.dev/assets/img/img/maatify_logo_white.svg)

---

# ⚙️ Maatify Bootstrap

[![Packagist Version](https://img.shields.io/packagist/v/maatify/bootstrap.svg?label=Version&color=4C1)](https://packagist.org/packages/maatify/bootstrap)
[![PHP Version Support](https://img.shields.io/packagist/php-v/maatify/bootstrap.svg?label=PHP)](https://packagist.org/packages/maatify/bootstrap)
[![Build Status](https://github.com/Maatify/bootstrap/actions/workflows/tests.yml/badge.svg)](https://github.com/Maatify/bootstrap/actions/workflows/tests.yml)
[![Monthly Downloads](https://img.shields.io/packagist/dm/maatify/bootstrap.svg?label=Downloads)](https://packagist.org/packages/maatify/bootstrap)
[![License](https://img.shields.io/github/license/Maatify/bootstrap.svg?label=License)](LICENSE)

---

### Unified Environment Initialization & Diagnostics Layer  
**Project:** `maatify:bootstrap`  
**Version:** 1.0.0  
**License:** MIT  
**Author:** [Mohamed Abdulalim (megyptm)](mailto:mohamed@maatify.dev)  
**© 2025 Maatify.dev**

> 🔗 [بالعربي](./README-AR.md)

---

## 🧭 Overview

`maatify/bootstrap` is the **core foundation** for the entire Maatify ecosystem —  
providing standardized environment initialization, diagnostics, timezone setup, and safe startup checks  
for every Maatify PHP library and application.

It ensures consistent, predictable, and secure runtime behavior across:
- Local development  
- CI/CD pipelines  
- Staging and production environments  

---

## ⚙️ Installation

```bash
composer require maatify/bootstrap
````

---

## 📦 Dependencies

This library relies on:

| Dependency           | Purpose                                           | Link                                                               |
|----------------------|---------------------------------------------------|--------------------------------------------------------------------|
| **vlucas/phpdotenv** | Secure `.env` file loader and environment manager | [github.com/vlucas/phpdotenv](https://github.com/vlucas/phpdotenv) |
| **psr/log**          | PSR-3 compatible logging interface                | [www.php-fig.org/psr/psr-3](https://www.php-fig.org/psr/psr-3/)    |
| **phpunit/phpunit**  | Unit testing framework (development only)         | [phpunit.de](https://phpunit.de)                                   |

> `maatify/bootstrap` builds upon these open-source libraries to provide a unified and secure initialization layer
> across the entire Maatify ecosystem.

---

## 🧩 Features

* 🔐 Unified `.env` file loader with priority-based detection
* 🌍 Timezone configuration (`APP_TIMEZONE` → default `Africa/Cairo`)
* 🧠 Smart environment caching via `EnvHelper`
* 🧱 Cross-library bootstrap via `Bootstrap::init()`
* 🚦 Safe Mode activation for production protection
* 🧪 Full PHPUnit test coverage with CI integration
* 🐳 Docker & GitHub Actions ready

---

## 🧠 Environment Loading Priority

`maatify/bootstrap` loads only one `.env` file per execution — based on strict precedence:

| Priority | File           | Purpose                            |
|----------|----------------|------------------------------------|
| 1️⃣      | `.env.local`   | Developer/private overrides        |
| 2️⃣      | `.env.testing` | CI or PHPUnit configuration        |
| 3️⃣      | `.env`         | Main production configuration      |
| 4️⃣      | `.env.example` | Always-available fallback template |

> Once a file is found, loading **stops immediately** — ensuring lower-priority files cannot override higher ones.
> Uses `Dotenv::createImmutable()` (from **vlucas/phpdotenv**) for safety, preventing accidental overwrites.

---

## 🧠 Usage Example

```php
use Maatify\Bootstrap\Core\Bootstrap;

Bootstrap::init();

// Access loaded variables
$env = $_ENV['APP_ENV'] ?? 'production';
echo "Running in environment: $env";
```

or for diagnostic mode:

```php
use Maatify\Bootstrap\Core\BootstrapDiagnostics;
use Maatify\PsrLogger\LoggerFactory;

$logger = LoggerFactory::create('bootstrap');
$diag = new BootstrapDiagnostics($logger);

print_r($diag->run());
```

---

## 🧰 Docker Integration

For consistent environment parity between local and CI:

```bash
docker compose up --build
docker compose exec bootstrap composer run-script test
```

---

## 🧪 Testing

Run tests locally:

```bash
composer run-script test
```

CI is automatically triggered via GitHub Actions:

```
.github/workflows/tests.yml
```

---

## 📄 Documentation

Full technical documentation covering all phases (1 → 7):
👉 [**docs/README.full.md**](./docs/README.full.md)

---

**Maatify Bootstrap** — *“Initialize once, stabilize everywhere.”*

---

## 🪪 License

**[MIT license](LICENSE)** © [Maatify.dev](https://www.maatify.dev)
You’re free to use, modify, and distribute this library with attribution.

---

## 📚 Built Upon

`maatify/bootstrap` is proudly built upon and extends several foundational open-source projects:

| Library                                                     | Description                             | Usage in Project                                                                                |
|-------------------------------------------------------------|-----------------------------------------|-------------------------------------------------------------------------------------------------|
| **[vlucas/phpdotenv](https://github.com/vlucas/phpdotenv)** | Industry-standard `.env` loader for PHP | Provides immutable and secure environment loading across all Maatify projects.                  |
| **[psr/log](https://www.php-fig.org/psr/psr-3/)**           | PHP-FIG PSR-3 logging interface         | Enables standardized, interchangeable logging (used by `BootstrapDiagnostics` and PSR loggers). |
| **[phpunit/phpunit](https://phpunit.de)**                   | PHP unit testing framework              | Powers the complete automated test suite with CI/CD integration.                                |

> Special thanks to the maintainers of these open-source libraries
> for providing the stable foundations that make this project possible. ❤️

---

## 🧱 Authors & Credits

**Developed by:** [**Maatify.dev**](https://www.maatify.dev)  
**Maintainer:** Mohamed Abdulalim  
**Project:** `maatify:bootstrap`

---
