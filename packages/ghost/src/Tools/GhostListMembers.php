<?php

namespace OpenCompany\Integrations\Ghost\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Ghost\GhostService;

class GhostListMembers implements Tool
{
    public function __construct(
        private GhostService $service,
    ) {}

    public function name(): string
    {
        return 'ghost_list_members';
    }

    public function description(): string
    {
        return 'List newsletter members from Ghost CMS. Supports filtering by subscription status, email search, and pagination. Returns member names, emails, labels, and subscription info.';
    }

    public function parameters(): array
    {
        return [
            'page' => [
                'type' => 'integer',
                'description' => 'Page number (default: 1).',
            ],
            'limit' => [
                'type' => 'integer',
                'description' => 'Number of members per page (default: 15, max: 100).',
            ],
            'filter' => [
                'type' => 'string',
                'description' => 'Ghost filter syntax, e.g. "subscribed:true" or "email:@example.com". Use `+` for AND, `,` for OR.',
            ],
            'order' => [
                'type' => 'string',
                'description' => 'Sort order (default: "created_at desc"). Examples: "name asc", "email desc".',
            ],
            'fields' => [
                'type' => 'string',
                'description' => 'Comma-separated list of fields to return (e.g. "id,name,email,status").',
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

            if (! empty($args['filter'])) {
                $params['filter'] = $args['filter'];
            }
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (isset($args['limit'])) {
                $params['limit'] = min((int) $args['limit'], 100);
            }
            if (! empty($args['order'])) {
                $params['order'] = $args['order'];
            }
            if (! empty($args['fields'])) {
                $params['fields'] = $args['fields'];
            }

            $result = $this->service->listMembers($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
