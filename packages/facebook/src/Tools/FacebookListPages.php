<?php

namespace OpenCompany\Integrations\Facebook\Tools;

use OpenCompany\Integrations\Facebook\FacebookService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FacebookListPages implements Tool
{
    public function __construct(
        private FacebookService $service,
    ) {}

    public function name(): string
    {
        return 'facebook_list_pages';
    }

    public function description(): string
    {
        return 'List all Facebook Pages the authenticated user manages. Returns page IDs, names, and access tokens for further operations.';
    }

    public function parameters(): array
    {
        return [
            'fields' => [
                'type' => 'string',
                'description' => 'Comma-separated list of fields to return per page (e.g. "id,name,category,fan_count,about"). Defaults to "id,name,category".',
            ],
            'limit' => [
                'type' => 'integer',
                'description' => 'Maximum number of pages to return per request.',
            ],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Facebook integration is not configured.');
            }

            $params = [];

            if (isset($args['fields'])) {
                $params['fields'] = $args['fields'];
            } else {
                $params['fields'] = 'id,name,category';
            }

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }

            $result = $this->service->listPages($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
