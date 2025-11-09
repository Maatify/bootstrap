# ⚙️ Maatify Bootstrap  
### Unified Environment Initialization & Startup Foundation

**Version:** 1.0.0  
**Owner:** [Maatify.dev](https://www.maatify.dev)  
**License:** MIT (see repository LICENSE)  

---

## 🧭 Overview
`maatify/bootstrap` provides a consistent and safe initialization layer for all Maatify libraries and applications.  
It standardizes environment loading, timezone setup, diagnostics, and startup integrity checks — ensuring predictable and secure application bootstrapping across development, testing, and production environments.

---

## ✅ Completed Phases

| Phase | Title                   | Status      |
|-------|-------------------------|-------------|
| 1     | Foundation Setup        | ✅ Completed |
| 2     | Bootstrap Core          | ✅ Completed |
| 3     | Helpers & Utilities     | ✅ Completed |
| 4     | Integration Layer       | ✅ Completed |
| 5     | Diagnostics & Safe Mode | ✅ Completed |

---

## 🧱 Phase 1 — Foundation Setup

### 🎯 Goal
Initialize the core bootstrap structure, namespaces, and environment loader foundation.

### ⚙️ Implemented Features
- PSR-4 autoload configuration  
- `EnvironmentLoader` class for unified `.env` file handling  
- `.env.example` template  
- PHPUnit configuration for base environment testing  

### 🧠 Usage Example
```php
use Maatify\Bootstrap\Core\EnvironmentLoader;

$env = new EnvironmentLoader(__DIR__);
$env->load();
````

### ✅ Verification

* `.env.local` and `.env.testing` supported
* Defaults timezone to `Africa/Cairo` if not set
* PHPUnit passes all base loader tests

---

## 🧱 Phase 2 — Bootstrap Core

### 🎯 Goal

Implement main `Bootstrap` entry point integrating environment loader, timezone setup, and error handler registration.

### ⚙️ Implemented Features

* Added `Bootstrap` class with `init()` static entry
* Integrated `EnvironmentLoader` and custom error handler
* Ensured idempotency to prevent double initialization
* Set timezone dynamically from environment

### 🧠 Usage Example

```php
use Maatify\Bootstrap\Core\Bootstrap;

Bootstrap::init();
```

### ✅ Verification

* Multiple calls to `init()` cause no side effects
* Logs error handler initialization success

---

## 🧱 Phase 3 — Helpers & Utilities

### 🎯 Goal

Introduce helper utilities for cross-library bootstrap consistency.

### ⚙️ Implemented Features

* `PathHelper`: ensures consistent project-relative paths
* `EnvHelper`: unified, cached access to environment variables
* Integration with `maatify/common` for safe path operations

### 🧠 Usage Example

```php
use Maatify\Bootstrap\Helpers\EnvHelper;
use Maatify\Bootstrap\Helpers\PathHelper;

$timezone = EnvHelper::get('APP_TIMEZONE', 'Africa/Cairo');
$basePath = PathHelper::base();
```

### ✅ Verification

* `EnvHelper` uses cache with runtime override support
* `PathHelper` resolves consistent directories in CI and local

---

## 🧱 Phase 4 — Integration Layer

### 🎯 Goal

Ensure compatibility across all Maatify libraries, such as:

* `maatify/data-adapters`
* `maatify/rate-limiter`
* `maatify/security-guard`

### ⚙️ Implemented Features

* Confirmed shared environment initialization
* Verified that environment loads once per runtime
* Added CI integration test for multi-library boot order

### 🧠 Example

```php
// In maatify/data-adapters
\Maatify\Bootstrap\Core\Bootstrap::init();
```

### ✅ Verification

* Integration tests across libraries successful
* No reinitialization or conflicts detected

---

## 🧱 Phase 5 — Diagnostics & Safe Mode

### 🎯 Goal

Add runtime diagnostics and safe initialization fallbacks for production environments.

### ⚙️ Implemented Features

* `BootstrapDiagnostics` with `checkEnv()`, `checkTimezone()`, `checkErrors()`, `isSafeMode()`
* Safe Mode auto-enables if `.env.local` or `.env.testing` exists in production
* `.env.example` used as fallback
* PSR-3 logging for audit trails

### 🧠 Usage Example

```php
use Maatify\Bootstrap\Core\BootstrapDiagnostics;
use Maatify\PsrLogger\LoggerFactory;

$logger = LoggerFactory::create('bootstrap');
$diag = new BootstrapDiagnostics($logger);

$results = $diag->run();
print_r($results);

$diag->activateSafeMode();
```

### ✅ Testing

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

## 🧩 Environment Loading Priority — Full Explanation

### 🔍 Load Order

```php
$envFiles = ['.env.local', '.env.testing', '.env', '.env.example'];
```

The loader checks in this strict order and **stops immediately** after finding the first existing file.
Only one `.env*` file is ever loaded per execution.

### 🧠 Behavior per Environment

| Environment       | Files Present             | Loaded File                        | Reason                                   |
|-------------------|---------------------------|------------------------------------|------------------------------------------|
| Local Development | `.env.local`              | ✅ `.env.local`                     | Highest priority for developer overrides |
| Testing / CI      | `.env.testing` or none    | ✅ `.env.testing` or `.env.example` | Prevents CI from using production data   |
| Production        | `.env` and `.env.example` | ✅ `.env`                           | Official production environment          |
| Fresh Install     | only `.env.example`       | ✅ `.env.example`                   | Fallback for first-time setup            |

### ⚙️ Why This Order

| Priority | File           | Purpose              | Safe to Commit? |
|----------|----------------|----------------------|-----------------|
| 🥇 1     | `.env.local`   | Developer overrides  | ❌ Private       |
| 🥈 2     | `.env.testing` | CI / PHPUnit configs | ✅               |
| 🥉 3     | `.env`         | Production config    | ✅               |
| 🏁 4     | `.env.example` | Template fallback    | ✅               |

**Immutable Load Mode**

> `Dotenv::createImmutable()` prevents overwriting any existing variables.
> Even if `.env.example` is present in production, it cannot override `.env`.

---

## 🧾 Summary

Phase 5 marks completion of the foundational bootstrap lifecycle for all Maatify libraries.

* ✅ Predictable startup
* ✅ Safe and idempotent initialization
* ✅ Automatic diagnostics and Safe Mode
* ✅ Cross-library readiness for CI/CD

This package now provides the **entry point for all Maatify ecosystem packages** (data-adapters, rate-limiter, security-guard, etc.).

---

## 📦 Next Phase (6)

**Advanced Integration & Release**

* Add GitHub Actions workflow for CI/CD
* Add Dockerfile + docker-compose for local bootstrap testing
* Auto-generate `CHANGELOG.md` and `VERSION`
* Prepare release for Packagist publication
* Build Docs validator workflow (`.github/workflows/docs.yml`)

---

**© 2025 Maatify.dev — Unified Development Ecosystem**


---
