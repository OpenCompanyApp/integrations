<?php

namespace OpenCompany\Integrations\Okta\Tools;

use OpenCompany\Integrations\Okta\OktaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class OktaCreateUser implements Tool
{
    public function __construct(
        private OktaService $service,
    ) {}

    public function name(): string
    {
        return 'okta_create_user';
    }

    public function description(): string
    {
        return 'Create a new user in Okta. Requires a profile with at least firstName, lastName, email, and login. Optionally provide credentials (password) and control activation.';
    }

    public function parameters(): array
    {
        return [
            'profile' => [
                'type' => 'object',
                'required' => true,
                'description' => 'User profile object. Required fields: firstName, lastName, email, login. Optional: mobilePhone, secondEmail, title, department, organization, etc.',
            ],
            'credentials' => [
                'type' => 'object',
                'description' => 'User credentials. Example: {"password": {"value": "TempPass123!"}}. Omit to let Okta send an activation email.',
            ],
            'activate' => [
                'type' => 'boolean',
                'description' => 'Whether to activate the user immediately (default: true). If false, the user is created in STAGED status.',
            ],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Okta integration is not configured.');
            }

            $profile = $args['profile'] ?? [];
            if (empty($profile)) {
                return ToolResult::error('Profile is required with at least firstName, lastName, email, and login.');
            }

            $requiredFields = ['firstName', 'lastName', 'email', 'login'];
            foreach ($requiredFields as $field) {
                if (empty($profile[$field])) {
                    return ToolResult::error("Profile field '{$field}' is required.");
                }
            }

            $credentials = $args['credentials'] ?? [];
            $activate = $args['activate'] ?? true;

            $user = $this->service->createUser($profile, $credentials, $activate);

            return ToolResult::success($user);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
