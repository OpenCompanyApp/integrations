<?php

namespace OpenCompany\Integrations\Canny\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Canny\CannyService;

/**
 * Execute a guarded raw Canny API POST call.
 *
 * Use only for newly documented endpoints that do not yet have a first-class
 * tool; full URLs are rejected to keep credentials on the configured host.
 */
class CannyApiPost implements Tool
{
    /**
     * @param  CannyService  $service  Canny API client.
     */
    public function __construct(private CannyService $service) {}

    public function name(): string { return 'canny_api_post'; }

    public function description(): string { return 'Call a safe relative Canny API POST path for endpoints not covered by first-class tools.'; }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'Relative Canny API path such as /api/v1/boards/list.'],
            'payload' => ['type' => 'object', 'description' => 'Request body fields without apiKey.'],
        ];
    }

    /**
     * Execute a raw Canny POST request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Canny integration is not configured.');
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
