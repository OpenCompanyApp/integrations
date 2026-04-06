<?php

namespace OpenCompany\Integrations\Memberstack\Tools;

use OpenCompany\Integrations\Memberstack\MemberstackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MemberstackDeleteMember implements Tool
{
    public function __construct(
        private MemberstackService $service,
    ) {}

    public function name(): string
    {
        return 'memberstack_delete_member';
    }

    public function description(): string
    {
        return 'Permanently delete a member from Memberstack. This action is irreversible and removes all associated data.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The Memberstack member ID to delete.'],
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

            $this->service->deleteMember($args['id']);

            return ToolResult::success("Member '{$args['id']}' has been deleted.");
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
