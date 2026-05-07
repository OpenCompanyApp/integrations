<?php

namespace OpenCompany\Integrations\CoinGecko\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\CoinGecko\CoinGeckoService;

/**
 * Base class for CoinGecko tools that delegate to CoinGeckoService.
 */
abstract class AbstractCoinGeckoTool implements Tool
{
    /**
     * @param  CoinGeckoService  $service  CoinGecko API client
     */
    public function __construct(protected CoinGeckoService $service) {}

    /**
     * Execute the CoinGecko tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('CoinGecko integration is not configured.');
            }

            return ToolResult::success($this->callService($args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Call the concrete service method for this tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     * @return array<string, mixed>|array<int, mixed>
     */
    abstract protected function callService(array $args): array;

    /**
     * Return an optional object argument as an array.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     * @return array<string, mixed>
     */
    protected function optionalParams(array $args, string $key = 'params'): array
    {
        return is_array($args[$key] ?? null) ? $args[$key] : [];
    }

    /**
     * Return a required string argument.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    protected function stringArg(array $args, string $key): string
    {
        if (empty($args[$key])) {
            throw new \RuntimeException("{$key} is required.");
        }

        return (string) $args[$key];
    }

    /**
     * Parse a comma-separated string or array argument into strings.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     * @return array<int, string>
     */
    protected function stringListArg(array $args, string $key, ?string $default = null): array
    {
        $value = $args[$key] ?? $default;

        if ($value === null || $value === '') {
            throw new \RuntimeException("{$key} is required.");
        }

        if (is_array($value)) {
            return array_values(array_filter(array_map(static fn ($item): string => trim((string) $item), $value)));
        }

        return array_values(array_filter(array_map('trim', explode(',', (string) $value))));
    }
}
