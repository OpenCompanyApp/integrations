<?php

namespace OpenCompany\Integrations\Unbounce\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Unbounce\UnbounceService;

/**
 * Shared helper methods for Unbounce REST API tools.
 */
abstract class AbstractUnbounceTool implements Tool
{
    /**
     * @param  UnbounceService  $service  Unbounce API client.
     */
    public function __construct(
        protected UnbounceService $service,
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
     * Execute a tool operation with consistent configuration and error handling.
     *
     * @param  callable(): array<string, mixed>  $callback  Tool operation.
     */
    protected function run(callable $callback): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Unbounce integration is not configured.');
            }

            return ToolResult::success($callback());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
