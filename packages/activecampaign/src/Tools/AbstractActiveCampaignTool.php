<?php

namespace OpenCompany\Integrations\ActiveCampaign\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\ActiveCampaign\ActiveCampaignService;

/**
 * Shared helpers for ActiveCampaign tool wrappers.
 */
abstract class AbstractActiveCampaignTool
{
    /**
     * @param  ActiveCampaignService  $service  The ActiveCampaign API client.
     */
    public function __construct(
        protected ActiveCampaignService $service,
    ) {}

    /**
     * Execute a service call with standard error handling.
     *
     * @param  callable(): array<string, mixed>  $callback  Service operation.
     */
    protected function run(callable $callback): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ActiveCampaign integration is not configured.');
            }

            return ToolResult::success($callback());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Read a required positive integer argument.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    protected function requiredInt(array $args, string $key, string $label): int
    {
        $value = (int) ($args[$key] ?? 0);
        if ($value <= 0) {
            throw new \InvalidArgumentException("A valid {$label} is required.");
        }

        return $value;
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
     * Return an array argument or an empty array.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function arrayArg(array $args, string $key): array
    {
        return is_array($args[$key] ?? null) ? $args[$key] : [];
    }

    /**
     * Pick non-empty values from tool arguments.
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
}
