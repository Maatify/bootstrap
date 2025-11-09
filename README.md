![Maatify.dev](https://www.maatify.dev/assets/img/img/maatify_logo_white.svg)

---

# 🧩 Maatify Bootstrap  
### Unified Environment Initialization & Diagnostics Layer  
**Project:** `maatify:bootstrap`  
**Author:** [Mohamed Abdulalim (megyptm)](mailto:mohamed@maatify.dev)  
**License:** MIT  
**©2025 Maatify.dev**

---

## ⚙️ Overview

**Maatify Bootstrap** provides a unified, reliable foundation for all Maatify ecosystem libraries.  
It handles environment initialization, timezone configuration, error handling, and Safe Mode logic in a single lightweight package.

This ensures that all Maatify libraries — such as `maatify/common`, `maatify/psr-logger`, and `maatify/redis-cache` — start consistently and securely across development, CI, and production environments.

---

## 🧱 Features

✅ Automatic `.env` loading (with priority order)  
✅ Safe Mode detection for production safety  
✅ Environment integrity validation  
✅ Timezone setup & fallback (`Africa/Cairo` default)  
✅ CI/CD & Docker compatibility  
✅ Fully PSR-compliant logging integration  
✅ Comprehensive PHPUnit coverage  

---

## 🧩 Environment File Priority

| Priority | File           | Purpose                         |
|----------|----------------|---------------------------------|
| 1️⃣      | `.env.local`   | Developer-specific overrides    |
| 2️⃣      | `.env.testing` | CI or testing configuration     |
| 3️⃣      | `.env`         | Standard production environment |
| 4️⃣      | `.env.example` | Safe fallback (always included) |

The system automatically loads the **first available** file in that order.  
Once one file is loaded, it stops checking the rest — avoiding accidental overrides.

---

## 📦 Installation

```bash
composer require maatify/bootstrap
````

For development and testing:

```bash
composer install
composer run-script test
```

---

## 🧠 Usage Example

```php
use Maatify\Bootstrap\Core\Bootstrap;
use Maatify\PsrLogger\LoggerFactory;

// Initialize the bootstrap system
Bootstrap::init();

// Optionally run diagnostics
$logger = LoggerFactory::create('bootstrap');
$diag = new \Maatify\Bootstrap\Core\BootstrapDiagnostics($logger);
print_r($diag->run());
```

---

## 🧪 Testing

Run all PHPUnit tests locally:

```bash
composer run-script test
```

To execute tests inside Docker:

```bash
docker compose up --build
```

---

## 🧰 Project Structure

```
maatify/bootstrap/
├── src/
│   └── Core/
│       ├── Bootstrap.php
│       ├── BootstrapDiagnostics.php
│       └── EnvironmentLoader.php
├── tests/
│   ├── BootstrapTest.php
│   ├── EnvironmentLoaderTest.php
│   ├── DiagnosticsTest.php
│   └── IntegrationTest.php
├── docs/
│   ├── README.phase1.md → Foundations  
│   ├── README.phase5.md → Environment Order  
│   ├── README.phase6.md → CI & Docker Integration  
│   └── README.full.md   → (auto-generated merged documentation)
└── composer.json
```

---

## 🔗 Documentation Phases

| Phase                            | Description                        |
|----------------------------------|------------------------------------|
| [Phase 1](docs/README.phase1.md) | Core Bootstrapping                 |
| [Phase 2](docs/README.phase2.md) | Environment Loader                 |
| [Phase 3](docs/README.phase3.md) | Helpers & Path System              |
| [Phase 4](docs/README.phase4.md) | Integration & Tests                |
| [Phase 5](docs/README.phase5.md) | Environment Priority Logic         |
| [Phase 6](docs/README.phase6.md) | CI/CD & Docker Integration         |
| 🧩 **Next:** Phase 7             | Release Merge & Full Documentation |

---

## 🏁 Coming Next (Phase 7 — Release & Documentation Merge)

* Merge all phase documentation into `README.full.md`
* Add Packagist, PHP version, and CI status badges
* Publish version `v1.0.0` to Packagist
* Enable automated version tagging via CI

---

**©2025 Maatify.dev — All Rights Reserved**
**Project:** `maatify:bootstrap`
**Website:** [https://www.maatify.dev](https://www.maatify.dev)

