<?php

namespace OpenCompany\Integrations\Pocket\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pocket\PocketService;

/**
 * Execute a guarded raw Pocket v3 POST call.
 */
class PocketApiPost implements Tool
{
    /**
     * @param  PocketService  $service  Pocket API client.
     */
    public function __construct(private PocketService $service) {}

    public function name(): string { return 'pocket_api_post'; }

    public function description(): string { return 'Call a safe relative Pocket v3 POST path for endpoints not covered by first-class tools.'; }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'Relative Pocket API path.'],
            'payload' => ['type' => 'object', 'description' => 'JSON body fields.'],
        ];
    }

    /**
     * Execute the raw Pocket request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pocket integration is not configured.');
            }

            if (($args['path'] ?? '') === '') {
                return ToolResult::error('path is required.');
            }

            $payload = isset($args['payload']) && is_array($args['payload']) ? $args['payload'] : [];

            return ToolResult::success($this->service->apiPost((string) $args['path'], $payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
