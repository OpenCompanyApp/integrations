<?php

namespace OpenCompany\Integrations\ZohoMail\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\ZohoMail\ZohoMailService;

/**
 * Shared helper methods for Zoho Mail REST API tools.
 */
abstract class AbstractZohoMailTool implements Tool
{
    /**
     * @param  ZohoMailService  $service  Zoho Mail API client.
     */
    public function __construct(
        protected ZohoMailService $service,
    ) {}

    /**
     * Read a string argument.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    protected function string(array $args, string $key, string $default = ''): string
    {
        $value = $args[$key] ?? $default;

        return is_scalar($value) ? (string) $value : $default;
    }

    /**
     * Read an integer argument.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    protected function integer(array $args, string $key, int $default): int
    {
        return isset($args[$key]) ? (int) $args[$key] : $default;
    }

    /**
     * Read a boolean argument.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    protected function boolean(array $args, string $key, bool $default = false): bool
    {
        return array_key_exists($key, $args) ? (bool) $args[$key] : $default;
    }

    /**
     * Read an array argument, decoding JSON strings when supplied.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string|int, mixed>
     */
    protected function arrayArg(array $args, string $key): array
    {
        $value = $args[$key] ?? [];

        if (is_string($value)) {
            $decoded = json_decode($value, true);

            return is_array($decoded) ? $decoded : [];
        }

        return is_array($value) ? $value : [];
    }

    /**
     * Read a required string argument.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    protected function requiredString(array $args, string $key): string
    {
        $value = $this->string($args, $key);
        if ($value === '') {
            throw new \InvalidArgumentException("{$key} is required.");
        }

        return $value;
    }

    /**
     * Execute a tool operation with consistent configuration and error handling.
     *
     * @param  callable(): array<string, mixed>  $callback  Tool operation.
     */
    protected function run(callable $callback): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Zoho Mail integration is not configured.');
            }

            return ToolResult::success($callback());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
