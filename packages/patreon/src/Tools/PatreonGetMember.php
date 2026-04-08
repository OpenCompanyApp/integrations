<?php

namespace OpenCompany\Integrations\Patreon\Tools;

use OpenCompany\Integrations\Patreon\PatreonService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PatreonGetMember implements Tool
{
    public function __construct(
        private PatreonService $service,
    ) {}

    public function name(): string
    {
        return 'patreon_get_member';
    }

    public function description(): string
    {
        return 'Get detailed information about a single Patreon member by their ID. Returns member data including pledge details, patron status, and tier information.';
    }

    public function parameters(): array
    {
        return [
            'member_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the member to retrieve.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Patreon integration is not configured.');
            }

            if (empty($args['member_id'])) {
                return ToolResult::error('member_id is required.');
            }

            $result = $this->service->getMember($args['member_id']);

            $member = $result['data'] ?? $result;

            return ToolResult::success($member);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
