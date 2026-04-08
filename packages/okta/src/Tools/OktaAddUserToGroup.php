<?php

namespace OpenCompany\Integrations\Okta\Tools;

use OpenCompany\Integrations\Okta\OktaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class OktaAddUserToGroup implements Tool
{
    public function __construct(
        private OktaService $service,
    ) {}

    public function name(): string
    {
        return 'okta_add_user_to_group';
    }

    public function description(): string
    {
        return 'Add a user to an Okta group. The user will inherit the group\'s assigned applications and permissions.';
    }

    public function parameters(): array
    {
        return [
            'groupId' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The Okta group ID.',
            ],
            'userId' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The Okta user ID.',
            ],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Okta integration is not configured.');
            }

            $groupId = $args['groupId'] ?? '';
            $userId = $args['userId'] ?? '';

            if (empty($groupId)) {
                return ToolResult::error('Group ID is required.');
            }
            if (empty($userId)) {
                return ToolResult::error('User ID is required.');
            }

            $this->service->addUserToGroup($groupId, $userId);

            return ToolResult::success([
                'message' => "User '{$userId}' has been added to group '{$groupId}'.",
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
