![**Maatify.dev**](https://www.maatify.dev/assets/img/img/maatify_logo_white.svg)
---

# ⚙️ Maatify Bootstrap  
### Unified Environment Initialization & Startup Foundation

[![Current Version](https://img.shields.io/badge/version-1.0.0-blue.svg)](https://packagist.org/packages/maatify/bootstrap)
[![PHP Version](https://img.shields.io/packagist/php-v/maatify/bootstrap)](https://packagist.org/packages/maatify/bootstrap)
[![License](https://img.shields.io/github/license/Maatify/bootstrap)](LICENSE)
[![Build Status](https://github.com/Maatify/bootstrap/actions/workflows/tests.yml/badge.svg)](https://github.com/Maatify/bootstrap/actions)

---

## 🧭 Overview
`maatify/bootstrap` provides a unified initialization system for all Maatify libraries and applications.  
It ensures consistent environment loading, timezone setup, diagnostics, and Safe Mode activation across **development**, **testing**, and **production** environments.

---

## ✅ Completed Phases
<!-- PHASE_STATUS_START -->
- [x] Phase 1 — Foundation Setup  
- [x] Phase 2 — Bootstrap Core  
- [x] Phase 3 — Helpers & Utilities  
- [x] Phase 4 — Integration Layer  
- [x] Phase 5 — Diagnostics & Safe Mode  
<!-- PHASE_STATUS_END -->

---

## 🧩 Installation
```bash
composer require maatify/bootstrap
````

---

## ⚙️ Quick Start

```php
use Maatify\Bootstrap\Core\Bootstrap;

Bootstrap::init();
```

This call:

1. Loads environment variables from the first available `.env*` file
2. Sets PHP timezone based on `APP_TIMEZONE` (defaults to `Africa/Cairo`)
3. Registers global error handling
4. Ensures idempotent initialization

---

## 🧠 Environment Loading Priority

Your environment loader checks files in this strict order:

```php
$envFiles = ['.env.local', '.env.testing', '.env', '.env.example'];
```

The loader stops once the first file is found — ensuring **only one** environment is active per run.

| Priority | File           | Purpose                                        | Safe to Commit? |
| -------- | -------------- | ---------------------------------------------- | --------------- |
| 🥇 1     | `.env.local`   | Developer overrides (private configs)          | ❌               |
| 🥈 2     | `.env.testing` | CI / PHPUnit / integration tests               | ✅               |
| 🥉 3     | `.env`         | Shared production configuration                | ✅               |
| 🏁 4     | `.env.example` | Fallback / template for first-run environments | ✅               |

> **Immutable Mode:**
> The loader uses `Dotenv::createImmutable()`, ensuring later files cannot override existing variables.
> Even if `.env.example` exists in production, it cannot override `.env`.

---

## 🧪 Testing

Run all automated tests:

```bash
composer run-script test
```

Expected output:

```
Maatify Bootstrap Test Suite
 ✔ Init is idempotent
 ✔ Diagnostics return expected structure
 ✔ Safe mode detection
 ✔ Env loading priority
 ✔ Env helper returns expected value
 ✔ Path helper builds consistent paths
 ✔ Integration across libraries
```

---

## 📁 Core Components

| Component              | Description                                                  |
| ---------------------- | ------------------------------------------------------------ |
| `EnvironmentLoader`    | Loads the appropriate `.env` file with strict priority order |
| `Bootstrap`            | Central initialization entry point                           |
| `BootstrapDiagnostics` | Runs environment and runtime health checks                   |
| `EnvHelper`            | Cached access to environment variables                       |
| `PathHelper`           | Unified base path resolver                                   |

---

## 🧩 Example: Runtime Diagnostics

```php
use Maatify\Bootstrap\Core\BootstrapDiagnostics;
use Maatify\PsrLogger\LoggerFactory;

$logger = LoggerFactory::create('bootstrap');
$diag = new BootstrapDiagnostics($logger);

$results = $diag->run();
print_r($results);

$diag->activateSafeMode(); // activates Safe Mode if unsafe .env detected
```

---

## 🧾 Roadmap

Next phase (6): **Advanced Integration & Release**

* [ ] Add GitHub Actions CI workflow
* [ ] Add Dockerfile + docker-compose for local bootstrap testing
* [ ] Generate `CHANGELOG.md` and `VERSION`
* [ ] Tag `v1.0.0` and publish to Packagist

---

**© 2025 [Maatify.dev](https://www.maatify.dev) — Unified Development Ecosystem**



