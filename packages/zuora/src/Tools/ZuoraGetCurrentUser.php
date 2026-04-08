<?php

namespace OpenCompany\Integrations\Zuora\Tools;

use OpenCompany\Integrations\Zuora\ZuoraService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated Zuora user profile.
 *
 * Retrieves profile information for the user associated with the
 * configured OAuth 2.0 access token.
 */
class ZuoraGetCurrentUser implements Tool
{
    /**
     * Create a new ZuoraGetCurrentUser tool instance.
     */
    public function __construct(
        private ZuoraService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'zuora_get_current_user';
    }

    /**
     * Get the tool description for AI agent context.
     */
    public function description(): string
    {
        return 'Get the profile of the currently authenticated Zuora user. Returns user name, email, and tenant information.';
    }

    /**
     * Get the tool parameter schema.
     *
     * @return array<string, array{type: string, description?: string, required?: bool}>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool — get the current Zuora user.
     *
     * @param  array<string, mixed> $args Tool arguments (none required)
     * @return ToolResult The result containing user profile data or an error message
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zuora integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
