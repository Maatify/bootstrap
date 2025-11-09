# 🧩 Maatify Bootstrap

> Core bootstrap foundation for all Maatify libraries.

Provides unified environment loading, configuration initialization, error handling, and consistent startup logic for the entire Maatify ecosystem.

---

## ⚙️ Overview
The **Maatify Bootstrap** package acts as the universal entry layer for initializing every Maatify project.  
It guarantees predictable startup behavior by:
- Loading the correct `.env` file (local → testing → production)
- Setting system time zone and core configuration
- Registering PSR-3-compatible error/exception handlers
- Providing a global logger access point

Used by:
- [`maatify/common`](https://packagist.org/packages/maatify/common)  
- [`maatify/rate-limiter`](https://packagist.org/packages/maatify/rate-limiter)  
- [`maatify/security-guard`](https://packagist.org/packages/maatify/security-guard)

---

## ✅ Completed Phases
<!-- PHASE_STATUS_START -->
- [x] Phase 1 — Foundation Setup  
- [x] Phase 2 — Bootstrap Core  
<!-- PHASE_STATUS_END -->


| Phase | Status      | Files Created |
|:------|:------------|:--------------|
| 1     | ✅ Completed | 7             |
| 2     | ✅ Completed | 3             |

---

## 🧠 Quick Start

```bash
composer require maatify/bootstrap
````

```php
use Maatify\Bootstrap\Core\Bootstrap;

require_once __DIR__ . '/vendor/autoload.php';

// Initialize the system
Bootstrap::init(__DIR__);

// Optional logger usage
$logger = Bootstrap::logger();
$logger?->info('Bootstrap initialized successfully.');
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
* Uncaught exceptions → logged as `critical` and echoed to STDERR

Logger integration uses [`maatify/psr-logger`](https://packagist.org/packages/maatify/psr-logger).

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
```

---

## 🧱 Project Structure

```
maatify-bootstrap/
├── src/Core/
│   ├── EnvironmentLoader.php
│   ├── Bootstrap.php
│   └── ErrorHandler.php
├── tests/
│   ├── EnvironmentLoaderTest.php
│   └── BootstrapTest.php
├── docs/phases/
│   ├── README.phase1.md
│   └── README.phase2.md
├── .env.example
├── composer.json
├── phpunit.xml
└── README.md
```

---

## 📘 License

Released under the **MIT License**.

© 2025 Maatify.dev — All rights reserved.

