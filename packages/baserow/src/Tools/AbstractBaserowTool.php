<?php

namespace OpenCompany\Integrations\Baserow\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Baserow\BaserowService;

/**
 * Shared helpers for Baserow tool argument parsing and error handling.
 */
abstract class AbstractBaserowTool implements Tool
{
    /**
     * @param  BaserowService  $service  Baserow API client.
     */
    public function __construct(
        protected BaserowService $service,
    ) {}

    /**
     * Execute a Baserow operation with common configuration and exception handling.
     *
     * @param  callable(): array<string, mixed>  $operation  Operation to run.
     */
    protected function run(callable $operation): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Baserow integration is not configured.');
            }

            return ToolResult::success($operation());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Read a required integer argument.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    protected function requiredInt(array $args, string $key): int
    {
        if (!isset($args[$key]) || $args[$key] === '') {
            throw new \InvalidArgumentException("{$key} is required.");
        }

        return (int) $args[$key];
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
     * Read an optional object or JSON string argument.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function arrayArg(array $args, string $key, array $default = []): array
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
     * Read an optional array or JSON array argument.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<int, mixed>
     */
    protected function listArg(array $args, string $key): array
    {
        if (!array_key_exists($key, $args) || $args[$key] === null || $args[$key] === '') {
            return [];
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
