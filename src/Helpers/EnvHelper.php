<?php
/**
 * @copyright   ©2025 Maatify.dev
 * @Library     maatify/bootstrap
 * @Project     maatify:bootstrap
 * @author      Mohamed Abdulalim (megyptm) <mohamed@maatify.dev>
 * @since       2025-11-09 16:19
 * @see         https://www.maatify.dev Maatify.com
 * @link        https://github.com/Maatify/bootstrap  view project on GitHub
 * @note        Distributed in the hope that it will be useful - WITHOUT WARRANTY.
 */

declare(strict_types=1);

namespace Maatify\Bootstrap\Helpers;

/**
 * ⚙️ Class EnvHelper
 *
 * 🧩 Purpose:
 * Provides safe, cached, and immutable access to environment variables across
 * all Maatify applications and libraries.
 *
 * ✅ Features:
 * - Retrieves environment variables from multiple sources (`$_ENV`, `$_SERVER`, `getenv()`).
 * - Caches fetched keys for performance (avoiding repeated lookups).
 * - Supports fallback default values when variables are missing.
 * - Works with both mutable and immutable Dotenv environments.
 *
 * ⚙️ Example Usage:
 * ```php
 * use Maatify\Bootstrap\Helpers\EnvHelper;
 *
 * $dbHost = EnvHelper::get('DB_HOST', 'localhost');
 * if (EnvHelper::has('APP_ENV')) {
 *     echo "Running in: " . EnvHelper::get('APP_ENV');
 * }
 *
 * print_r(EnvHelper::cached());
 * ```
 *
 * @package Maatify\Bootstrap\Helpers
 */
final class EnvHelper
{
    /**
     * 🧠 Internal cache of environment variables.
     *
     * @var array<string, mixed>
     */
    private static array $cache = [];

    /**
     * 🎯 Retrieve an environment variable with caching and fallback.
     *
     * Checks the following sources in order:
     * 1️⃣ `$_ENV`
     * 2️⃣ `$_SERVER`
     * 3️⃣ `getenv()`
     * 4️⃣ Default value (if provided)
     *
     * Once retrieved, the value is cached to prevent redundant lookups.
     *
     * @param string $key Environment variable name.
     * @param mixed $default Default value if variable is not found.
     *
     * @return mixed The resolved value or the provided default.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        if (array_key_exists($key, self::$cache)) {
            return self::$cache[$key];
        }

        $value = $_ENV[$key]
                 ?? $_SERVER[$key]
                    ?? getenv($key)
                       ?? $default;

        return self::$cache[$key] = $value;
    }

    /**
     * 🔍 Check if an environment variable is defined.
     *
     * @param string $key The variable key to check.
     *
     * @return bool True if exists, false otherwise.
     */
    public static function has(string $key): bool
    {
        return self::get($key) !== null;
    }

    /**
     * 📦 Retrieve all cached environment variables.
     *
     * Useful for debugging or inspecting loaded configurations.
     *
     * @return array<string, mixed> Cached environment values.
     */
    public static function cached(): array
    {
        return self::$cache;
    }
}
