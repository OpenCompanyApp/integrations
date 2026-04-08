<?php

namespace OpenCompany\Integrations\Memberstack\Tools;

use OpenCompany\Integrations\Memberstack\MemberstackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MemberstackUpdateMember implements Tool
{
    public function __construct(
        private MemberstackService $service,
    ) {}

    public function name(): string
    {
        return 'memberstack_update_member';
    }

    public function description(): string
    {
        return 'Update an existing Memberstack member. Provide the member ID and any fields to change (email, plan assignment, or custom metadata).';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The Memberstack member ID to update.'],
            'email' => ['type' => 'string', 'description' => 'New email address for the member (optional).'],
            'planId' => ['type' => 'string', 'description' => 'New plan ID to assign (optional). Use memberstack_list_plans to find plan IDs.'],
            'metadata' => ['type' => 'object', 'description' => 'Custom metadata key-value pairs to update (optional). Merges with existing metadata.'],
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

            if (empty($args['email']) && empty($args['planId']) && empty($args['metadata'])) {
                return ToolResult::error('At least one of email, planId, or metadata must be provided to update.');
            }

            $result = $this->service->updateMember(
                id: $args['id'],
                email: $args['email'] ?? null,
                planId: $args['planId'] ?? null,
                metadata: $args['metadata'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
