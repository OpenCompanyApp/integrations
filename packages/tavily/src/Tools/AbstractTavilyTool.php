<?php

namespace OpenCompany\Integrations\Tavily\Tools;

use OpenCompany\Integrations\Tavily\TavilyService;

/**
 * Shared helpers for Tavily tool classes.
 *
 * Keeps argument filtering, enum validation, and common configured-state
 * handling consistent across Tavily's endpoint-specific tools.
 */
abstract class AbstractTavilyTool
{
    /**
     * @param  TavilyService  $service  Tavily API client.
     */
    public function __construct(
        protected TavilyService $service,
    ) {}

    /**
     * Copy only recognized parameters from tool arguments to an API payload.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @param  string[]  $keys  Parameter keys accepted by the endpoint.
     * @return array<string, mixed>
     */
    protected function only(array $args, array $keys): array
    {
        $payload = [];

        foreach ($keys as $key) {
            if (array_key_exists($key, $args) && $args[$key] !== null && $args[$key] !== '') {
                $payload[$key] = $args[$key];
            }
        }

        return $payload;
    }

    /**
     * Ensure an argument value is one of the documented values.
     *
     * @param  array<int, string>  $allowed  Allowed values.
     */
    protected function assertEnum(string $key, mixed $value, array $allowed): void
    {
        if ($value === null || $value === '') {
            return;
        }

        if (!is_string($value) || !in_array($value, $allowed, true)) {
            throw new \InvalidArgumentException($key . ' must be one of: ' . implode(', ', $allowed) . '.');
        }
    }

    /**
     * Ensure a required string argument exists.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    protected function requireString(array $args, string $key): string
    {
        $value = $args[$key] ?? null;

        if (!is_string($value) || trim($value) === '') {
            throw new \InvalidArgumentException($key . ' must be a non-empty string.');
        }

        return $value;
    }

    /**
     * Ensure a required string or string-list argument exists.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return string|array<int, string>
     */
    protected function requireStringOrList(array $args, string $key): string|array
    {
        $value = $args[$key] ?? null;

        if (is_string($value) && trim($value) !== '') {
            return $value;
        }

        if (is_array($value) && $value !== []) {
            foreach ($value as $item) {
                if (!is_string($item) || trim($item) === '') {
                    throw new \InvalidArgumentException($key . ' must contain only non-empty strings.');
                }
            }

            return array_values($value);
        }

        throw new \InvalidArgumentException($key . ' must be a non-empty string or non-empty string array.');
    }
}
