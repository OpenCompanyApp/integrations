<?php

namespace OpenCompany\Integrations\Ghost\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Ghost\GhostService;

class GhostGetCurrentUser implements Tool
{
    public function __construct(
        private GhostService $service,
    ) {}

    public function name(): string
    {
        return 'ghost_get_current_user';
    }

    public function description(): string
    {
        return 'Get the currently authenticated Ghost admin user. Useful for verifying API credentials and checking user role/permissions.';
    }

    public function parameters(): array
    {
        return [
            'fields' => [
                'type' => 'string',
                'description' => 'Comma-separated list of fields to return (e.g. "id,name,email,role").',
            ],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Ghost integration is not configured. Provide an Admin API key and base URL.');
            }

            $params = [];
            if (! empty($args['fields'])) {
                $params['fields'] = $args['fields'];
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
