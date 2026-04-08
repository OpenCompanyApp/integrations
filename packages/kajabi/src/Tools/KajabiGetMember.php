<?php

namespace OpenCompany\Integrations\Kajabi\Tools;

use OpenCompany\Integrations\Kajabi\KajabiService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class KajabiGetMember implements Tool
{
    public function __construct(
        private KajabiService $service,
    ) {}

    public function name(): string
    {
        return 'kajabi_get_member';
    }

    public function description(): string
    {
        return 'Get detailed information about a single Kajabi member by their ID. Returns member profile, email, status, and enrollment details.';
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
                return ToolResult::error('Kajabi integration is not configured.');
            }

            if (empty($args['member_id'])) {
                return ToolResult::error('member_id is required.');
            }

            $result = $this->service->getMember($args['member_id']);

            $member = $result['member'] ?? $result['data'] ?? $result;

            return ToolResult::success($member);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
