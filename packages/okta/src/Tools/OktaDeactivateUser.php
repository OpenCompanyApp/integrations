<?php

namespace OpenCompany\Integrations\Okta\Tools;

use OpenCompany\Integrations\Okta\OktaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class OktaDeactivateUser implements Tool
{
    public function __construct(
        private OktaService $service,
    ) {}

    public function name(): string
    {
        return 'okta_deactivate_user';
    }

    public function description(): string
    {
        return 'Deactivate an Okta user. The user will be unable to sign in but their data is retained. This action can be reversed by reactivating the user in the Okta admin console.';
    }

    public function parameters(): array
    {
        return [
            'id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The Okta user ID or login email to deactivate.',
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

            $this->service->deactivateUser($id);

            return ToolResult::success([
                'message' => "User '{$id}' has been deactivated.",
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
