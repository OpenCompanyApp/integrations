<?php

namespace OpenCompany\Integrations\Caddy\Tools;

use OpenCompany\Integrations\Caddy\CaddyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CaddyGetCurrentUser implements Tool
{
    public function __construct(
        private CaddyService $service,
    ) {}

    public function name(): string
    {
        return 'caddy_get_current_user';
    }

    public function description(): string
    {
        return 'Get details of the currently authenticated Caddy user. Returns user ID, email, username, and account info.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Caddy integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            $user = $result['user'] ?? $result['data'] ?? $result;

            return ToolResult::success([
                'id' => $user['id'] ?? null,
                'email' => $user['email'] ?? null,
                'username' => $user['username'] ?? null,
                'name' => $user['name'] ?? null,
                'created_at' => $user['created_at'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
