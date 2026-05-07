<?php

namespace OpenCompany\Integrations\Splunk\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Splunk\SplunkService;

/**
 * Shared helper methods for Splunk REST API tools.
 */
abstract class AbstractSplunkTool implements Tool
{
    /**
     * @param  SplunkService  $service  Splunk API client.
     */
    public function __construct(
        protected SplunkService $service,
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
     * Execute the callback with consistent exception handling.
     *
     * @param  callable(): array<string, mixed>  $callback  Tool operation.
     */
    protected function run(callable $callback): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Splunk integration is not configured.');
            }

            return ToolResult::success($callback());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
