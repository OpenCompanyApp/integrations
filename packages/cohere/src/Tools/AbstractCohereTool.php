<?php

namespace OpenCompany\Integrations\Cohere\Tools;

use OpenCompany\Integrations\Cohere\CohereService;

/**
 * Shared helpers for Cohere tool classes.
 *
 * Keeps argument filtering, enum validation, and required-value handling
 * consistent across Cohere's endpoint-specific tools.
 */
abstract class AbstractCohereTool
{
    /**
     * @param  CohereService  $service  Cohere API client.
     */
    public function __construct(
        protected CohereService $service,
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
     * Ensure a required array argument exists.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<mixed>
     */
    protected function requireArray(array $args, string $key): array
    {
        $value = $args[$key] ?? null;

        if (!is_array($value) || $value === []) {
            throw new \InvalidArgumentException($key . ' must be a non-empty array.');
        }

        return array_values($value);
    }

    /**
     * Ensure a required string-list argument exists.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<int, string>
     */
    protected function requireStringList(array $args, string $key): array
    {
        $value = $this->requireArray($args, $key);

        foreach ($value as $item) {
            if (!is_string($item) || trim($item) === '') {
                throw new \InvalidArgumentException($key . ' must contain only non-empty strings.');
            }
        }

        return $value;
    }

    /**
     * Ensure a required integer-list argument exists.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<int, int>
     */
    protected function requireIntegerList(array $args, string $key): array
    {
        $value = $this->requireArray($args, $key);

        foreach ($value as $item) {
            if (!is_int($item)) {
                throw new \InvalidArgumentException($key . ' must contain only integers.');
            }
        }

        return $value;
    }
}
