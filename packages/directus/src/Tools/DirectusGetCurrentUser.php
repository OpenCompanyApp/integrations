<?php

namespace OpenCompany\Integrations\Directus\Tools;

use OpenCompany\Integrations\Directus\DirectusService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class DirectusGetCurrentUser implements Tool
{
    public function __construct(
        private DirectusService $service,
    ) {}

    public function name(): string
    {
        return 'directus_get_current_user';
    }

    public function description(): string
    {
        return 'Get the profile of the currently authenticated Directus user. Useful for verifying the connection and understanding user permissions.';
    }

    public function parameters(): array
    {
        return [
            'fields' => ['type' => 'string', 'description' => 'Comma-separated list of user fields to include (e.g. "id,email,first_name,last_name,role").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Directus integration is not configured.');
            }

            $params = [];

            if (isset($args['fields'])) {
                $params['fields'] = $args['fields'];
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
