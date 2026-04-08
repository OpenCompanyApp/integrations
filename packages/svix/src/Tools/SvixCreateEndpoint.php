<?php

namespace OpenCompany\Integrations\Svix\Tools;

use OpenCompany\Integrations\Svix\SvixService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SvixCreateEndpoint implements Tool
{
    public function __construct(
        private SvixService $service,
    ) {}

    public function name(): string
    {
        return 'svix_create_endpoint';
    }

    public function description(): string
    {
        return 'Create a new webhook endpoint for a Svix application. Webhook events will be delivered to the specified URL.';
    }

    public function parameters(): array
    {
        return [
            'app_id' => ['type' => 'string', 'required' => true, 'description' => 'The application ID (e.g., "app_xxxxxxxxx").'],
            'url' => ['type' => 'string', 'required' => true, 'description' => 'The URL where webhook events will be delivered (e.g., "https://example.com/webhooks").'],
            'version' => ['type' => 'integer', 'required' => true, 'description' => 'The API version for the endpoint (e.g., 1).'],
            'description' => ['type' => 'string', 'description' => 'Optional description for the endpoint.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Svix integration is not configured.');
            }

            $appId = $args['app_id'] ?? '';
            if (empty($appId)) {
                return ToolResult::error('The "app_id" parameter is required.');
            }

            $url = $args['url'] ?? '';
            if (empty($url)) {
                return ToolResult::error('The "url" parameter is required.');
            }

            $version = isset($args['version']) ? (int) $args['version'] : 1;
            if ($version < 1) {
                return ToolResult::error('The "version" parameter must be a positive integer.');
            }

            $description = $args['description'] ?? null;

            $result = $this->service->createEndpoint($appId, $url, $version, $description);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
