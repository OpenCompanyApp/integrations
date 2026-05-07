<?php

namespace OpenCompany\Integrations\OneSignal\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\OneSignal\OneSignalService;

/**
 * Shared helper for OneSignal tool implementations.
 */
abstract class AbstractOneSignalTool implements Tool
{
    /**
     * @param  OneSignalService  $service  OneSignal API client.
     */
    public function __construct(
        protected OneSignalService $service,
    ) {}

    /**
     * Execute a service callback with common error handling.
     *
     * @param  callable(): array<string, mixed>  $callback  Service call.
     */
    protected function run(callable $callback): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('OneSignal integration is not configured.');
            }

            return ToolResult::success($callback());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Read a required argument.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    protected function required(array $args, string $key): mixed
    {
        if (!array_key_exists($key, $args) || $args[$key] === null || $args[$key] === '') {
            throw new \InvalidArgumentException("Missing required argument: {$key}");
        }

        return $args[$key];
    }

    /**
     * Return non-empty values for selected keys.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @param  array<int, string>  $keys  Keys to keep.
     * @return array<string, mixed>
     */
    protected function only(array $args, array $keys): array
    {
        $data = [];

        foreach ($keys as $key) {
            if (array_key_exists($key, $args) && $args[$key] !== null && $args[$key] !== '') {
                $data[$key] = $args[$key];
            }
        }

        return $data;
    }

    /**
     * Read a full payload object or fall back to selected top-level keys.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @param  array<int, string>  $keys  Fallback payload keys.
     * @return array<string, mixed>
     */
    protected function payload(array $args, array $keys = []): array
    {
        if (isset($args['payload']) && is_array($args['payload'])) {
            return $args['payload'];
        }

        return $this->only($args, $keys);
    }
}
