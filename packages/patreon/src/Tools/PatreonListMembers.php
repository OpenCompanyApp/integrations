<?php

namespace OpenCompany\Integrations\Patreon\Tools;

use OpenCompany\Integrations\Patreon\PatreonService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PatreonListMembers implements Tool
{
    public function __construct(
        private PatreonService $service,
    ) {}

    public function name(): string
    {
        return 'patreon_list_members';
    }

    public function description(): string
    {
        return 'List members (patrons) for a Patreon campaign. Returns member IDs, names, email addresses, pledge amounts, and patron status.';
    }

    public function parameters(): array
    {
        return [
            'campaign_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the campaign to list members for.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Patreon integration is not configured.');
            }

            if (empty($args['campaign_id'])) {
                return ToolResult::error('campaign_id is required.');
            }

            $result = $this->service->listMembers($args['campaign_id']);

            $members = $result['data'] ?? [];

            return ToolResult::success([
                'members' => $members,
                'totalCount' => count($members),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
