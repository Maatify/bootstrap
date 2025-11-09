<?php
/**
 * @copyright   ©2025 Maatify.dev
 * @Library     maatify/bootstrap
 * @Project     maatify:bootstrap
 * @author      Mohamed Abdulalim (megyptm) <mohamed@maatify.dev>
 * @since       2025-11-09 15:31
 * @see         https://www.maatify.dev Maatify.com
 * @link        https://github.com/Maatify/bootstrap  view project on GitHub
 * @note        This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 */

declare(strict_types=1);

namespace Maatify\Bootstrap\Core;

use Dotenv\Dotenv;
use Exception;

/**
 * ⚙️ **Class EnvironmentLoader**
 *
 * 🧩 **Purpose:**
 * Provides a unified, consistent, and secure method for loading environment
 * variables across all **Maatify** projects and libraries.
 * Ensures correct prioritization between `.env` variants, safe immutability,
 * and automatic timezone setup post-load.
 *
 * 🧠 **Priority Loading Order:**
 * 1️⃣ `.env.local` — Local developer overrides
 * 2️⃣ `.env.testing` — Test environment variables
 * 3️⃣ `.env` — Default fallback for production or staging
 * 4️⃣ `.env.example` — Used as a last-resort fallback for validation or defaults
 *
 * ✅ **Key Features:**
 * - Loads the first available file in the priority list.
 * - Prevents overwriting of already defined environment variables (immutable mode).
 * - Automatically applies application timezone via `date_default_timezone_set()`.
 * - Throws clear exception if no `.env` file is found.
 *
 * ⚙️ **Example Usage:**
 * ```php
 * use Maatify\Bootstrap\Core\EnvironmentLoader;
 *
 * // Initialize loader at the project root
 * $env = new EnvironmentLoader(__DIR__ . '/../');
 * $env->load();
 *
 * echo 'Environment: ' . $_ENV['APP_ENV'] ?? 'unknown';
 * ```
 *
 * @package Maatify\Bootstrap\Core
 */
final class EnvironmentLoader
{
    /**
     * 📂 Base directory containing environment files.
     *
     * Typically this is the project root directory.
     *
     * @var string
     */
    public function __construct(private readonly string $basePath)
    {
    }

    /**
     * 🎯 Load the appropriate `.env` file based on Maatify priority rules.
     *
     * The loader iterates over `.env.local`, `.env.testing`, `.env`, and `.env.example`
     * in order, and loads the first existing file it encounters.
     * It uses **immutable mode** to ensure that previously defined environment
     * variables (via system or CI/CD) are not overridden.
     *
     * 🧠 After successful loading, the application timezone is automatically
     * set using the value of `APP_TIMEZONE` or defaults to **Africa/Cairo**.
     *
     * 🚫 Throws:
     * - `Exception` when no environment file is found in the provided base path.
     *
     * @throws Exception If no `.env` file exists in the given directory.
     * @return void
     */
    public function load(): void
    {
        // 🔍 Check environment files in order of precedence
        $envFiles = ['.env.local', '.env.testing', '.env', '.env.example'];
        $loaded   = false;

        foreach ($envFiles as $file) {
            $path = $this->basePath . DIRECTORY_SEPARATOR . $file;

            // ✅ Load the first available file and stop checking further
            if (is_file($path)) {
                // 🧩 Use Dotenv's immutable mode for safety (prevents accidental overrides)
                Dotenv::createImmutable($this->basePath, $file)->load();
                $loaded = true;
                break;
            }
        }

        // 🚫 Throw if no valid environment file was found
        if (! $loaded) {
            throw new Exception('No .env file found in ' . $this->basePath);
        }

        // 🕒 Set timezone from environment or default to Africa/Cairo
        $timezone = $_ENV['APP_TIMEZONE']
                    ?? $_SERVER['APP_TIMEZONE']
                       ?? 'Africa/Cairo';

        date_default_timezone_set($timezone);
    }
}
