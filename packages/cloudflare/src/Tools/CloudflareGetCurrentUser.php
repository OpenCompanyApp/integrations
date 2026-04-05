<?php

namespace OpenCompany\Integrations\Cloudflare\Tools;

use OpenCompany\Integrations\Cloudflare\CloudflareService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CloudflareGetCurrentUser implements Tool
{
    public function __construct(
        private CloudflareService $service,
    ) {}

    public function name(): string
    {
        return 'cloudflare_get_current_user';
    }

    public function description(): string
    {
        return 'Get details of the currently authenticated Cloudflare user. Returns user ID, email, username, and account info.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Cloudflare integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            if (($result['success'] ?? false) === false) {
                $errors = $result['errors'] ?? [];
                $msg = array_map(fn (array $e) => ($e['message'] ?? 'Unknown error'), $errors);
                return ToolResult::error('Cloudflare API error: ' . implode('; ', $msg));
            }

            $user = $result['result'] ?? [];

            return ToolResult::success([
                'id' => $user['id'] ?? null,
                'email' => $user['email'] ?? null,
                'username' => $user['username'] ?? null,
                'first_name' => $user['first_name'] ?? null,
                'last_name' => $user['last_name'] ?? null,
                'telephone' => $user['telephone'] ?? null,
                'country' => $user['country'] ?? null,
                'two_factor_authentication' => $user['two_factor_authentication']['enabled'] ?? null,
                'created_on' => $user['created_on'] ?? null,
                'modified_on' => $user['modified_on'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
