<?php

namespace OpenCompany\Integrations\Netlify\Tools;

use OpenCompany\Integrations\Netlify\NetlifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class NetlifyGetCurrentUser implements Tool
{
    public function __construct(
        private NetlifyService $service,
    ) {}

    public function name(): string
    {
        return 'netlify_get_current_user';
    }

    public function description(): string
    {
        return 'Get details of the currently authenticated Netlify user. Returns user ID, email, name, and account info.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Netlify integration is not configured.');
            }

            $user = $this->service->getCurrentUser();

            return ToolResult::success([
                'id' => $user['id'] ?? null,
                'email' => $user['email'] ?? null,
                'full_name' => $user['full_name'] ?? null,
                'avatar_url' => $user['avatar_url'] ?? null,
                'created_at' => $user['created_at'] ?? null,
                'affiliate_id' => $user['affiliate_id'] ?? null,
                'site_count' => $user['site_count'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
