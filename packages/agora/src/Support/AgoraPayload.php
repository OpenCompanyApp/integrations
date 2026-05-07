<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Agora\Support;

use RuntimeException;

/**
 * Small helpers for validating and normalizing Agora tool arguments.
 *
 * Keeps snake_case agent parameters separate from the camelCase JSON payloads
 * required by Agora's RESTful APIs.
 */
final class AgoraPayload
{
    /**
     * Require a non-empty string argument.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public static function requiredString(array $args, string $key): string
    {
        $value = $args[$key] ?? null;

        if (! is_string($value) || trim($value) === '') {
            throw new RuntimeException("{$key} is required.");
        }

        return trim($value);
    }

    /**
     * Read an optional string argument with a default.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public static function optionalString(array $args, string $key, string $default = ''): string
    {
        $value = $args[$key] ?? null;

        return is_string($value) && trim($value) !== '' ? trim($value) : $default;
    }

    /**
     * Read an optional object argument, accepting decoded arrays or JSON strings.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    public static function object(array $args, string $key): array
    {
        if (! array_key_exists($key, $args) || $args[$key] === null || $args[$key] === '') {
            return [];
        }

        $value = $args[$key];

        if (is_string($value)) {
            $decoded = json_decode($value, true);
            if (! is_array($decoded)) {
                throw new RuntimeException("{$key} must be an object or valid JSON object.");
            }

            return $decoded;
        }

        if (! is_array($value)) {
            throw new RuntimeException("{$key} must be an object.");
        }

        return $value;
    }
}
