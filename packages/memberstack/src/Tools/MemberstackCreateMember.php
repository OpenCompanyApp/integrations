<?php

namespace OpenCompany\Integrations\Memberstack\Tools;

use OpenCompany\Integrations\Memberstack\MemberstackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MemberstackCreateMember implements Tool
{
    public function __construct(
        private MemberstackService $service,
    ) {}

    public function name(): string
    {
        return 'memberstack_create_member';
    }

    public function description(): string
    {
        return 'Create a new member in Memberstack. Requires an email address. Optionally set a password, assign a plan, and attach custom metadata.';
    }

    public function parameters(): array
    {
        return [
            'email' => ['type' => 'string', 'required' => true, 'description' => 'Email address for the new member.'],
            'password' => ['type' => 'string', 'description' => 'Password for the new member (optional).'],
            'planId' => ['type' => 'string', 'description' => 'ID of the plan to assign to the member (optional). Use memberstack_list_plans to find plan IDs.'],
            'metadata' => ['type' => 'object', 'description' => 'Custom metadata key-value pairs to attach to the member (optional).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Memberstack integration is not configured.');
            }

            if (empty($args['email'])) {
                return ToolResult::error('Email address is required.');
            }

            $result = $this->service->createMember(
                email: $args['email'],
                password: $args['password'] ?? null,
                planId: $args['planId'] ?? null,
                metadata: $args['metadata'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
