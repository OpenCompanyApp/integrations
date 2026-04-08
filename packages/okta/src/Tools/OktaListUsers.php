<?php

namespace OpenCompany\Integrations\Okta\Tools;

use OpenCompany\Integrations\Okta\OktaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class OktaListUsers implements Tool
{
    public function __construct(
        private OktaService $service,
    ) {}

    public function name(): string
    {
        return 'okta_list_users';
    }

    public function description(): string
    {
        return 'List users in the Okta organization. Returns user profiles with IDs, names, emails, and status. Supports search filtering by name or email.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of users to return (1–200, default: 200).'],
            'q' => ['type' => 'string', 'description' => 'Search query to filter users by first name, last name, or email.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Okta integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 200;
            $q = $args['q'] ?? null;

            $users = $this->service->listUsers($limit, $q);

            return ToolResult::success($users);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
