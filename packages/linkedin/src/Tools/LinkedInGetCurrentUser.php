<?php

namespace OpenCompany\Integrations\LinkedIn\Tools;

use OpenCompany\Integrations\LinkedIn\LinkedInService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to retrieve the authenticated user's basic LinkedIn identity.
 *
 * Returns the current user's LinkedIn profile information — useful for
 * verifying authentication and getting the user's basic identity.
 */
class LinkedInGetCurrentUser implements Tool
{
    /**
     * Create a new LinkedInGetCurrentUser tool instance.
     *
     * @param  LinkedInService  $service  The LinkedIn API service.
     */
    public function __construct(
        private LinkedInService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'linkedin_get_current_user';
    }

    /**
     * Get the tool description for AI agent consumption.
     */
    public function description(): string
    {
        return "Get the authenticated user's LinkedIn identity. Returns basic profile information from the /me endpoint — useful for verifying who is authenticated.";
    }

    /**
     * Get the tool parameter schema.
     *
     * @return array<string, array{type: string, description?: string}>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool and return the current user's data.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none required).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('LinkedIn integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
