<?php

namespace OpenCompany\Integrations\Memberstack\Tools;

use OpenCompany\Integrations\Memberstack\MemberstackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MemberstackListMembers implements Tool
{
    public function __construct(
        private MemberstackService $service,
    ) {}

    public function name(): string
    {
        return 'memberstack_list_members';
    }

    public function description(): string
    {
        return 'List members from Memberstack with pagination. Returns member IDs, emails, plan assignments, and metadata.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of members to return per page (default: 50, max: 100).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (1-based, default: 1).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Memberstack integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 50;
            $page = isset($args['page']) ? (int) $args['page'] : 1;

            $result = $this->service->listMembers($limit, $page);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
