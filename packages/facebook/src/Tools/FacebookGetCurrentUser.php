<?php

namespace OpenCompany\Integrations\Facebook\Tools;

use OpenCompany\Integrations\Facebook\FacebookService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FacebookGetCurrentUser implements Tool
{
    public function __construct(
        private FacebookService $service,
    ) {}

    public function name(): string
    {
        return 'facebook_get_current_user';
    }

    public function description(): string
    {
        return 'Get the authenticated user\'s Facebook profile information, including name and user ID.';
    }

    public function parameters(): array
    {
        return [
            'fields' => [
                'type' => 'string',
                'description' => 'Comma-separated list of fields to return (e.g. "id,name,email,picture"). Defaults to "id,name".',
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
                $params['fields'] = 'id,name';
            }

            $result = $this->service->getCurrentUser($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
