<?php

namespace OpenCompany\Integrations\Tally\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Tally\TallyService;

/**
 * Shared execution helpers for Tally tool wrappers.
 */
abstract class AbstractTallyTool
{
    /**
     * @param  TallyService  $service  The Tally API service instance.
     */
    public function __construct(
        protected TallyService $service,
    ) {}

    /**
     * Run a Tally API operation with configuration and exception handling.
     *
     * @param  callable(): array<string, mixed>  $callback  Service call to execute.
     */
    protected function run(callable $callback): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Tally integration is not configured.');
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
     * Keep only supported payload keys, preserving arrays and scalar values.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @param  array<int, string>  $keys  Allowed keys.
     * @return array<string, mixed>
     */
    protected function payload(array $args, array $keys): array
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
     * Keep only supported query parameters.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @param  array<int, string>  $keys  Allowed query keys.
     * @return array<string, mixed>
     */
    protected function params(array $args, array $keys): array
    {
        return $this->payload($args, $keys);
    }

    /**
     * Map snake_case tool parameters to Tally's camelCase JSON/query keys.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @param  array<string, string>  $map  Tool key to API key map.
     * @return array<string, mixed>
     */
    protected function mappedPayload(array $args, array $map): array
    {
        $payload = [];

        foreach ($map as $source => $target) {
            if (array_key_exists($source, $args) && $args[$source] !== null && $args[$source] !== '') {
                $payload[$target] = $args[$source];
            }
        }

        return $payload;
    }
}
