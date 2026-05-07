<?php

namespace OpenCompany\Integrations\Pinboard\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pinboard\PinboardService;

/**
 * Execute a guarded raw Pinboard GET request.
 */
class PinboardApiGet implements Tool
{
    /**
     * @param  PinboardService  $service  Pinboard API client.
     */
    public function __construct(private PinboardService $service) {}

    public function name(): string { return 'pinboard_api_get'; }

    public function description(): string { return 'Call a safe relative Pinboard GET path for endpoints not covered by first-class tools.'; }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'Relative Pinboard API path.'],
            'payload' => ['type' => 'object', 'description' => 'Query parameters.'],
        ];
    }

    /**
     * Execute the raw Pinboard request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pinboard integration is not configured.');
            }

            if (($args['path'] ?? '') === '') {
                return ToolResult::error('path is required.');
            }

            $payload = isset($args['payload']) && is_array($args['payload']) ? $args['payload'] : [];

            return ToolResult::success($this->service->apiGet((string) $args['path'], $payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
