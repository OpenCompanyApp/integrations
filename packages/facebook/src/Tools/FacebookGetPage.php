<?php

namespace OpenCompany\Integrations\Facebook\Tools;

use OpenCompany\Integrations\Facebook\FacebookService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FacebookGetPage implements Tool
{
    public function __construct(
        private FacebookService $service,
    ) {}

    public function name(): string
    {
        return 'facebook_get_page';
    }

    public function description(): string
    {
        return 'Get details for a specific Facebook Page by its ID. Returns page name, category, follower count, and other metadata.';
    }

    public function parameters(): array
    {
        return [
            'page_id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The Facebook Page ID.',
            ],
            'fields' => [
                'type' => 'string',
                'description' => 'Comma-separated list of fields to return (e.g. "id,name,category,fan_count,about,website,phone"). Defaults to "id,name,category,fan_count,about".',
            ],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Facebook integration is not configured.');
            }

            if (empty($args['page_id'])) {
                return ToolResult::error('page_id is required.');
            }

            $params = [];

            if (isset($args['fields'])) {
                $params['fields'] = $args['fields'];
            } else {
                $params['fields'] = 'id,name,category,fan_count,about';
            }

            $result = $this->service->getPage($args['page_id'], $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
