<?php

namespace OpenCompany\Integrations\Okta\Tools;

use OpenCompany\Integrations\Okta\OktaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class OktaUpdateUser implements Tool
{
    public function __construct(
        private OktaService $service,
    ) {}

    public function name(): string
    {
        return 'okta_update_user';
    }

    public function description(): string
    {
        return 'Update an existing Okta user profile. Provide only the profile fields you want to change — other fields remain unchanged.';
    }

    public function parameters(): array
    {
        return [
            'id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The Okta user ID or login email to update.',
            ],
            'profile' => [
                'type' => 'object',
                'required' => true,
                'description' => 'Updated profile fields. Only include fields you want to change (e.g., firstName, lastName, email, title, department, etc.).',
            ],
            'credentials' => [
                'type' => 'object',
                'description' => 'Updated credentials (e.g., new password). Optional.',
            ],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Okta integration is not configured.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('User ID or login email is required.');
            }

            $profile = $args['profile'] ?? [];
            if (empty($profile)) {
                return ToolResult::error('Profile fields to update are required.');
            }

            $credentials = $args['credentials'] ?? [];

            $user = $this->service->updateUser($id, $profile, $credentials);

            return ToolResult::success($user);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
