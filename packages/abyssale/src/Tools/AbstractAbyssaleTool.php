<?php

namespace OpenCompany\Integrations\Abyssale\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Abyssale\AbyssaleService;

/**
 * Shared helpers for Abyssale tool wrappers.
 */
abstract class AbstractAbyssaleTool
{
    /**
     * @param  AbyssaleService  $service  The Abyssale API client.
     */
    public function __construct(
        protected AbyssaleService $service,
    ) {}

    /**
     * Run a service call with configuration and exception handling.
     *
     * @param  callable(): array<string, mixed>  $callback  Service operation.
     */
    protected function run(callable $callback): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Abyssale integration is not configured.');
            }

            return ToolResult::success($callback());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Read a required string argument.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    protected function requiredString(array $args, string $key, string $label): string
    {
        $value = trim((string) ($args[$key] ?? ''));
        if ($value === '') {
            throw new \InvalidArgumentException("{$label} is required.");
        }

        return $value;
    }

    /**
     * Read an optional string argument.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    protected function optionalString(array $args, string $key): ?string
    {
        $value = trim((string) ($args[$key] ?? ''));

        return $value === '' ? null : $value;
    }

    /**
     * Read an array argument or return an empty array.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string|int, mixed>
     */
    protected function arrayArg(array $args, string $key): array
    {
        return is_array($args[$key] ?? null) ? $args[$key] : [];
    }

    /**
     * Read a required non-empty array argument.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string|int, mixed>
     */
    protected function requiredArray(array $args, string $key, string $label): array
    {
        $value = $this->arrayArg($args, $key);
        if ($value === []) {
            throw new \InvalidArgumentException("{$label} is required.");
        }

        return $value;
    }
}
