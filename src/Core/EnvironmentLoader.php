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
 * ⚙️ Class EnvironmentLoader
 *
 * 🧩 Purpose:
 * Loads environment variables in a consistent, safe, and predictable way
 * across all Maatify libraries and applications.
 *
 * 🧠 Priority Loading Order:
 * 1️⃣ `.env.local` — Highest priority (local overrides)
 * 2️⃣ `.env.testing` — For test environments
 * 3️⃣ `.env` — Default fallback
 *
 * ✅ Features:
 * - Automatically selects and loads the first available file.
 * - Applies immutable variables to avoid accidental overrides.
 * - Sets the application timezone automatically if defined.
 * - Ensures unified environment handling across all Maatify projects.
 *
 * ⚙️ Example Usage:
 * ```php
 * use Maatify\Bootstrap\Core\EnvironmentLoader;
 *
 * $env = new EnvironmentLoader(__DIR__ . '/../');
 * $env->load();
 * ```
 *
 * @package Maatify\Bootstrap\Core
 */
final class EnvironmentLoader
{
    /**
     * @var string $basePath Base directory where environment files are located.
     */
    public function __construct(private readonly string $basePath) {}

    /**
     * 🎯 Loads the most relevant `.env` file (based on defined priority)
     * and applies its values to the global environment.
     *
     * If no environment file is found, an {@see Exception} is thrown.
     * Automatically sets the timezone after successful loading.
     *
     * @throws Exception If no `.env` file is found in the base directory.
     */
    public function load(): void
    {
        // 🔍 Check files in order of precedence
        $envFiles = ['.env.local', '.env.testing', '.env'];
        $loaded   = false;

        foreach ($envFiles as $file) {
            $path = $this->basePath . DIRECTORY_SEPARATOR . $file;
            if (is_file($path)) {
                // 🧩 Load using Dotenv with immutability for safety
                Dotenv::createImmutable($this->basePath, $file)->load();
                $loaded = true;
                break;
            }
        }

        // 🚫 Fail if no environment file exists
        if (! $loaded) {
            throw new Exception('No .env file found in ' . $this->basePath);
        }

        // 🕒 Set default timezone after successful load
        $timezone = $_ENV['APP_TIMEZONE']
                    ?? $_SERVER['APP_TIMEZONE']
                       ?? 'Africa/Cairo';

        date_default_timezone_set($timezone);
    }
}
