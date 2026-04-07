<?php

namespace OpenCompany\Integrations\N8n\Tools;

use OpenCompany\Integrations\N8n\N8nService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the authenticated n8n user's profile information.
 */
class N8nGetCurrentUser implements Tool
{
    /** @param  N8nService  $service  The n8n API client */
    public function __construct(
        private N8nService $service,
    ) {}

    public function name(): string
    {
        return 'n8n_get_current_user';
    }

    public function description(): string
    {
        return 'Get the authenticated n8n user\'s profile information, including name, email, and role.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Retrieve the authenticated user's profile.
     *
     * @param  array<string, mixed>  $args  Tool arguments (unused)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('n8n is not configured. Missing API key.');
        }

        try {
            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
