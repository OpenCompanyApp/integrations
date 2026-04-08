<?php

namespace OpenCompany\Integrations\Keystone\Tools;

use OpenCompany\Integrations\Keystone\KeystoneService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class KeystoneGetCurrentUser implements Tool
{
    public function __construct(
        private KeystoneService $service,
    ) {}

    public function name(): string
    {
        return 'keystone_get_current_user';
    }

    public function description(): string
    {
        return 'Get the profile of the currently authenticated KeystoneJS user. Useful for verifying the connection and understanding user permissions.';
    }

    public function parameters(): array
    {
        return [
            'fields' => ['type' => 'string', 'description' => 'Comma-separated list of user fields to include (e.g. "id,name,email,role").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Keystone integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
