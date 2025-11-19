<?php

/**
 * @copyright   ©2025 Maatify.dev
 * @Library     maatify/bootstrap
 * @Project     maatify:bootstrap
 * @author      Mohamed Abdulalim (megyptm) <mohamed@maatify.dev>
 * @since       2025-11-09 16:12
 * @see         https://www.maatify.dev Maatify.com
 * @link        https://github.com/Maatify/bootstrap  view project on GitHub
 * @note        Distributed in the hope that it will be useful - WITHOUT WARRANTY.
 */

declare(strict_types=1);

namespace Maatify\Bootstrap\Helpers;

/**
 * ⚙️ Class PathHelper
 *
 * 🧩 Purpose:
 * Provides a unified and cross-platform way to resolve and manage
 * directory paths across all Maatify projects (apps, libraries, and services).
 *
 * ✅ Features:
 * - Dynamically determines project base path (`dirname(__DIR__, 2)`).
 * - Offers standardized accessors for `/storage` and `/storage/logs`.
 * - Ensures path concatenation is OS-safe (Linux, macOS, Windows).
 * - Avoids trailing slashes for predictable path formatting.
 *
 * ⚙️ Example Usage:
 * ```php
 * use Maatify\Bootstrap\Helpers\PathHelper;
 *
 * echo PathHelper::base();          // → /var/www/maatify/bootstrap
 * echo PathHelper::storage();       // → /var/www/maatify/bootstrap/storage
 * echo PathHelper::logs('app.log'); // → /var/www/maatify/bootstrap/storage/logs/app.log
 * ```
 *
 * @package Maatify\Bootstrap\Helpers
 */
final class PathHelper
{
    /**
     * 🧠 Cached base path (resolved once per request for performance).
     *
     * @var string|null
     */
    private static ?string $basePath = null;

    /**
     * 🏗️ Get the project’s root base path.
     *
     * Optionally append a relative path (e.g. `/config`, `/public`).
     *
     * @param string|null $append Optional subpath to append.
     * @return string Resolved absolute path.
     */
    public static function base(?string $append = null): string
    {
        if (self::$basePath === null) {
            $resolved = realpath(dirname(__DIR__, 2));
            self::$basePath = is_string($resolved)
                ? $resolved
                : dirname(__DIR__, 2);
        }

        return self::join(self::$basePath, $append);
    }

    /**
     * 📦 Get the `/storage` directory path.
     *
     * Optionally append a file or folder name (e.g. `logs/app.log`).
     *
     * @param string|null $append Optional relative path inside storage.
     * @return string Resolved storage path.
     */
    public static function storage(?string $append = null): string
    {
        return self::join(self::base('storage'), $append);
    }

    /**
     * 🧾 Get the `/storage/logs` directory path.
     *
     * Used by PSR loggers and activity tracking systems.
     *
     * @param string|null $append Optional log file name.
     * @return string Resolved logs path.
     */
    public static function logs(?string $append = null): string
    {
        return self::join(self::base('storage/logs'), $append);
    }

    /**
     * 🔗 Safely join root and subpath ensuring normalized slashes.
     *
     * @param string $root   Root directory path.
     * @param string|null $append Optional relative subpath.
     * @return string Normalized joined path without trailing slash.
     */
    private static function join(string $root, ?string $append): string
    {
        return rtrim($root . ($append ? '/' . ltrim($append, '/') : ''), '/');
    }
}
