# 🧩 Maatify Bootstrap

> Core bootstrap foundation for all Maatify libraries.

Provides environment loading, configuration initialization, and consistent startup logic for the Maatify ecosystem.

---

## ⚙️ Overview
The **Maatify Bootstrap** package establishes the base layer for initializing every Maatify project.  
It standardizes how environment variables, timezones, and core paths are loaded across
libraries like:

- [`maatify/common`](https://packagist.org/packages/maatify/common)  
- [`maatify/rate-limiter`](https://packagist.org/packages/maatify/rate-limiter)  
- [`maatify/security-guard`](https://packagist.org/packages/maatify/security-guard)

---

## ✅ Completed Phases
<!-- PHASE_STATUS_START -->
- [x] Phase 1 — Foundation Setup
<!-- PHASE_STATUS_END -->

| Phase | Status      | Files Created |
|:------|:------------|:--------------|
| 1     | ✅ Completed | 7             |

---

## 🧠 Quick Start

```bash
composer require maatify/bootstrap
````

```php
use Maatify\Bootstrap\Core\EnvironmentLoader;

require_once __DIR__ . '/vendor/autoload.php';

$env = new EnvironmentLoader(__DIR__);
$env->load();
```

---

## 🧩 Environment Priority

| Order | File           | Purpose                          |
|:------|:---------------|:---------------------------------|
| 1     | `.env.local`   | Local development overrides      |
| 2     | `.env.testing` | Automated testing environment    |
| 3     | `.env`         | Default production configuration |

---

## 🧾 Testing

```bash
vendor/bin/phpunit --testdox
```

Expected output:

```
Maatify Bootstrap Test Suite
 ✔ Environment loading priority
```

---

## 🧱 Project Structure

```
maatify-bootstrap/
├── src/Core/EnvironmentLoader.php
├── tests/EnvironmentLoaderTest.php
├── .env.example
├── composer.json
├── phpunit.xml
└── docs/phases/README.phase1.md
```

---

## 📘 License

Released under the **MIT License**.
© 2025 Maatify.dev — All rights reserved.

---
