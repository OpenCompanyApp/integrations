<?php

namespace OpenCompany\Integrations\Okta\Tools;

use OpenCompany\Integrations\Okta\OktaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class OktaGetUser implements Tool
{
    public function __construct(
        private OktaService $service,
    ) {}

    public function name(): string
    {
        return 'okta_get_user';
    }

    public function description(): string
    {
        return 'Get details for a specific Okta user by ID or login email. Returns the full user profile including status, group memberships, and assigned applications.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The Okta user ID or login email address.'],
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

            $user = $this->service->getUser($id);

            return ToolResult::success($user);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
