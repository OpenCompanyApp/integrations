<?php

namespace OpenCompany\Integrations\Fellow\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Fellow\FellowService;

/**
 * Shared helpers for Fellow tool implementations.
 *
 * Centralizes configuration checks, simple argument validation, and exception
 * handling so individual tools can stay focused on endpoint mapping.
 */
abstract class AbstractFellowTool
{
    /**
     * @param  FellowService  $service  The Fellow API service instance.
     */
    public function __construct(
        protected FellowService $service,
    ) {}

    /**
     * Execute a Fellow API operation with consistent error handling.
     *
     * @param  callable(): array<string, mixed>  $callback  Operation to execute.
     */
    protected function run(callable $callback): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Fellow integration is not configured.');
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
    protected function requiredString(array $args, string $key): string
    {
        $value = trim((string) ($args[$key] ?? ''));

        if ($value === '') {
            throw new \InvalidArgumentException("{$key} is required.");
        }

        return $value;
    }

    /**
     * Collect a generic JSON body from the tool arguments.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @param  array<int, string>  $keys  Keys to copy into the body when present.
     * @return array<string, mixed>
     */
    protected function body(array $args, array $keys): array
    {
        $body = $args['payload'] ?? [];

        foreach ($keys as $key) {
            if (array_key_exists($key, $args)) {
                $body[$key] = $args[$key];
            }
        }

        return $body;
    }
}
