<?php

namespace OpenCompany\Integrations\Kajabi\Tools;

use OpenCompany\Integrations\Kajabi\KajabiService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class KajabiListMembers implements Tool
{
    public function __construct(
        private KajabiService $service,
    ) {}

    public function name(): string
    {
        return 'kajabi_list_members';
    }

    public function description(): string
    {
        return 'List all members in your Kajabi account. Returns member names, emails, status, and enrollment details.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of results per page (default: 25).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Kajabi integration is not configured.');
            }

            $params = [];
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (isset($args['per_page'])) {
                $params['per_page'] = (int) $args['per_page'];
            }

            $result = $this->service->listMembers($params);

            $members = $result['members'] ?? $result['data'] ?? [];

            return ToolResult::success([
                'members' => $members,
                'totalCount' => count($members),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
