<?php

namespace OpenCompany\Integrations\Svix\Tools;

use OpenCompany\Integrations\Svix\SvixService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SvixListEndpoints implements Tool
{
    public function __construct(
        private SvixService $service,
    ) {}

    public function name(): string
    {
        return 'svix_list_endpoints';
    }

    public function description(): string
    {
        return 'List webhook endpoints for a Svix application. Returns endpoint IDs, URLs, and descriptions.';
    }

    public function parameters(): array
    {
        return [
            'app_id' => ['type' => 'string', 'required' => true, 'description' => 'The application ID (e.g., "app_xxxxxxxxx").'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of endpoints to return (default: 50, max: 250).'],
            'iterator' => ['type' => 'string', 'description' => 'Cursor for pagination — pass the iterator value from a previous response to get the next page.'],
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

            $limit = isset($args['limit']) ? (int) $args['limit'] : 50;
            $iterator = $args['iterator'] ?? null;

            $result = $this->service->listEndpoints($appId, $limit, $iterator);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
