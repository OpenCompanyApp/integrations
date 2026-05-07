<?php

namespace OpenCompany\Integrations\Algolia\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Algolia\AlgoliaService;

/**
 * Shared argument parsing and error handling for Algolia tools.
 */
abstract class AbstractAlgoliaTool implements Tool
{
    /**
     * @param  AlgoliaService  $service  The Algolia API client.
     */
    public function __construct(
        protected AlgoliaService $service,
    ) {}

    /**
     * Run an Algolia API operation.
     *
     * @param  callable(): array<string, mixed>  $operation  Operation to run.
     */
    protected function run(callable $operation): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Algolia integration is not configured.');
            }

            return ToolResult::success($operation());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Read a required string argument.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    protected function requiredString(array $args, string $key): string
    {
        if (!isset($args[$key]) || trim((string) $args[$key]) === '') {
            throw new \InvalidArgumentException("{$key} is required.");
        }

        return trim((string) $args[$key]);
    }

    /**
     * Read an optional string argument.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    protected function stringArg(array $args, string $key, string $default = ''): string
    {
        return isset($args[$key]) && $args[$key] !== '' ? trim((string) $args[$key]) : $default;
    }

    /**
     * Read an optional boolean argument.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    protected function boolArg(array $args, string $key, bool $default = false): bool
    {
        if (!array_key_exists($key, $args)) {
            return $default;
        }

        return filter_var($args[$key], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) ?? $default;
    }

    /**
     * Read an optional object or JSON object argument.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function objectArg(array $args, string $key, array $default = []): array
    {
        if (!array_key_exists($key, $args) || $args[$key] === null || $args[$key] === '') {
            return $default;
        }

        if (is_array($args[$key])) {
            return $args[$key];
        }

        if (is_string($args[$key])) {
            $decoded = json_decode($args[$key], true);

            if (is_array($decoded)) {
                return $decoded;
            }
        }

        throw new \InvalidArgumentException("{$key} must be an object or valid JSON object.");
    }

    /**
     * Read a required array or JSON array argument.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<int, mixed>
     */
    protected function requiredList(array $args, string $key): array
    {
        if (!array_key_exists($key, $args) || $args[$key] === null || $args[$key] === '') {
            throw new \InvalidArgumentException("{$key} is required.");
        }

        if (is_array($args[$key])) {
            return array_values($args[$key]);
        }

        if (is_string($args[$key])) {
            $decoded = json_decode($args[$key], true);

            if (is_array($decoded)) {
                return array_values($decoded);
            }
        }

        throw new \InvalidArgumentException("{$key} must be an array or valid JSON array.");
    }
}
