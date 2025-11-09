# 🧩 Maatify Bootstrap

> Core bootstrap foundation for all Maatify libraries.

Provides unified environment loading, configuration initialization, error handling, and helper utilities — ensuring consistent startup logic across the entire Maatify ecosystem.

---

## ⚙️ Overview
The **Maatify Bootstrap** package acts as the universal initialization layer for every Maatify project.  
It guarantees predictable and consistent behavior by:
- Loading environment variables from the correct source (`.env.local` → `.env.testing` → `.env`)
- Setting system timezone and application configuration
- Registering PSR-3-compatible error and exception handlers
- Providing helper utilities for environment and path management
- Integrating seamlessly with all Maatify libraries

Used by:
- [`maatify/common`](https://packagist.org/packages/maatify/common)  
- [`maatify/rate-limiter`](https://packagist.org/packages/maatify/rate-limiter)  
- [`maatify/security-guard`](https://packagist.org/packages/maatify/security-guard)  
- [`maatify/data-adapters`](https://packagist.org/packages/maatify/data-adapters)

---

## ✅ Completed Phases
<!-- PHASE_STATUS_START -->
- [x] Phase 1 — Foundation Setup  
- [x] Phase 2 — Bootstrap Core  
- [x] Phase 3 — Helpers & Utilities  
<!-- PHASE_STATUS_END -->

| Phase | Status      | Files Created |
|:------|:------------|:--------------|
| 1     | ✅ Completed | 7             |
| 2     | ✅ Completed | 3             |
| 3     | ✅ Completed | 3             |

---

## 🧠 Quick Start

```bash
composer require maatify/bootstrap
````

```php
use Maatify\Bootstrap\Core\Bootstrap;
use Maatify\Bootstrap\Helpers\EnvHelper;
use Maatify\Bootstrap\Helpers\PathHelper;

require_once __DIR__ . '/vendor/autoload.php';

// Initialize the bootstrap system
Bootstrap::init(__DIR__);

// Optional logger usage
$logger = Bootstrap::logger();
$logger?->info('Bootstrap initialized successfully.');

// Use helpers
echo EnvHelper::get('APP_ENV', 'production');
echo PathHelper::logs();
```

---

## 🧩 Environment Priority

| Order | File           | Purpose                          |
|:------|:---------------|:---------------------------------|
| 1     | `.env.local`   | Local development overrides      |
| 2     | `.env.testing` | Automated testing configuration  |
| 3     | `.env`         | Default production configuration |

---

## ⚙️ Error Handling

The `ErrorHandler` automatically registers global handlers for:

* PHP errors → logged as `error`
* Uncaught exceptions → logged as `critical` and written to `STDERR`

Logging integration uses [`maatify/psr-logger`](https://packagist.org/packages/maatify/psr-logger).

---

## 🧰 Helpers Overview

### `EnvHelper`

Safe and cached access to environment variables.

```php
$debug = EnvHelper::get('APP_DEBUG', false);
```

### `PathHelper`

Builds normalized and cross-platform paths.

```php
$logPath = PathHelper::logs('2025/11/system.log');
```

---

## 🧪 Testing

```bash
vendor/bin/phpunit --testdox
```

Expected output:

```
Maatify Bootstrap Test Suite
 ✔ Env loading priority
 ✔ Init is idempotent
 ✔ EnvHelper returns expected value
 ✔ PathHelper builds consistent paths
```

---

## 🧱 Project Structure

```
maatify-bootstrap/
├── src/
│   ├── Core/
│   │   ├── EnvironmentLoader.php
│   │   ├── Bootstrap.php
│   │   └── ErrorHandler.php
│   └── Helpers/
│       ├── EnvHelper.php
│       └── PathHelper.php
├── tests/
│   ├── EnvironmentLoaderTest.php
│   ├── BootstrapTest.php
│   └── HelpersTest.php
├── docs/phases/
│   ├── README.phase1.md
│   ├── README.phase2.md
│   └── README.phase3.md
├── .env.example
├── composer.json
├── phpunit.xml
└── README.md
```

---

## 📘 License

Released under the **MIT License**.
© 2025 Maatify.dev — All rights reserved.

