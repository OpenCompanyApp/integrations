<?php

namespace OpenCompany\Integrations\Memberstack\Tools;

use OpenCompany\Integrations\Memberstack\MemberstackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MemberstackGetMember implements Tool
{
    public function __construct(
        private MemberstackService $service,
    ) {}

    public function name(): string
    {
        return 'memberstack_get_member';
    }

    public function description(): string
    {
        return 'Get detailed information about a single Memberstack member by their ID, including email, plan, and custom metadata.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The Memberstack member ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Memberstack integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Member ID is required.');
            }

            $result = $this->service->getMember($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
