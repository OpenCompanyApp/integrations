<?php

namespace OpenCompany\Integrations\ZohoDesk\Tools;

use OpenCompany\Integrations\ZohoDesk\ZohoDeskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: zohodesk_get_current_user
 *
 * Get the currently authenticated user's profile from Zoho Desk.
 */
class ZohoDeskGetCurrentUser implements Tool
{
    /**
     * @param  ZohoDeskService  $service  The Zoho Desk API service instance.
     */
    public function __construct(
        private ZohoDeskService $service,
    ) {}

    /**
     * The tool name used for registration and invocation.
     */
    public function name(): string
    {
        return 'zohodesk_get_current_user';
    }

    /**
     * A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get the currently authenticated Zoho Desk user profile. Useful for verifying credentials and identifying the active agent.';
    }

    /**
     * The parameter schema for this tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool — fetch the current user profile from Zoho Desk.
     *
     * @param  array<string, mixed>  $args  Tool arguments (unused).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Zoho Desk integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            $user = $result['data'] ?? $result['response'] ?? $result;

            return ToolResult::success(is_array($user) ? $user : [$user]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
