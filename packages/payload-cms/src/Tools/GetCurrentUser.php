<?php

namespace OpenCompany\Integrations\PayloadCms\Tools;

use OpenCompany\Integrations\PayloadCms\PayloadCmsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated Payload CMS user profile.
 */
class GetCurrentUser implements Tool
{
    /**
     * @param  PayloadCmsService  $service  The Payload CMS API client
     */
    public function __construct(
        private PayloadCmsService $service,
    ) {}

    public function name(): string
    {
        return 'payload_cms_get_current_user';
    }

    public function description(): string
    {
        return <<<'MD'
        Get the profile of the currently authenticated Payload CMS user.
        Returns email, name, roles, and account metadata.
        MD;
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Get the current user's profile.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Payload CMS integration is not configured.');
            }

            $result = $this->service->getCurrentUser();
            $user = $result['user'] ?? $result;

            return ToolResult::success([
                'id' => $user['id'] ?? '',
                'email' => $user['email'] ?? '',
                'name' => $user['name'] ?? ($user['firstName'] ?? '') . ' ' . ($user['lastName'] ?? ''),
                'roles' => $user['roles'] ?? [],
                'created_at' => $user['createdAt'] ?? null,
                'updated_at' => $user['updatedAt'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
